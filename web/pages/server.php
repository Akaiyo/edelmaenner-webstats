<?php
$page = new Server($cfg);

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
							<?php echo $page->GetPlayers(); ?>
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
							20
						</div>
						<div>
							Ticks per Seconds
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
						<th>Version</th>
						<td>1.8</td>
					</tr>
					<tr>
						<th>Server-Software</th>
						<td>1.8</td>
					</tr>
					<tr>
						<th>Maximale Spieler</th>
						<td>1.8</td>
					</tr>
					<tr>
						<th>Kartengröße</th>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>