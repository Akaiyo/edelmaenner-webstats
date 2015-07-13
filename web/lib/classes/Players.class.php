<?php

class Players {
	protected $sql;
	private $players;

	function __construct($sql, $cfg){
		$this->sql = $sql;

		$users = '"';
		$users .= implode('","', $cfg['logblock_excludedPlayers']);
		$users .= '"';
		$result = $this->sql->query_all("SELECT * FROM `lb-players` WHERE playername NOT IN (" . $users . ") ORDER BY lastlogin DESC");

		$this->players = array();

		foreach($result as $x){
			$this->players[$x['UUID']] = array(
				'playername' => $x['playername'],
				'playerid' => $x['playerid'],
				'lastlogin' => $x['lastlogin']
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

	function GetActivePlayerCount(){
		$active = 0;
		foreach($this->players as $x){
			/* 30 Tage! */
			if(strtotime($x['lastlogin']) >= time() - 2592000){
				$active++;
			}
		}
		return $active;
	}

	function GetLastPlayerTable(){
		$html = "";
		$n = 0;
		foreach($this->players as $x){	
			$lastlogin = intval(round((time() - strtotime($x['lastlogin'])) / 100));
			$html .= '<tr>';
			$html .= '<td><img src="http://cravatar.eu/avatar/' . $x['playername'] . '/32.png"> <a href="' . SITE_URL . 'player/' . $x['playername'] . '">' . $x['playername'] . '</td>';
			$html .= '<td>' . NumberUtils::parseTime($lastlogin) . '</td>';
			$html .= "</tr>";
			$n++;

			if($n == 50){
				break;
			}
		}

		return $html;
	}

}

?>