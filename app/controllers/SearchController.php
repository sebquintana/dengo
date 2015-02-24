<?php

use Dengo\Forms\SearchForm;
use Dengo\Core\CommandBus;
use Dengo\Search\SearchCommand;
use Dengo\News\INewsRepository;

class SearchController extends \BaseController {

	use CommandBus;
	
	private $searchForm;
	private $newsRepository;

	function __construct(SearchForm $searchForm, INewsRepository $newsRepository)
	{
		$this->searchForm = $searchForm;
		$this->newsRepository = $newsRepository;
	}

	public function store()
	{

		$searchInput = Input::only('search');

		$this->searchForm->validate($searchInput);

		$wordsArray = explode(" " , implode(" ", $searchInput));

		$searchedNews = $this->newsRepository->getNewsArrayById($this->execute(new SearchCommand($wordsArray)));

		return View::make('search.index', compact('searchedNews'))->with('searchInput', implode(" ", $searchInput));
	}		

	public function show($title)
	{
		$wordsArray = explode(" " , $title);

		$searchedNews = $this->newsRepository->getNewsArrayById($this->execute(new SearchCommand($wordsArray)));

		return View::make('search.index', compact('searchedNews'))->with('searchInput', $title);
	}		
}
