<?php

class TrendingNews extends Eloquent{
	
	protected $table = 'trendingNews';

	public $timestamps = false;

	protected $fillable = array('id', 'weight');


	public function getNewsTitles($arrayNews){
		$arrayTitles = array();
		$index = 0;
		foreach ($arrayNews as $news) {
			$title = $news->title;
			$arrayTitles[$index] = $title;
			$index++;
		}
		return ($arrayTitles);
	}

	public function getNewsResumes($arrayNews){
		$arrayResumes = array();
		$index = 0;
		foreach ($arrayNews as $news) {
			$resume = $news->resume;
			$arrayTitles[$index] = $resume;
			$index++;
		}
		return ($arrayResumes);
	}
}