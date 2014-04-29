<?php

class TrendingNews extends Eloquent{
	
	protected $table = 'trendingNews';
	protected $fillable = array('id', 'weight');
	public $timestamps = false;


	public function getNewsTitles($arrayNews){

		$arrayTitles = array();
		$index = 0;
		foreach ($arrayNews as $news) {
			$title = $news->title;
			$arrayTitles[$index] = $title;
			$index++;
		}
		return $arrayTitles;
	}

	public function getNewsResumes($arrayNews){

		$arrayResumes = array();
		$index = 0;
		foreach ($arrayNews as $news) {
			$resume = $news->resume;
			$arrayTitles[$index] = $resume;
			$index++;
		}
		return $arrayResumes;
	}

	public function formatPubdate($pubdate){
		$now = DateManager::getNowDate();
		$date = new DateTime($pubdate);
		$format = "%d d";
		if(date_diff($now,$date)->format('%d') < 1){
			if(date_diff($now,$date)->format('%h') < 1){
				$format = "%m m";
			} else {
				$format = "%h h";
			}
		} 
		return date_diff($now,$date)->format($format);
	}
}