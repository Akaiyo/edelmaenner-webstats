<?php
$Server = new Server($cfg);
$Settings = new MinecraftSettings();
#$McMyAdmin = new McMyAdmin('status', 'gpUzgWMeFbuKEvE2xJcj', '144.76.76.163', '8998');
#$McMyAdminServerStatus = $McMyAdmin->getStatus();

$data_history = json_encode($Server->GetHistory("timestamp, players, ram"));

?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			Server & Technik
		</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $Server->Info['Players']; ?>
						</div>
						<div>
							Spieler online
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-gears fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $McMyAdminServerStatus->cpuusage ?> %
						</div>
						<div>
							CPU-Auslastung
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-server fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo $McMyAdminServerStatus->ram . " / " . $McMyAdminServerStatus->maxram ?> MB
						</div>
						<div>
							Speicherauslastung
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Informationen
			</div>
		<div class="panel-body">
			<table class="table">
				<tbody>
					<tr>
						<th>Name</th>
						<td><?php echo $Server->Info['HostName']; ?></td>
					</tr>
					<tr>
						<th>Version</th>
						<td><?php echo $Server->Info['Version']; ?></td>
					</tr>
					<tr>
						<th>Software</th>
						<td><?php echo $Server->Info['Software']; ?></td>
					</tr>
					<tr>
						<th>Maximale Spieler</th>
						<td><?php echo $Server->Info['MaxPlayers']; ?></td>
					</tr>
					<tr>
						<th>Spielmodus</th>
						<td><?php echo $Server->Info['GameType']; ?></td>
					</tr>
					<tr>
						<th>Aktuelle Karte</th>
						<td><?php echo $Server->Info['Map']; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				Spieleinstellungen
			</div>
			<div class="panel-body">
				<table class="table">
					<tbody>
						<tr>
							<th>Schwierigkeitsgrad</th>
							<td><?php echo $cfg['text']['difficulty'][$Settings->Settings['difficulty']]; ?></td>
						</tr>
						<tr>
							<th>Monster</th>
							<td><?php echo $cfg['text']['settings'][$Settings->Settings['spawn-monsters']] ?></td>
						</tr>
						<tr>
							<th>NPCs</th>
							<td><?php echo $cfg['text']['settings'][$Settings->Settings['spawn-npcs']] ?></td>
						</tr>
						<tr>
							<th>Tiere</th>
							<td><?php echo $cfg['text']['settings'][$Settings->Settings['spawn-animals']] ?></td>
						</tr>
						<tr>
							<th>Sichtweite</th>
							<td><?php echo $Settings->Settings['view-distance']; ?></td>
						</tr>
						<tr>
							<th>PvP</th>
							<td><?php echo $cfg['text']['settings'][$Settings->Settings['pvp']] ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Verlauf
			</div>
			<div class="panel-body">				
				<div id="history_chart" style="position: relative; width:100%; height:300px;">
				</div>
			</div>
			<script type="text/javascript">
					$(function() {

						Morris.Line({
							element: 'history_chart',
							data: <?php echo $data_history ?>,
							xkey: 'timestamp',
							ykeys: ['players', 'ram'],
							labels: ['Spieler', 'RAM'],
						});

					});
			</script>
		</div>
	</div>
</div>