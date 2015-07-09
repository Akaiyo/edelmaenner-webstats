<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Topliste</h1>
	</div>
</div>

<?php
	$page = $url->segment(2);

	$Players = new MinecraftPlayers($sql_lb, $cfg);
	$Players->GetPLayerNameByUUID('test');

	if($page == 'blocks'){

		$query =  ToplistQueryFactory::build("BlockQuery",$cfg);
		$query->runQuery();
		$query->displayResult();

	}else{

		$Stats = new PageToplist($sql_stats);
		$result = $Stats->GetOrderedList('stat.playOneMinute');

		?>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Spielzeit</th>
								<th>Blöcke zerstört</th>
								<th>Blöcke gebaut</th>
								<th>Kreaturen getötet</th>
								<th>Gegenstände weggeworfen</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$x = 1;
							foreach($result as $record){
								$playername = $Players->GetPlayerNameByUUID($record['uuid']);
								echo("<tr>");
								echo("<td>" . $x . "</td>");
								echo('<td><img src="http://cravatar.eu/avatar/' . $playername . '/16.png"> <a href="' . SITE_URL . 'player/' . $playername . '">' . $playername . '</a></td>');
								echo("<td>" . NumberUtils::parseTime($record['stat.playOneMinute']/20 / 60) . "</td>");
								echo("</tr>");
								$x++;
							}

							?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
?>


<?php

?>
