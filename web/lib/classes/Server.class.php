<?php
class Server {
	
	var $query;

	function __construct($cfg){
		$this->query = new MinecraftQuery();
		try {
			$this->query->Connect($cfg['query_ip'], $cfg['query_port'], $cfg['query_timeout']);
		} catch (Exception $exception){
			echo '<p class="text-danger">Oops! Der Server scheint offline zu sein. Einige Daten können nicht abgerufen werden. :(</p>';
			return;
		}
	}

	function GetPlayers(){
		$info = $this->query->GetInfo();
		if(!empty($info)){
			return $info['Players'];
		} else {
			return '0';
		}
	}
}
?>