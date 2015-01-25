<?php
class Server {
	
	var $Query;
	var $McMyAdmin;
	var $cfg;
	var $sql;

	public $Info;

	function __construct($cfg){
		$this->cfg = $cfg;

		$this->Query = new MinecraftQuery();
		try {
			$this->Query->Connect($cfg['query_ip'], $cfg['query_port'], $cfg['query_timeout']);

			$this->Info = $this->Query->GetInfo();
		} catch (Exception $exception){
			echo '<p class="text-danger">Oops! Der Server scheint offline zu sein. Einige Daten konnten nicht abgerufen werden. :(</p>';
			return;
		}

		$this->sql = new mysqli($cfg["sql_stats_server"], $cfg["sql_stats_user"] ,$cfg["sql_stats_password"] ,$cfg["sql_stats_database"]);

	}


	public function GetHistory($values, $since = ''){
		$result = $this->sql->query("SELECT " . $this->sql->real_escape_string($values) . " FROM history;");
		$return = array();
		while ( $x = $result->fetch_assoc() ){
			$return[] = $x; 
		}

		return $return;
	}
}
?>