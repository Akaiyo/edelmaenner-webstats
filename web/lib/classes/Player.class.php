<?php

class Player {
	protected $sql;
	protected $cfg;

	public $uuid;
	public $name;
	public $stats;
	public $lastlogin;
	public $firstlogin;
	public $playerid;

	function __construct ($sql, $cfg, $string){

		$this->sql = $sql;
		$this->cfg = $cfg;


		if(strlen($string) > 16){

			/* UUID */

			$where = "WHERE lbp.`UUID`='" . $this->sql->escape($string) . "'";

		} else {

			/* Spielername */

			$where = "WHERE lbp.`playername` LIKE '" . $this->sql->escape($string) . "'";

		}

		$result = $this->sql->query_one("SELECT sts.*, lbp.playerid, lbp.playername, lbp.firstlogin, lbp.lastlogin, lbp.onlinetime, lbp.ip FROM `lb-players` lbp INNER JOIN `st_statistics` sts ON sts.`uuid`=lbp.`UUID` " . $where);

		if($result){

			$this->raw = $result;
			$this->uuid = $result['uuid'];
			$this->name = $result['playername'];
			$this->firstlogin = $result['firstlogin'];
			$this->lastlogin = $result['lastlogin'];
			$this->playerid = $result['playerid'];
			
			return true;

		} else {

			return false;

		}
		
	}

	function GetBlocks(){


	}

	function GetDetailedBlocks($interval){

		$dateClause = $interval != "" ? "AND date > date_sub(now(),INTERVAL 1 $interval)" : "";
		$tables = $this->cfg['logblock_tables'];
		$player = $this->name;

		$sql = 'SELECT type, SUM(created) AS created, SUM(destroyed) AS destroyed FROM (';
		for ($i = 0; $i < count($tables); $i++) {
   			$sql .= "(SELECT type, count(type) AS created, 0 AS destroyed FROM `$tables[$i]` INNER JOIN `lb-players` USING (playerid) WHERE playername = '$player' AND type > 0 AND type != replaced $dateClause GROUP BY type) UNION (SELECT replaced AS type, 0 AS created, count(replaced) AS destroyed FROM `$tables[$i]` INNER JOIN `lb-players` USING (playerid) WHERE playername = '$player' AND replaced > 0 AND type != replaced $dateClause GROUP BY replaced)";
			if ($i < count($tables) - 1)
				$sql .= ' UNION ';
		}
   		$sql .= ') AS t GROUP BY type ORDER BY SUM(created) + SUM(destroyed) DESC';
		
		$result = $this->sql->query_all($sql);

		return $result;

	}

	function GetDetailedBlocksTable($result){
		$html = "";$x = 1;
		foreach($result as $row){
			
			$html .= "<tr>";
			$html .= "<td>" . $x . ".</td>";
			$html .= '<td><img src="' . SITE_URL . '/img/blocks/' . $row['type'] . '.png"> ' . $this->cfg['text']['material'][$row['type']] . "</td>";
			$html .= "<td>" . NumberUtils::formatDecNumber($row['created']) . "</td>";
			$html .= "<td>" . NumberUtils::formatDecNumber($row['destroyed']) . "</td>";
			$html .= "<td>" . NumberUtils::formatDecNumber(($row['created'] + $row['destroyed'])) . "</td>";
			$x++;
		}

		return $html;
	}



}

?>