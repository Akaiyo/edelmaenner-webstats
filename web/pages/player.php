<?php
	if($url->segment(2) == false){
			//TODO: Search field or something
			echo "<p>Kein Spieler ausgewählt</p>";
			return;
	}

	$player = new MinecraftPlayer($sql, $url->segment(2));
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
					<tr></tr>
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

<?php // echo("<pre> "); var_dump($stats); echo("</pre>"); ?>