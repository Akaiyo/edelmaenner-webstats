<?php
class Server {
	
	var $Query;
	public $Info;

	function __construct($cfg){
		$this->Query = new MinecraftQuery();
		try {
			$this->Query->Connect($cfg['query_ip'], $cfg['query_port'], $cfg['query_timeout']);

			$this->Info = $this->Query->GetInfo();
		} catch (Exception $exception){
			echo '<p class="text-danger">Oops! Der Server scheint offline zu sein. Einige Daten konnten nicht abgerufen werden. :(</p>';
			return;
		}
	}


	function GetTicks(){
		return "20";
	}
}
?>