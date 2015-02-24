<?php namespace Dengo\Search;

use Laracasts\Commander\CommandHandler;
use Dengo\News\INewsRepository;
use Dengo\Text\TextCleaner;
use Dengo\Order\Sorter;
use Dengo\TrendingWords\TrendingWords;
use Dengo\TrendingNews\TrendingNews;

class SearchCommandHandler implements CommandHandler{

	protected $newsRepository;
	protected $sorter;
	protected $textCleaner;

	function __construct(INewsRepository $newsRepository, Sorter $sorter, TextCleaner $textCleaner)
	{
		$this->newsRepository = $newsRepository;
		$this->sorter = $sorter;
		$this->textCleaner = $textCleaner;
	}

	public function handle($command)
	{
		$newsArray = array();
		$searchWordsArray = array();
		$position = 0;

		foreach ($command->words as $word) {
			$trendingWord = new TrendingWords();
			$trendingWord->word = $word;
			array_push($searchWordsArray, $trendingWord);
		}

		$searchNews = $this->newsRepository->getSearchNews();
		
		foreach ($searchNews as $news) {
			$weight = $this->sorter->calculateTrendingNewsWeight($searchWordsArray, $this->textCleaner->cleanText($news->title), $this->textCleaner->cleanText($news->resume), $news->pubdate, $news->image);
			if($weight > 0){
				$trendingNews = new TrendingNews();
				$trendingNews->id = $news->id;
				$trendingNews->weight = $weight;
				$newsArray[$position] = $trendingNews;
				$position++;
			}
		}
		return $this->sorter->sortByWeight($newsArray);
	}
}