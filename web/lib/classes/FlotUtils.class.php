<?php

class FlotUtils {
	public static function ConvertArrayIntoData($array, $names){

		$result = '';

		foreach($array as $x){
			$result .= '{';
			$z = 0;
			foreach($x as $y){
				$result .= '"' . $names[$z] . '":' . $y;
				$result .= ",";
				$z++;
			}
			$result = rtrim($result, ',');
			$result .= '},';
		}
		$result = rtrim($result, ',');
		$result .= '';

		return ($result);
	}
}

?>