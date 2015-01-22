<?php
class ToplistQueryFactory{
	public static function build($query_type, $config, $interval = "")
  	{
	    $query = "ToplistQuery_" . ucwords($query_type);
	    if(class_exists($query))
	    {
	    	return new $query($config, $interval);
	    }
	    else {
	    	throw new Exception("Invalid Query requested");
	    }
  	}
}

class ToplistQuery_BlockQuery extends ToplistQuery{
	public function displayResult(){
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

		echo "<div class='row'>
				<div class='col-md-12'>
					<table class='table'>
						<thead>
							<tr>
								<th>#</th>
								<th>Spieler</th>
								<th>Gesetzt</th>
								<th>Zerstört</th>
							</tr>
						</thead>
						<tbody>";
			$counter = 0;

			foreach($this->result as $row){

				$materialName = isset($this->cfg["text"]["material"][$row[0]]) ? $this->cfg["text"]["material"][$row[0]] : $row[0];

				echo "<tr>
					<td>". ++$counter ."</td>
					<td><a href=player/". $row[0] ."><img src=http://cravatar.eu/avatar/". $row[0] ."/32.png>" . $row[0] ."</a></td>
					<td>" . $row[1] . "</td>
					<td>" . $row[2] . "</td>
					</tr>";
			}




						echo "
						</tbody>
					</table>
				</div>
			</div>";
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

		$dateClause = $this->interval != "" ? "AND date > date_sub(now(),INTERVAL 1 $interval)" : "";

		$tables = $this->cfg["logblock_tables"];

		$sql = 'SELECT playername, SUM(created) AS created, SUM(destroyed) AS destroyed FROM (';
		for ($i = 0; $i < count($tables); $i++) {
			$sql .= "(SELECT playerid, count(type) AS created, 0 AS destroyed FROM `$tables[$i]` WHERE type > 0 AND type != replaced $dateClause GROUP BY playerid) UNION (SELECT playerid, 0 AS created, count(replaced) AS destroyed FROM `$tables[$i]` WHERE replaced > 0 AND type != replaced $dateClause GROUP BY playerid)";
			if ($i < count($tables) - 1)
				$sql .= ' UNION ';
		}
		$excludedPlayers = $this->cfg["logblock_excludedPlayers"];
		$where = '';
		if (count($excludedPlayers) > 0) {
			$where = 'WHERE ';
			for ($i = 0; $i < count($excludedPlayers); $i++) {
				$where .= "playername != '" . $excludedPlayers[$i] . "' ";
				if ($i < count($excludedPlayers) - 1)
					$where .= 'AND ';
			}
		}
		$sql .= ') AS t INNER JOIN `lb-players` USING (playerid) ' . $where . 'GROUP BY playerid ORDER BY SUM(created) + SUM(destroyed) DESC';
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


}

abstract class ToplistQuery{
	protected $cfg;
	protected $interval;

	protected $result;

	function __construct($config,$interval = "")
	{
		$this->cfg = $config;
		$this->interval = $interval;

		$this->result = QueryResult::NORESULT;
	}

	abstract protected function displayResult();
	abstract protected function runQuery();

	/**
	*	Clears the previous result
	*/
	public function clearResult(){
		unset($this->result);
	}
}

?>
