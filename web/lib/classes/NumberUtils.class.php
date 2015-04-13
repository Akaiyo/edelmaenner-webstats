<?php
	//Not sure if this class is actually needed or not
	class NumberUtils{
		/**
		* @param number $number to format into Dec format
		*/
		public static function formatDecNumber($number, $dec = 0) {
				return number_format ( $number , $dec , ',' , '.' );

		}

		public static function formatBytes($bytes, $precision = 2) {
			$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		    $bytes = max($bytes, 0); 
		    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		    $pow = min($pow, count($units) - 1); 

		    // Uncomment one of the following alternatives
		     $bytes /= pow(1024, $pow);
		    // $bytes /= (1 << (10 * $pow)); 

		    return round($bytes, $precision) . ' ' . $units[$pow];
		}

		public static function parseTime($time = 0){
			$time = (int)$time;
			$string = '';

			if($time === 0){
				return '&lt; 1 Minute';
			}

			$days = floor($time / 1440);
			$hours = floor(($time - ($days * 1440))/ 60);
			$minutes = $time - (($hours * 60) + ($days * 1440));

			$string .= $days;
			$string .= ($days == 1) ? ' Tag' : ' Tage';

			$string .= ', ';

			$string .= $hours;
			$string .= ($hours == 1) ? ' Stunde' : ' Stunden';

			$string .= ' und ';

			$string .= $minutes;
			$string .= ($minutes == 1) ? ' Minute' : ' Minuten';

			return $string;
		}

		public static function formatLength($distance, $precision = 2){
			$units = array('m', 'km');
			$distance = $distance / 100;
		    $distance = max($distance, 0); 
		    $pow = floor(($distance ? log($distance) : 0) / log(1000)); 
		    $pow = min($pow, count($units) - 1); 

		    // Uncomment one of the following alternatives
		    $distance /= pow(1000, $pow);
		    // $bytes /= (1 << (10 * $pow)); 

		    return round($distance, $precision) . ' ' . $units[$pow];
		
		}
	}
?>