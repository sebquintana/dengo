<?php 

use Dengo\TrendingWords\TrendingWords;
use Dengo\TrendingNews\TrendingNews;
use Dengo\News\INewsRepository;
use Dengo\Text\TextCleaner;

class TrendingWordsController extends \BaseController {

	protected $textCleaner;
	protected $trendingNews;
	protected $newsRepository;

	public function __construct(TextCleaner $textCleaner, TrendingNews $trendingNews, INewsRepository $newsRepository) {

		$this->textCleaner = $textCleaner;
		$this->trendingNews = $trendingNews;
		$this->newsRepository = $newsRepository;
	}

	public function createTrendingWords(){

		$trendingWordsArray = array();
		$latestsTitlesArray = $this->textCleaner->cleanArray($this->trendingNews->getNewsTitles($this->newsRepository->getLatestsNews()));
		$position = 0;
		$wordFind = false;
		foreach ($latestsTitlesArray as $title) {
			$titleWordsArray = explode(" ", $title);
			foreach ($titleWordsArray as $word) {
				if(strlen($word) > 3){
                    foreach ($trendingWordsArray as $trendingWord) {
                        if(strcasecmp($trendingWord->word, $word) == 0){
                            $wordFind = true;
                            $trendingWord->weight = $trendingWord->weight + 1;
                        }
                    }
                    if(!$wordFind){
                        $newWord = new TrendingWords();
                        $newWord->id = md5($word);
                        $newWord->word = $word;
                        $newWord->weight = 0;
                        $trendingWordsArray[$position] = $newWord;
                        $position++;
                    }
                    $wordFind = false;
                }  
            }
        }
		$this->saveAllTrendingWords($trendingWordsArray);
	}

	public function saveAllTrendingWords($trendingWordsArray){
		
		TrendingWords::where('id', '!=', '0')->delete();
		foreach ($trendingWordsArray as $word) {
				if($word->weight > 0){
					$word->save();
				}
		}
	}

}