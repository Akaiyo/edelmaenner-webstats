<?php
/**
* Die Minecraft-Statistiken können hier abgerufen und verarbeitet werden.
* 
* Es kann jedes einzelne Element abgerufen werden.
*/

class MinecraftStats {
	private $sizes;
	public $WorldSize;

	function __construct(){
		$this->sizes = explode(":", file_get_contents("stats/stats_sizes.txt"));

		$this->WorldSize = $this->sizes[0];
	}
}

?>

