<?php
	if(!isset($_GET["name"])){
			//TODO: Search field or something
			echo "<p>Kein Spieler ausgewählt</p>";
			echo "<p>Hänge &name=Spielername an die Abfrage";
			return;
	}

	$player = $_GET["name"];
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<?php
				echo "Spieler: $player";
			?>
			</h1>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<?php
			$query = new BlockQuery($cfg,$player);
			$query->runQuery();
			$query->displayBlockList();
		?>
	</div>
</div>
