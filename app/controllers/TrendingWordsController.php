<?php

class TrendingWordsController extends \BaseController {

	protected $textCleaner;
	protected $trendingNews;
	protected $news;

	public function __construct(TextCleaner $textCleaner, TrendingNews $trendingNews, News $news) {
		$this->textCleaner = $textCleaner;
		$this->trendingNews = $trendingNews;
		$this->news = $news;
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

	public function createTrendingWords(){
		$trendingWordsArray = array();
		$latestsTitlesArray = $this->textCleaner->cleanArray($this->trendingNews->getNewsTitles($this->news->getLatestsNews()));
		$position = 0;
		$wordFind = false;
		foreach ($latestsTitlesArray as $title) {
			$titleWordsArray = explode(" ", $title);
			foreach ($titleWordsArray as $word) {
				if(strlen($word) > 3){
					if($this->textCleaner->isValidWord($word)){
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
					}
				}
			}
		}
		$this->saveAllTrendingWords($trendingWordsArray);
	}

	public function saveAllTrendingWords($trendingWordsArray){
		TrendingWords::where('id', '!=', '0')->delete();
		foreach ($trendingWordsArray as $word) {
				$word->save();
		}
	}


	// Esta opcion seria para que las palabras vallan sumando puntaje y la tabla se reinicie cada X tiempo 
	// public function saveAllTrengingWords($trendingWordsArray){
	// 	foreach ($trendingWordsArray as $word) {
	// 		$trendingWord = TrendingWords::find($word->id);
	// 		if($trendingWord){
	// 			$trendingWord->weight = $trendingWord->weight + $word->weight;
	// 			$trendingWord->save(); 
	// 		} else {
	// 			$word->save();
	// 		}
	// 	}
	// }
}