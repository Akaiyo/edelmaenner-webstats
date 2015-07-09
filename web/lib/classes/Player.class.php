<?php

class Player {
	protected $sql;

	public $uuid;
	public $name;
	public $stats;
	public $lastlogin;
	public $firstlogin;
	public $playerid;

	function __construct ($sql, $string){

		$this->sql = $sql;


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
			$this->uuid = $result['UUID'];
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
		$sum['destroyed'] = 0;
		$sum['placed'] = 0;
		$sum['moved'] = 0;

		$blocks = $this->GetDetailedBlocks();

		foreach ($blocks as $value) {
			if($value['type'] == 0){
				$sum['destroyed']++;
			} else {
				$sum['placed']++;
			}
		}

		$sum['moved'] = $sum['placed'] + $sum['destroyed'];

		return $sum;

	}

	function GetDetailedBlocks(){

		$result_world = $this->sql->query_all("SELECT replaced, type FROM `lb-world` WHERE playerid='" . $this->playerid . "';");
		$result_world_nether = $this->sql->query_all("SELECT replaced, type FROM `lb-world` WHERE playerid='" . $this->playerid . "';");
		$result_world_the_end = $this->sql->query_all("SELECT replaced, type FROM `lb-world` WHERE playerid='" . $this->playerid . "';");

		$result= array_merge($result_world, $result_world_nether, $result_world_the_end);

		echo(memory_get_usage(true));

		return $result;
	
	}



}

?>