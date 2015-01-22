<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Topliste</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
			<a class="btn btn-default active" href="toplist/block" role="button" >Blöcke</a>
			<a class="btn btn-default disabled" href="" role="button">Tiere</a>
			<a class="btn btn-default disabled" href="" role="button">Tode</a>
			<a class="btn btn-default disabled" href="" role="button">Chat</a>
			<a class="btn btn-default disabled" href="" role="button">Distanzen</a>
	</div>
</div>

<!--
	### BLOCKS ###
-->

<?php
	$urlquery = $url->segment(2);
	$queryname = isset($urlquery) ? $urlquery : "block" . "Query";

	$query =  ToplistQueryFactory::build("BlockQuery",$cfg);
	$query->runQuery();
	$query->displayResult();

?>


<?php

?>
