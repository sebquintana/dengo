<?php

class SourceController extends \BaseController {

	private $property = 'config/rssFeeds.xml';

	public function index()
	{
		$sources = Source::all();

		return View::make('sources.sources', ['sources' => $sources]);
	}

	// public function show($Name)
	// {
	// 	$requestedSource;

	// 	$sources = Source::all();	 
	// 	foreach ($sources as $source) {
	// 		if($source->Name == $Name){
	// 			$requestedSource = $source;
	// 		}
	// 	}

	// 	return View::make('sources.show', ['source' => $requestedSource]);
	// }


	public function show($shortname) {
		return Source::where('shortname', '=', $shortname)->get();
	}


	public function create($source) {
		$source = new Source();
		$source->save();
	}
}