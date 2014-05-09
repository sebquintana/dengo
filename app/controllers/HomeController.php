<?php

class HomeController extends BaseController {

	protected $news;
	protected $textCleaner;
	protected $sorter;
	protected $trendingNews;

	public function __construct(News $news, TextCleaner $textCleaner, Sorter $sorter, TrendingNews $trendingNews){

		$this->news = $news;
		$this->textCleaner = $textCleaner;
		$this->sorter = $sorter;
		$this->trendingNews = $trendingNews;
	}

	public function index() {

		$trendingNewsIdArray = $this->trendingNews->where('weight', '>', '1')->orderBy('weight', 'DESC')->take(30)->get();
		$tenTrendingNews = array();
		$index = 0;
		foreach ($trendingNewsIdArray as $trendingNews) {
			$tenTrendingNews[$index] = $this->news->find($trendingNews->id);
			$index++;
		}
		return View::make('index', array('tenTrendingNews' => $tenTrendingNews));
	}

	public function store () {

		$search = Input::all();

		$validation = Validator::make($search, array('search' => 'required|min:3'));

		if($validation->fails()){
			return Redirect::route('index');
		} else {
			return $this->show(Input::get('search'));
		}
	}

	public function show($search) {

		$trendingNewsSearch = $this->search($search);
		$search = array();
		$index = 0;
		foreach ($trendingNewsSearch as $trendingNews) {
			$search[$index] = $this->news->find($trendingNews->id);
			$search[$index]->pubdate = $this->trendingNews->formatPubdate($search[$index]->pubdate);
			$index++;
		}
		return View::make('search', array('search' => $search));
	}

    /*
     *  @Return : otra opcion seria devolver, el resultado de la query ordenado por peso.
     */
	public function search($keyword){

		$newsArrayKey =  array();
		$i = 0;
		$keywordArray = explode(" ",$keyword);
		$keywordsStringForDBSearch = $this->prepareKeyWordsForDBSearch($keywordArray);
		$newsArrray = $this->news->whereRaw(("MATCH(title,resume) AGAINST(? IN BOOLEAN MODE)"),array($keywordsStringForDBSearch))->orderBy('pubdate', 'DESC')->get();
		$minRelationNeeded = 1;
		if(count($keywordArray) < 2){
			$minRelationNeeded = 0;
		}

		foreach($newsArrray as $news){
			$newsRelatedByTitle = $this->sorter->newsAreRelated($news->title,$keyword,$minRelationNeeded);
			$newsRelatedByResume = $this->sorter->newsAreRelated($news->resume,$keyword,$minRelationNeeded);
			if($newsRelatedByTitle || $newsRelatedByResume){
				$trendingNews = new TrendingNews();
				$trendingNews->id = $news->id;
				$newsArrayKey[$i] = $trendingNews;
				$i = $i + 1;
			}
		}
		return $newsArrayKey;
	}

	private function prepareKeyWordsForDBSearch($keywordArray){

		$keywordsStringForDBSearch = '';
		foreach ($keywordArray as $kw){
			$key = $this->textCleaner->cleanText($kw);
			$keywordsStringForDBSearch = $keywordsStringForDBSearch . '%'.$key.'%' . ' ';
		}
		return ($keywordsStringForDBSearch);
	}

}