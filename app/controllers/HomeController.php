<?php

class HomeController extends BaseController {

	protected $news;
	protected $configurationManager;
	protected $sorter;
	protected $trendingNews;

	public function __construct(News $news, ConfigurationManager $configurationManager, Sorter $sorter, TrendingNews $trendingNews){

		$this->news = $news;
		$this->configurationManager = $configurationManager;
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

		$trendingNewsSearch = $this->search($search, 'peso');
		$search = array();
		$index = 0;
		foreach ($trendingNewsSearch as $trendingNews) {
			$search[$index] = $this->news->find($trendingNews->id);
			$index++;
		}
		return View::make('search', array('search' => $search));
	}

	public function search($keyword, $metodo){

		$newsArrayKey =  array();
		$i = 0;
		$keywordArray = explode(" ",$keyword);
		$keywordsStringForDBSearch = $this->prepareKeyWordsForDBSearch($keywordArray);
		// agregar el limite de tiempo a la busqueda
		//$dateLimit  = DateManager::getSearchLimit();
		$newsArrray = $this->news->whereRaw(("MATCH(title,resume) AGAINST(? IN BOOLEAN MODE)"),array($keywordsStringForDBSearch))->get();
		foreach($newsArrray as $news){
			$weight = $this->sorter->calculateWeight($keywordArray,$news->title,$news->resume,$news->pubdate);
			if ($weight > 0){
				$trendingNews = new TrendingNews();
				$trendingNews->weight = $weight;
				$trendingNews->id = $news->id;
				$newsArrayKey[$i] = $trendingNews;
				$i = $i + 1;
			}
		}
		$sortedNewsArrayKey = $this->sorter->NewsSort($newsArrayKey,$metodo);
		return ($sortedNewsArrayKey);
	}

	private function prepareKeyWordsForDBSearch($keywordArray){

		$keywordsStringForDBSearch = '';
		foreach ($keywordArray as $kw){
			$key = str_replace($this->configurationManager->getArrayCharacters(), "", $kw);
			$keywordsStringForDBSearch = $keywordsStringForDBSearch . '%'.$key.'%' . ' ';
		}
		return ($keywordsStringForDBSearch);
	}

}