<?php
class Server {
	
	var $Query;
	var $McMyAdmin;
	var $cfg;
	var $sql;

	public $Info;

	function __construct($sql, $cfg){
		$this->cfg = $cfg;
		$this->sql = $sql;

		$this->Query = new MinecraftQuery();
		try {
			$this->Query->Connect($cfg['query_ip'], $cfg['query_port'], $cfg['query_timeout']);

			$this->Info = $this->Query->GetInfo();
		} catch (Exception $exception){
			echo '<p class="text-danger">Oops! Der Server scheint offline zu sein. Einige Daten konnten nicht abgerufen werden. :(</p>';
			return;
		}

	}


	public function GetHistory(){
		$result = $this->sql->query_all("SELECT timestamp, players, ram FROM st_history WHERE timestamp > date_sub(curdate(), INTERVAL 1 DAY)");
		$return = array();
		$return['timestamp'] = array();
		foreach ( $result as $x ){
			$return['timestamp'][] = $x['timestamp'];
			$return['players'][] = intval($x['players']);
			$return['ram'][] = intval($x['ram']);
		}

		return $return;
	}

	public function GetWorldSize(){
		$this->sizes = explode(":", file_get_contents("stats/stats_sizes.txt"));
		return $this->sizes[0];
	}
}
?>