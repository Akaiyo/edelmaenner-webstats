<?php

class MinecraftPlayers {
	protected $sql;
	private $playerarray;
	private $players;

	function __construct($sql, $cfg){
		$this->sql = $sql;

		$users = '"';
		$users .= implode('","', $cfg['logblock_excludedPlayers']);
		$users .= '"';
		$result = $this->sql->query_all("SELECT * FROM `lb-players` WHERE playername NOT IN (" . $users . ")");

		$this->players = array();

		foreach($result as $x){
			$this->players[$x['UUID']] = array(
				'playername' => $x['playername'],
			);
		}

	}

	function GetPlayerCount(){
		return count($this->players);
	}

	function GetPlayerNameByUUID($uuid){
		$x = $this->players[$uuid];
		return $x['playername'];
	}

}

?>