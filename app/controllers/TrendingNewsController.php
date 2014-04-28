<?php

class TrendingNewsController extends \BaseController {

	protected $news;
	protected $trendingWords;
	protected $trendingNews;
	protected $sorter;
	protected $textCleaner;

	public function __construct(News $news, TrendingWords $trendingWords, TrendingNews $trendingNews, Sorter $sorter, TextCleaner $textCleaner) {

		$this->news = $news;
		$this->trendingWords = $trendingWords;
		$this->trendingNews = $trendingNews;
		$this->textCleaner = $textCleaner;
		$this->sorter = $sorter;
	}

	public function createTrendingNews(){

		$trendingNewsArray = array();
		$position = 0;
		$trendingWordsArray = $this->trendingWords->all();
		$latestsNewsArray = $this->news->getLatestsNews();
		foreach ($latestsNewsArray as $news) {
			$weight = $this->sorter->calculateTrendingNewsWeight($trendingWordsArray, $this->textCleaner->cleanText($news->title), $this->textCleaner->cleanText($news->resume), $news->pubdate, $news->image);
			if($weight > 0){
				$trendingNews = new TrendingNews();
				$trendingNews->id = $news->id;
				$trendingNews->weight = $weight;
				$trendingNewsArray[$position] = $trendingNews;
				$position++;
			}
		}
		$this->saveAllTrendingNews($this->removeRelatedNews($trendingNewsArray));
	}

	public function saveAllTrendingNews($trendingNewsArray){

		$this->trendingNews->where('id', '!=', '0')->delete();
		foreach ($trendingNewsArray as $news) {
				$news->save();
		}
	}

	public function calculateWeight($keywordArray,$title,$resume,$pubdate){

		$titleArray = explode(" ", $title);
		$resumeArray = explode(" ", $resume);
		$trendingWordsInTitle = 0;
		$trendingWordsInResume = 0;
		foreach ($keywordArray as $keyword) {
			foreach ($titleArray as $titleWord) {
				if(strcasecmp($keyword->word, $titleWord) == 0){
					$trendingWordsInTitle++;
				}
			}
			foreach ($resumeArray as $resumeWord) {
				if(strcasecmp($keyword->word, $resumeWord) == 0){
					$trendingWordsInResume++;
				}
			}
		}
		return $trendingWordsInTitle * 3 + $trendingWordsInResume * 1;
	}

	public function removeRelatedNews($newsArray){
		
		$filteredArray = array();
		$auxiliarArray = array();
		$newsRelated = false;
		$index = 0;
		$relationLimit = 2;
		foreach ($newsArray as $trendingNews) {
			$news = $this->news->find($trendingNews->id);
			foreach ($auxiliarArray as $otherNews) {
				if($this->sorter->newsAreRelated($news->title, $otherNews->title, $relationLimit)){
					$newsRelated = true;
				}
			}
			if(!$newsRelated){
				$auxiliarArray[$index] = $news;
				$filteredArray[$index] = $trendingNews;
				$index++;
				$newsRelated = false;
			}
		}
		return $filteredArray;
	}
} 