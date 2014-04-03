<?php

class DateManager {

	public static function getStrDateTime(){
	
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		setlocale(LC_ALL, 'es_ES');
		$dateLc = strftime('%A %d de %B de %Y');
		$date = ucwords($dateLc);
		return  utf8_encode($date);
	}
	
	public static function convertToSql ($rssPubDate){
		//$date = date('Y-m-d H:i:s', strtotime($rssPubDate));
		$date = new DateTime($rssPubDate);
		$date->format('Y-m-d H:i:s');
		$now = new DateTime();
		$now->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
		$now->format('Y-m-d H:i:s');
		$diff = ($date >= $now);
		if ( $diff){
			//$hour = $now->format('H');
			//$min = $now->format('i');
			//$date->setTime($hour, $min);
			$date = $now;
		}
		return $date->format('Y-m-d H:i:s');;
	}
	
	public static function convertToPhp ($rssPubDate){
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$date = strftime("%d-%m-%Y %H:%M", strtotime($rssPubDate));
		return $date;
	}

	public static function getYesterdayDateLimit(){
		//Set Date Limit to only show last 24 hs news
		//date_default_timezone_set('America/Argentina/Buenos_Aires');
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
		$date->add(DateInterval::createFromDateString('yesterday'));
		$dateLimit  = $date->format('Y-m-d H:i:s');
		return ($dateLimit);
	}
	public static function getDengoDateLimit(){
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
		$date->sub(DateInterval::createFromDateString('6 hour'));
		$dateLimit  = $date->format('Y-m-d H:i:s');
		return ($dateLimit);
	}
	
	public static function getSearchLimit(){
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
		$date->sub(DateInterval::createFromDateString('3 day'));
		$dateLimit  = $date->format('Y-m-d H:i:s');
		return ($dateLimit);
	}
}