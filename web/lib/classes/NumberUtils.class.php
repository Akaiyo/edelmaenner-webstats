<?php
	//Not sure if this class is actually needed or not
	class NumberUtils{
		/**
		* @param number $number to format into Dec format
		*/
		public static function formatDecNumber($number) {
				number_format ( $number , 0 , ',' , '.' );
		}
	}
?>
