<?php
	if($url->segment(2) == false){
			//TODO: Search field or something
			echo "<p>Kein Spieler ausgewählt</p>";
			return;
	}

	$player = $url->segment(2);
?>

<div class="row">
	<div class="col-lg-2">
		<?php echo "<img src=http://cravatar.eu/3d/". $player ."/512.png>"; ?>
	</div>
	<div class="col-lg-10">
		<h1 class="page-header">
			<?php
				echo "Spieler: $player";
			?>
		</h1>
		<div class="row">
			<div class="col-lg-4">
				<ul>
					<li>Platzhalter 1</li>
					<li>Platzhalter 2</li>
					<li>Platzhalter 3</li>
				</ul>
			</div>
			<div class="col-lg-4">
				<ul>
					<li>Platzhalter 4</li>
					<li>Platzhalter 5</li>
					<li>Platzhalter 6</li>
				</ul>
			</div>
			<div class="col-lg-4">
				<ul>
					<li>Platzhalter 7</li>
					<li>Platzhalter 8</li>
					<li>Platzhalter 9</li>
				</ul>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4">
				<ul>
					<li>Platzhalter 10</li>
					<li>Platzhalter 11</li>
					<li>Platzhalter 12</li>
				</ul>
			</div>
			<div class="col-lg-4">
				<ul>
					<li>Platzhalter 13</li>
					<li>Platzhalter 14</li>
					<li>Platzhalter 15</li>
				</ul>
			</div>
			<div class="col-lg-4">
				<ul>
					<li>Spielerstatistik 16</li>
					<li>Spielerstatistik 17</li>
					<li>Spielerstatistik 18</li>
				</ul>
			</div>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<?php
			$query = new PlayerBlockQuery($cfg,$player);
			$query->runQuery();
			$query->displayBlockList();
		?>
	</div>
</div>
