<?php
$bans = array_map('str_getcsv', file('stats/bans.csv'));



?>

<div class="row">
	<div class="col-md-12">
		<h1 class="page-header">Sperren (Bans)</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table id="bantable" class="display table" style="width: 100%;">
			<thead>
				<tr>
					<th>Zeitpunkt</th>
					<th>Spieler</th>
					<th>UUID</th>
					<th>Grund</th>
					<th>Dauer</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($bans as $ban){

						$datetime = "";
						$datetime = date("Y/m/d H:i:s", $ban[4]/1000);

						echo('<tr>');
							echo('<td>' . $datetime . '</td>');
							echo('<td>' . $ban[1] . '</td>');
							echo('<td>' . $ban[0] . '</td>');
							echo('<td>' . $ban[3] . '</td>');
							echo('<td>' . $ban[5] . '</td>');
						echo('</tr>');
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
    	$('#bantable').DataTable({
    		"paging": false,
    		"order": [[0, "desc"]]
    	}
    	);
	});
</script>
