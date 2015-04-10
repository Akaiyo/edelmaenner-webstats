<?php
$Server = new Server($cfg);
$Settings = new MinecraftSettings();
$Stats = new MinecraftStats();
$McMyAdmin = new McMyAdmin('status', 'gpUzgWMeFbuKEvE2xJcj', '144.76.76.163', '8998');
$McMyAdminServerStatus = $McMyAdmin->getStatus();

$data_history = $Server->GetHistory();

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
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-database fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php echo NumberUtils::formatBytes($Stats->WorldSize); ?>
						</div>
						<div>
							Größe der Welt
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
							<?php echo $McMyAdminServerStatus->ram . "/" . $McMyAdminServerStatus->maxram ?> MB
						</div>
						<div>
							RAM - Auslastung
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
				<div style="float: right;">
					<select id="bandwidth" name="" disabled="disabled">
						<option value="day">24 Stunden</option>
						<option value="week">7 Tage</option>
						<option value="month">1 Monat</option>
					</select>
				</div>
			</div>
			<div class="panel-body">				
				<div id="history_chart_player" style="position: relative; width:100%; height:300px;">
				</div>
				<div id="history_chart_ram" style="position: relative; width:100%; height:300px;">
				</div>
			</div>
			<script type="text/javascript">
					$(function() {

						$('#history_chart_player').highcharts({
							chart: {
								zoomType: 'x'
							},
							title: {
								text: 'Spieler'
							},
							xAxis: {
								type: 'datetime',
								minRange: 60 * 1000
							},
							yAxis: {
								title: {
									text: 'Spieler'
								}
							},
							plotOptions: {
								line: {
									marker: {
										radius: 2
									},
									lineWidth: 2,
									states: {
										hover: {
											lineWidth: 2,
										}
									}
								}
							},
							series: [{
							
							name: 'Spieler',
								pointInterval: 60 * 1000,
								pointStart: <?php echo(strtotime($data_history['timestamp'][0])) * 1000; ?>,
								data: <?php echo (json_encode($data_history['players'])); ?>,
							}]
						})

						$('#history_chart_ram').highcharts({
							chart: {
								zoomType: 'x'
							},
							title: {
								text: 'Speicherauslastung'
							},
							xAxis: {
								type: 'datetime',
								minRange: 60 * 1000
							},
							yAxis: {
								title: {
									text: 'MB'
								}
							},
							plotOptions: {
								line: {
									marker: {
										radius: 2
									},
									lineWidth: 2,
									states: {
										hover: {
											lineWidth: 2,
										}
									}
								}
							},
							series: [{
							
							name: 'RAM',
								pointInterval: 60 * 1000,
								pointStart: <?php echo(strtotime($data_history['timestamp'][0])) * 1000; ?>,
								data: <?php echo (json_encode($data_history['ram'])); ?>,
							}]
						})
					});
			</script>
		</div>
	</div>
</div>