<?php

use Dengo\TrendingNews\TrendingNews;
use Dengo\TrendingNews\ITrendingNewsRepository;
use Dengo\TrendingWords\ITrendingWordsRepository;
use Dengo\News\INewsRepository;
use Dengo\Text\TextCleaner;
use Dengo\Order\Sorter;

class TrendingNewsController extends \BaseController {

	protected $sorter;
	protected $textCleaner;
	protected $trendingNewsRepository;
	protected $trendingWordsRepository;
	protected $newsRepository;

	public function __construct(Sorter $sorter, TextCleaner $textCleaner, ITrendingNewsRepository $trendingNewsRepository, ITrendingWordsRepository $trendingWordsRepository, INewsRepository $newsRepository ) {

		$this->textCleaner = $textCleaner;
		$this->sorter = $sorter;
		$this->trendingNewsRepository = $trendingNewsRepository;
		$this->trendingWordsRepository = $trendingWordsRepository;
		$this->newsRepository = $newsRepository;
	}

	public function index()
	{
		$trendingNewsArray = $this->trendingNewsRepository->all();

		$newsArray = $this->newsRepository->getNewsArrayById($trendingNewsArray);
		
		return View::make('pages.home', compact('newsArray'));
	}

	public function createTrendingNews(){

		$trendingNewsArray = array();
		$position = 0;
		
		$trendingWordsArray = $this->trendingWordsRepository->all();
		$latestsNewsArray = $this->newsRepository->getLatestsNews();
		
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

		$this->trendingNewsRepository->deleteAll();

		foreach ($trendingNewsArray as $news) {
				$this->trendingNewsRepository->save($news);
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
			$news = $this->newsRepository->findById($trendingNews->id);
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