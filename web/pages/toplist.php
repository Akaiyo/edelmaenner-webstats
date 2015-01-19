<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Topliste</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<p>
			In den verschiedenen Toplisten werden die höchsten aber auch auf Wahl die niedriegsten Ergebnisse angezeigt und aufgelistet.<br>
			Auf der rechten Seite lässt sich die gewünschte Kategorie auswählen.
		</p>
	</div>
	<div class="col-md-6">
			<a class="btn btn-default active" href="" role="button" >Blöcke</a>
			<a class="btn btn-default" href="" role="button">Tiere</a>
			<a class="btn btn-default" href="" role="button">Tode</a>
			<a class="btn btn-default" href="" role="button">Chat</a>
			<a class="btn btn-default" href="" role="button">Distanzen</a>
	</div>
</div>

<!--
	### BLOCKS ###
-->

<?php
/*
$sql = 'SELECT playername, SUM(created) AS created, SUM(destroyed) AS destroyed FROM (';
for ($i = 0; $i < count($tables); $i++) {
	$sql .= "(SELECT playerid, count(type) AS created, 0 AS destroyed FROM `$tables[$i]` WHERE type > 0 AND type != replaced $dateClause GROUP BY playerid) UNION (SELECT playerid, 0 AS created, count(replaced) AS destroyed FROM `$tables[$i]` WHERE replaced > 0 AND type != replaced $dateClause GROUP BY playerid)";
	if ($i < count($tables) - 1)
		$sql .= ' UNION ';
}
$where = '';
if (count($excludedPlayers) > 0) {
	$where = 'WHERE ';
	for ($i = 0; $i < count($excludedPlayers); $i++) {
		$where .= "playername != '" . $excludedPlayers[$i] . "' ";
		if ($i < count($excludedPlayers) - 1)
			$where .= 'AND ';
	}
}
$sql .= ') AS t INNER JOIN `lb-players` USING (playerid) ' . $where . 'GROUP BY playerid ORDER BY SUM(created) + SUM(destroyed) DESC';
$result = mysql_query($sql);
*/
?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Spieler</th>
					<th>Gesetzt</th>
					<th>Zerstört</th>
				</tr>
			</thead>
			<tbody>
				<tr>

				</tr>
			</tbody>
		</table>
	</div>
</div>
