<?php

class HomeController extends BaseController {

	protected $news;
	protected $configurationManager;
	protected $sorter;

	public function __construct(News $news, ConfigurationManager $configurationManager, Sorter $sorter){

		$this->news = $news;
		$this->configurationManager = $configurationManager;
		$this->sorter = $sorter;
	}

	public function index() {
		//$tenTrendingNews = $this->news->where('id', '<', '10')->get();
		$tenTrendingNews = $this->news->where('image', '!=', '')->take(10)->get();
		//return View::make('index', ['tenTrendingNews' => $tenTrendingNews]);
		return View::make('index', array('tenTrendingNews' => $tenTrendingNews));
	}

	public function store () {

		$search = Input::all();

		$validation = Validator::make($search, array('search' => 'required|min:3'));

		if($validation->fails()){
			// en caso de que el texto de busqueda sea < 3, vuelve al index.
			return Redirect::route('index');

		} else {

			return $this->show(Input::get('search'));
		}

		
	}

	public function show($search) {

		$search = $this->search($search, 'peso');
		return View::make('search', array('search' => $search));
	}

	function search($keyword, $metodo){
		$newsArrayKey =  array();
		$i = 0;
		$keywordArray = explode(" ",$keyword);
		$keywordsStringForDBSearch = $this->prepareKeyWordsForDBSearch($keywordArray);
		$dateLimit  = DateManager::getSearchLimit();
		//$newsArrray = $this->news->searchNewsByKeyWord($keywordsStringForDBSearch);
		$newsArrray = $this->news->whereRaw(("MATCH(title,resume) AGAINST(? IN BOOLEAN MODE)"),array($keywordsStringForDBSearch))->get();
		foreach($newsArrray as $news){
			$title = $news->title;
			$resume = $news->resume;
			$pubDate = $news->pubdate;
			$weight = $this->sorter->calculateWeight($keywordArray,$title,$resume,$pubDate);
			if ($weight > 0){
				$news->setWeight($weight);
				$newsArrayKey[$i] = $news;
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