<?php

class MinecraftPlayer {

	public $uuid;
	public $name;

	protected $sql;

	function __construct ($sql, $name){
		$this->sql = $sql;
		$result = $this->sql->query_one("SELECT * FROM `lb-players` WHERE playername LIKE '" . $this->sql->escape($name) . "'");
		$this->name = $result['playername'];
		$this->uuid = $result['UUID'];
		if(empty($result['playername'])){
			return false;		
		}	

		return true;
	}

	function GetStatsFile() {
		if(!file_exists('stats/players/' . $this->uuid . '.json')){
			return false;
		}else{
			return file_get_contents('stats/players/' . $this->uuid . '.json');
		}
	}

	function GetPlayerStats() {
		return json_decode($this->GetStatsFile(), true);
	}
}

?>