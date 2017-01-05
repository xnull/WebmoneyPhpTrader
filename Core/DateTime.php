<?php
class Core_DateTime {

	public static function toDateTime($value){
		$datetime = new DateTime($value);
		return $datetime->format('Y-m-d H:i:s');
	}
	
	public static function format($value, $format){
		$datetime = new DateTime($value);
		return $datetime->format($format);
	}

	public static function currDatePlusDay($addDay){
		$timestamp = time();
		$date_time_array = getdate($timestamp);

		$hours = $date_time_array['hours'];
		$minutes = $date_time_array['minutes'];
		$seconds = $date_time_array['seconds'];
		$month = $date_time_array['mon'];
		$day = $date_time_array['mday'];
		$year = $date_time_array['year'];

		$timestamp = mktime("0","0","0", $month,$day + $addDay,$year);
		//$result = new DateTime($timestamp);
		$result = date('Ymd H:i:s', $timestamp);
		return $result;
	}
	
	public static function currDateEndDay(){
		$timestamp = time();
		$date_time_array = getdate($timestamp);

		$hours = $date_time_array['hours'];
		$minutes = $date_time_array['minutes'];
		$seconds = $date_time_array['seconds'];
		$month = $date_time_array['mon'];
		$day = $date_time_array['mday'];
		$year = $date_time_array['year'];

		$timestamp = mktime("23","59","59", $month,$day, $year);
		//$result = new DateTime($timestamp);
		$result = date('Ymd H:i:s', $timestamp);
		return $result;
	}

	public static function getNowDate(){
		return date("Y-m-d H:i:s");
	}
	
	
}