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
	}

	function GetStatsFile() {
		$content = file_get_contents('stats/players/' . $this->uuid . '.json');
		return $content;
	}

	function GetPlayerStats() {
		return json_decode($this->GetStatsFile(), true);
	}
}

?>