<?php
class MinecraftSettings {
	public $Settings;
	private $cfg;

	function __construct(){
		$file = "stats/server.properties";
		$this->Settings = parse_ini_file($file);
		if(empty($this->Settings)){
			return false;
		}
	}
}
?>