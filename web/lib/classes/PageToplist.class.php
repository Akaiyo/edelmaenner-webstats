<?php

class PageToplist {
	private $sql;

	function __construct($sql){
		$this->sql = $sql;
	}

	function GetOrderedList($item, $order = "DESC"){
		if($order != "ASC" | $order != "DESC"){
			$order = "DESC";
		}

		$result = $this->sql->query_all("SELECT `uuid`, `" . $item . "` FROM players WHERE `" . $item . "`!=0 AND uuid NOT LIKE 'log_%' ORDER BY `" . $item . "` " . $order . " LIMIT 50");

		return $result;
	}
}