<?php
	//Not sure if this class is actually needed or not
	class NumberUtils{
		/**
		* @param number $number to format into Dec format
		*/
		public static function formatDecNumber($number) {
				number_format ( $number , 0 , ',' , '.' );
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
	}
?>