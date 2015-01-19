<?php
class BlockQuery{
	private $cfg;
	private $username;
	private $interval;

	private $result;

	function __construct($config, $username,$interval = "")
	{
		$this->cfg = $config;
		//No special characters
		$this->username = preg_replace("/[^a-zA-Z0-9_]/","",$username);
		$this->interval = $interval;

		$this->result = QueryResult::NORESULT;
	}

	public function displayBlockList(){

		if($this->result == QueryResult::NORESULT){
			echo "<p>Kein Ergebnis</p>";
			return;
		}

		if($this->result == QueryResult::NOPLAYER){
			echo "<p>Für den spezifizierten Spieler '$this->username' konnten keine Einträge gefunden werden</p>";
			return;
		}

		if($this->result == QueryResult::TOOMANY){
			echo "<p>Zu viele Datenbank abfragen, bitte habe etwas Geduld</p>";
			return;
		}

		//Output BlockList Table
		echo "<div class='table-responsive'>
				<table class='table'>
					<thead>
						<tr>
						<th>#</th>
						<th>Blocktyp</th>
						<th>Gesetzt</th>
						<th>Abgebaut</th>
						</tr>
					</thead>
				<tbody>";
		$counter = 0;

		foreach($this->result as $row){

			$materialName = isset($this->cfg["text"]["material"][$row[0]]) ? $this->cfg["text"]["material"][$row[0]] : $row[0];

			echo "<tr>
				<td>". ++$counter ."</td>
				<td><img src='img/blocks/" . $row[0]. ".png'> " .	 $materialName ."</td>
				<td>" . $row[1]. "</td>
				<td>" . $row[2]. "</td>
				</tr>";
		}

		echo "</table></div>";

	}


	public function runQuery(){
		$this->clearResult();
		$this->result = QueryResult::NORESULT;

		if(isset($_SESSION["lastdbquery"]) && microtime(true) - $_SESSION["lastdbquery"] < $this->cfg["sql_cooldown"]){
			$this->result = QueryResult::TOOMANY;
			return $this->result;
		}

		//Connect to the database
		$connection = mysql_connect($this->cfg["sql_server"],$this->cfg["sql_user"],$this->cfg["sql_password"]);
		$database = mysql_select_db($this->cfg["sql_database"]);

		$player = $this->username;

		$dateClause = $this->interval != "" ? "AND date > date_sub(now(),INTERVAL 1 $interval)" : "";

		$tables = $this->cfg["logblock_tables"];

		//Code from the outdated LogBlockWebStats made by DiddiZ
		$sql = 'SELECT type, SUM(created) AS created, SUM(destroyed) AS destroyed FROM (';
		for ($i = 0; $i < count($tables); $i++) {
   			$sql .= "(SELECT type, count(type) AS created, 0 AS destroyed FROM `$tables[$i]` INNER JOIN `lb-players` USING (playerid) WHERE playername = '$player' AND type > 0 AND type != replaced $dateClause GROUP BY type) UNION (SELECT replaced AS type, 0 AS created, count(replaced) AS destroyed FROM `$tables[$i]` INNER JOIN `lb-players` USING (playerid) WHERE playername = '$player' AND replaced > 0 AND type != replaced $dateClause GROUP BY replaced)";
			if ($i < count($tables) - 1)
				$sql .= ' UNION ';
		}
   		$sql .= ') AS t GROUP BY type ORDER BY SUM(created) + SUM(destroyed) DESC';
   		$sqlresult = mysql_query($sql);

		if($this->cfg["debug"])
			echo mysql_error();

		if(mysql_num_rows($sqlresult) > 0){
			$this->result = array();
			//Fetch the re
			while($row = mysql_fetch_row($sqlresult)){
				$this->result[] = $row;
			}
		}else{
			$this->result = QueryResult::NOPLAYER;
			return $this->result;
		}


		//Save time of last query into the session
		if($this->cfg["sql_cooldown"] != 0)
			$_SESSION["lastdbquery"] = microtime(true);
	}

	/**
	*	Clears the previous result
	*/
	public function clearResult(){
		unset($this->result);
	}
}
?>
