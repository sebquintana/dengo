<?php

class TrendingWordsController extends \BaseController {

	private $news;
	private $textCleaner;

	public function __construct(News $news, TextCleaner $textCleaner) {
		$this->news = $news;
		$this->textCleaner = $textCleaner;
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

	public function getTrendingWords(){

		$trendingWordsArray = array();
		$latestsNewsArray = $this->getLatestsNews();
		$position = 0;
		foreach ($latestsNewsArray as $news) {
			$titleWordsArray = explode(" ", $news->title);
			$resumeWordsArray = explode(" ", $news->resume); 
			foreach ($titleWordsArray as $word) {
				if($this-textCleaner->isValidWord($word)){
					$word = new TrendingWord();
					$trendingWordsArray[$position] = $word;
					$position++;
				}
			}
		}

	}

	public function getLatestsNews(){

		$latestsNewsArray = array();
		$latestsNewsArray = $this->news::where('pubdate', '>=', $this->getDengoDateLimit());
		return $latestsNewsArray;
	}

	public function getDengoDateLimit(){

		$date = new DateTime();
		$date->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
		$date->sub(DateInterval::createFromDateString('12 hour'));
		$dateLimit  = $date->format('Y-m-d H:i:s');
		return ($dateLimit);
	}
}