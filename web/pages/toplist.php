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

		$Stats = new StatsToplist($sql_stats);
		$result = $Stats->GetOrdered('stat.playOneMinute');

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
								<th>Ergebnis</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$x = 1;
							foreach($result as $record){
								echo("<tr>");
								echo("<td>" . $x . "</td>");
								echo("<td>" . $Players->GetPlayerNameByUUID($record['uuid']) . "</td>");
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
