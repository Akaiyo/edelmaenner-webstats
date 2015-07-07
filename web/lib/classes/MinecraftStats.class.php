<?php
/**
* Die Minecraft-Statistiken können hier abgerufen und verarbeitet werden.
* 
* Es kann jedes einzelne Element abgerufen werden.
*/

class MinecraftStats {
	private $sizes;

	function GetWorldSize(){
		$this->sizes = explode(":", file_get_contents("stats/stats_sizes.txt"));
		return $this->sizes[0];
	}

	public function GetAllPlayerStats(){
		$playersOnDisk = scandir("stats/players/");
		$Players = array();
		$Exclude = array('.', '..');
		foreach($playersOnDisk as $Player){
			if(!in_array($Player, $Exclude)){
				$uuid = substr($Player, 0, -5);
				$Players[$uuid] = file_get_contents("stats/players/$Player");
			
			}
		}

		return $Players;
	}


}

?>

