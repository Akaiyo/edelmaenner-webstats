<?php

class MinecraftPlayer {

	public $uuid;
	public $name;
	public $lastlogin;

	protected $sql_lb;
	protected $sql_stats;

	function __construct ($sql_lb, $sql_stats, $string){

		$this->sql_lb = $sql_lb;
		$this->sql_stats = $sql_stats;


		if(strlen($string) > 16){
			$result = $this->sql_lb->query_one("SELECT * FROM `lb-players` WHERE UUID='" . $this->sql_lb->escape($string) . "'");
			echo( "test" );
		} else {
			$result = $this->sql_lb->query_one("SELECT * FROM `lb-players` WHERE playername LIKE '" . $this->sql_lb->escape($string) . "'");
		}

		if($result){
			$this->uuid = $result['UUID'];
			$this->name = $result['playername'];
			$this->firstlogin = $result['firstlogin'];
			$this->lastlogin = $result['lastlogin'];
			return true;
		} else {
			return false;
		}
		
	}

	function GetStats(){
		$stats=$this->sql_stats->query_one("SELECT * FROM players WHERE uuid='" . $this->uuid . "'");
		return $stats;
	}

}

?>