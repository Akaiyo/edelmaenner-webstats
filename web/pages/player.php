<?php
	if($url->segment(2) == false){

		$Server = new Server($sql, $cfg);
		$Players = new Players($sql, $cfg);

			?>
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Spieler</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="panel panel-default">
						<div class="panel-body">
							<table class="table">
								<tr>
									<td>Spieler online:</td>
									<td><?php echo($Server->Info['Players']); ?></td>
								</tr>
								<tr>
									<td>Spieler gesamt:</td>
									<td><?php echo($Players->GetPlayerCount()); ?></td>
								</tr>
								<tr>
									<td>Aktive Spieler (30 Tage):</td>
									<td><?php echo($Players->GetActivePlayerCount()); ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="panel panel-default">
						<div class="panel-body">
							<table class="table table-striped">
								<tr>
									<th>Spieler</th>
									<th>letzer Login</th>
								</tr>
								<?php echo $Players->GetLastPlayerTable(); ?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php

			return;
	}

	$Player = new Player($sql, $cfg, $url->segment(2));

	if($Player->name == false){
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
		$stats = $Player->raw;


?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<img src="<?php echo "http://cravatar.eu/head/" . $Player->name . "/64.png" ?>">
			<?php
				echo "$Player->name";
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
						<td>UUID:</td>
						<td class="text-right" onClick="this.select();"><?php echo($Player->uuid); ?></td>
					</tr>
					<tr>
						<td>Letzer Login:</td>
						<td class="text-right" ><?php echo(NumberUtils::parseDate($Player->lastlogin)); ?></td>
					</tr>
					<tr>
						<td>Erster Login:</td>
						<td class="text-right" ><?php echo(NumberUtils::parseDate($Player->firstlogin)); ?></td>
					</tr>
					<tr>
						<td>Spieldauer:</td>
						<td class="text-right" ><?php echo(NumberUtils::parseTime($stats['stat.playOneMinute']/20 / 60)); ?></td>
					</tr>
					<tr>
						<td>Spiele verlassen:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber($stats['stat.leaveGame'])); ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table">
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
					<tr>
						<td>Getötete Kreaturen:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber($stats['stat.mobKills'])); ?></td>
					</tr>
					<tr>
						<td>Fallen gelassene Gegenstände:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber($stats['stat.drop'])); ?></td>
					</tr>
					<tr>
						<td>Kisten geöffnet:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber($stats['stat.chestOpened'])); ?></td>
					</tr>
					<tr>
						<td>Enderkisten geöffnet:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber($stats['stat.enderchestOpened'])); ?></td>
					</tr>
					<tr>
						<td>Kuchenstückchen gegessen:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber($stats['stat.cakeSlicesEaten'])); ?></td>
					</tr>
					<tr>
						<td>Schallplatzen gespielt:</td>
						<td class="text-right" ><?php echo(NumberUtils::formatDecNumber($stats['stat.recordPlayed'])); ?></td>
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
				<img src="<?php echo "http://cravatar.eu/3d/" . $Player->name . "/500.png" ?>">
			</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<table class="table table-striped">
					<tr>
						<th>#</th>
						<th>Block</th>
						<th class="text-right">Gebaut</th>
						<th class="text-right">Abgebaut</th>
						<th class="text-right">Summe</th>
					</tr>
					<?php echo($Player->GetDetailedBlocksTable($Player->GetDetailedBlocks(""))); ?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php



}
?>
