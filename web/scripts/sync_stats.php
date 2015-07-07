<?php

// Das Verzeichnis worin sich unsere json-Dateien mit den Informationen befinden.
$stats_source_dir = "C:/tmp/stats";


// SQL-Daten zu der Datenbank worin die Statistiken gespeichert werden.
$sql_host = "localhost";
$sql_user = "statistics";
$sql_password = "statistics";
$sql_database = "statistics";

$stats = array(
				`uuid`,
				`stat.leaveGame`,
				`stat.playOneMinute`,
				`stat.timeSinceDeath`,
				`stat.walkOneCm`,
				`stat.crouchOneCm`,
				`stat.sprintOneCm`,
				`stat.swimOneCm`,
				`stat.fallOneCm`,
				`stat.climbOneCm`,
				`stat.flyOneCm`,
				`stat.diveOneCm`,
				`stat.minecartOneCm`,
				`stat.boatOneCm`,
				`stat.pigOneCm`,
				`stat.horseOneCm`,
				`stat.jump`,
				`stat.damageDealt`,
				`stat.damageTaken`,
				`stat.deaths`,
				`stat.mobKills`,
				`stat.playerKills`,
				`stat.drop`,
				`stat.itemEnchanted`,
				`stat.animalsBred`,
				`stat.fishCaught`,
				`stat.junkFished`,
				`stat.treasureFished`,
				`stat.talkedToVillager`,
				`stat.tradedWithVillager`,
				`stat.cakeSlicesEaten`,
				`stat.cauldronFilled`,
				`stat.cauldronUsed`,
				`stat.armorCleaned`,
				`stat.bannerCleaned`,
				`stat.brewingstandInteraction`,
				`stat.beaconInteraction`,
				`stat.craftingTableInteraction`,
				`stat.furnaceInteraction`,
				`stat.dispenserInspected`,
				`stat.dropperInspected`,
				`stat.hopperInspected`,
				`stat.chestOpened`,
				`stat.trappedChestTriggered`,
				`stat.enderchestOpened`,
				`stat.noteblockPlayed`,
				`stat.noteblockTuned`,
				`stat.flowerPotted`,
				`stat.recordPlayed`
);

$mysql = new mysqli($sql_host, $sql_user, $sql_password, $sql_database);
if(!$mysql){
	die("Fehler: Konnte keine Datenbankverbindung aufbauen.");
}


$query = "SELECT uuid FROM players";
$result = $mysql->query($query);

$current_players = array();

while($cur_result = $result->fetch_assoc()){
	$current_players[] = $cur_result['uuid'];
}

$statsOnDisk = scandir($stats_source_dir);
$exclude = array('.', '..');
foreach( $statsOnDisk as $recordname){
	if(!in_array($recordname, $exclude)){

		
		$uuid = substr($recordname, 0, -5);
		if(strlen($uuid) > 16 ){

			if(!in_array($uuid, $current_players)){
				$mysql->query("INSERT INTO players (`uuid`) VALUES ('" . $uuid . "');");
			}

			$query = "SELECT * FROM players";
			$result = $mysql->query($query);

			$record = json_decode(file_get_contents($stats_source_dir . '/' . $recordname), TRUE);
			$SQL = "UPDATE players SET
				`stat.leaveGame`='" . $record['stat.leaveGame'] . "',
				`stat.playOneMinute`='" . $record['stat.playOneMinute'] . "',
				`stat.timeSinceDeath`='" . $record['stat.timeSinceDeath'] . "',
				`stat.walkOneCm`='" . $record['stat.walkOneCm'] . "',
				`stat.crouchOneCm`='" . $record['stat.crouchOneCm'] . "',
				`stat.sprintOneCm`='" . $record['stat.sprintOneCm'] . "',
				`stat.swimOneCm`='" . $record['stat.swimOneCm'] . "',
				`stat.climbOneCm`='" . $record['stat.climbOneCm'] . "',
				`stat.flyOneCm`='" . $record['stat.flyOneCm'] . "',
				`stat.minecartOneCm`='" . $record['stat.minecartOneCm'] . "',
				`stat.boatOneCm`='" . $record['stat.boatOneCm'] . "',
				`stat.pigOneCm`='" . $record['stat.pigOneCm'] . "',
				`stat.horseOneCm`='" . $record['stat.horseOneCm'] . "',
				`stat.jump`='" . $record['stat.jump'] . "',
				`stat.damageDealt`='" . $record['stat.damageDealt'] . "',
				`stat.damageTaken`='" . $record['stat.damageTaken'] . "',
				`stat.deaths`='" . $record['stat.deaths'] . "',
				`stat.mobKills`='" . $record['stat.mobKills'] . "',
				`stat.playerKills`='" . $record['stat.playerKills'] . "',
				`stat.drop`='" . $record['stat.drop'] . "',
				`stat.itemEnchanted`='" . $record['stat.itemEnchanted'] . "',
				`stat.animalsBred`='" . $record['stat.animalsBred'] . "',
				`stat.fishCaught`='" . $record['stat.fishCaught'] . "',
				`stat.junkFished`='" . $record['stat.junkFished'] . "',
				`stat.treasureFished`='" . $record['stat.treasureFished'] . "',
				`stat.talkedToVillager`='" . $record['stat.talkedToVillager'] . "',
				`stat.cakeSlicesEaten`='" . $record['stat.cakeSlicesEaten'] . "',
				`stat.cauldronFilled`='" . $record['stat.cauldronFilled'] . "',
				`stat.cauldronUsed`='" . $record['stat.cauldronUsed'] . "',
				`stat.armorCleaned`='" . $record['stat.armorCleaned'] . "',
				`stat.bannerCleaned`='" . $record['stat.bannerCleaned'] . "',
				`stat.brewingstandInteraction`='" . $record['stat.brewingstandInteraction'] . "',
				`stat.beaconInteraction`='" . $record['stat.beaconInteraction'] . "',
				`stat.craftingTableInteraction`='" . $record['stat.craftingTableInteraction'] . "',
				`stat.furnaceInteraction`='" . $record['stat.furnaceInteraction'] . "',
				`stat.dispenserInspected`='" . $record['stat.dispenserInspected'] . "',
				`stat.dropperInspected`='" . $record['stat.dropperInspected'] . "',
				`stat.hopperInspected`='" . $record['stat.hopperInspected'] . "',
				`stat.chestOpened`='" . $record['stat.chestOpened'] . "',
				`stat.trappedChestTriggered`='" . $record['stat.trappedChestTriggered'] . "',
				`stat.enderchestOpened`='" . $record['stat.enderchestOpened'] . "',
				`stat.noteblockPlayed`='" . $record['stat.noteblockPlayed'] . "',
				`stat.noteblockTuned`='" . $record['stat.noteblockTuned'] . "',
				`stat.flowerPotted`='" . $record['stat.flowerPotted'] . "',
				`stat.recordPlayed`='" . $record['stat.recordPlayed'] . "'


				WHERE `uuid`='" . $uuid . "';
			";

			$mysql->query($SQL);
		}

		
	}
}