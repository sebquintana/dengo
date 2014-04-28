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

		$date = new DateTime($rssPubDate);
		$date->format('Y-m-d H:i:s');
		$now = new DateTime();
		$now->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
		$now->format('Y-m-d H:i:s');
		if ($date >= $now){
			$date = $now;
		}
		return $date->format('Y-m-d H:i:s');
	}
	
	public static function convertToPhp ($rssPubDate){

		date_default_timezone_set('America/Argentina/Buenos_Aires');
		return strftime("%d-%m-%Y %H:%M", strtotime($rssPubDate));
	}

	public static function getYesterdayDateLimit(){
		//Set Date Limit to only show last 24 hs news
		//date_default_timezone_set('America/Argentina/Buenos_Aires');
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
		$date->add(DateInterval::createFromDateString('yesterday'));
		return  $date->format('Y-m-d H:i:s');
	}

	public static function getDengoDateLimit(){

		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
		$date->sub(DateInterval::createFromDateString('9 hour'));
		return $date->format('Y-m-d H:i:s');
	}
	
	public static function getSearchLimit(){
		
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
		$date->sub(DateInterval::createFromDateString('3 day'));
		return $date->format('Y-m-d H:i:s');
	}

	public static function getNowDate (){

		$now = new DateTime();
		$now->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
		$now->format('Y-m-d H:i:s');
		return $now;
	}
}