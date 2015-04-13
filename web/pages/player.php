<?php
	if($url->segment(2) == false){
			//TODO: Search field or something
			echo "<p>Kein Spieler ausgewählt</p>";
			return;
	}

	$player = new MinecraftPlayer($sql, $url->segment(2));
	if($player->name == false){
		?>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="text-danger">
					whoops! Der Spieler konnte nicht gefunden werden. :(
				</h1>
			</div>
		</div>

		<?php
	}
	else {
		$stats = $player->GetPlayerStats();


?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<img src="<?php echo "http://cravatar.eu/head/" . $player->name . "/64.png" ?>">
			<?php
				echo "$player->name";
			?>
		</h1>
	</div>
</div>

<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table">
					<tr>
						<td>Spiele verlassen:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber($stats['stat.leaveGame'])); ?></td>
					</tr>
					<tr>
						<td>Spieldauer:</td>
						<td class="text-right" ><?php echo(NumberUtils::parseTime($stats['stat.playOneMinute']/20 / 60)); ?></td>
					</tr>
					<tr>
						<td>Zugefügter Schaden:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber( floatval( $stats['stat.damageDealt'] / 2 ), 1 ) ); ?> <img src="img/9px_heart.png"></td>
					</tr>
					<tr>
						<td>Erlittener Schaden:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber( floatval( $stats['stat.damageTaken'] / 2 ), 1 ) ); ?> <img src="img/9px_heart.png"></td>
					</tr>
					<tr>
						<td>Tode:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber($stats['stat.deaths'])); ?></td>
					</tr>
					<tr>
						<td>Getötete Spieler:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber($stats['stat.playerKills'])); ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table">
					<tr>
						<td>Gelaufene Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.walkOneCm'])); ?></td>
					</tr>
					<tr>
						<td>Geschlichene Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.crouchOneCm'])); ?></td>
					</tr>
					<tr>
						<td>Gesprintete Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.sprintOneCm'])); ?></td>
					</tr>
					<tr>
						<td>Geschwommene Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.swimOneCm'])); ?></td>
					</tr>
					<tr>
						<td>Gefallene Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.fallOneCm'])); ?></td>
					</tr>
					<tr>
						<td>Gekletterte Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.climbOneCm'])); ?></td>
					</tr>
					<tr>
						<td>Geflogene Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.flyOneCm'])); ?></td>
					</tr>
					<tr>
						<td>Getauchte Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.diveOneCm'])); ?></td>
					</tr>
					<tr>
						<td>In Lore gefahrene Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.minecartOneCm'])); ?></td>
					</tr>
					<tr>
						<td>In Boot gefahrene Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.boatOneCm'])); ?></td>
					</tr>
					<tr>
						<td>Auf Schwein gerittene Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.pigOneCm'])); ?></td>
					</tr>
					<tr>
						<td>Auf Pferd gerittene Strecke</td>
						<td class="text-right" ><?php echo(NumberUtils::formatLength($stats['stat.horseOneCm'])); ?></td>
					</tr>

				</table>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-body">
			<div class="text-center">
				<img src="<?php echo "http://cravatar.eu/3d/" . $player->name . "/500.png" ?>">
			</div>
			</div>
		</div>
	</div>
</div>

<?php
}
?>

<?php // echo("<pre> "); var_dump($stats); echo("</pre>"); ?>