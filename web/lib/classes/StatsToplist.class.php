<?php

class StatsToplist {
	private $sql;

	function __construct($sql){
		$this->sql = $sql;
	}

	function GetOrdered($item, $order = "DESC"){
		if($order != "ASC" | $order != "DESC"){
			$order = "DESC";
		}

		$result = $this->sql->query_all("SELECT `uuid`, `" . $item . "` FROM players WHERE `" . $item . "`!=0 ORDER BY `" . $item . "` " . $order);

		return $result;
	}
}