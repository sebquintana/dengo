<?php

class TrendingNewsController extends \BaseController {

	protected $news;
	protected $trendingWords;
	protected $trendingNews;

	public function __construct(News $news, TrendingWords $trendingWords, TrendingNews $trendingNews) {
		$this->news = $news;
		$this->trendingWords = $trendingWords;
		$this->trendingNews = $trendingNews;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function createTrendingNews(){
		$trendingNewsArray = array();
		$position = 0;
		$trendingWordsArray = $this->trendingWords->where('weight', '>', '0')->get();
		$latestsNewsArray = $this->news->getLatestsNews();
		foreach ($latestsNewsArray as $news) {
			$trendingNews = new TrendingNews();
			$trendingNews->id = $news->id;
			$trendingNews->weight = $this->calculateWeight($trendingWordsArray, $news->title, $news->resume, $news->pubdate);
			$trendingNewsArray[$position] = $trendingNews;
			$position++;
		}
		$this->saveAllTrendingNews($trendingNewsArray);
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
		$tredingWordsInTitle = 0;
		$tredingWordsInResume = 0;
		foreach ($keywordArray as $keyword) {
			foreach ($titleArray as $titleWord) {
				if(strcasecmp($keyword->word, $titleWord) == 0){
					$tredingWordsInTitle++;
				}
			}
			foreach ($resumeArray as $resumeWord) {
				if(strcasecmp($keyword->word, $titleWord) == 0){
					$tredingWordsInResume++;
				}
			}
		}
		return $tredingWordsInTitle * 3 + $tredingWordsInResume * 1;
	}
} 