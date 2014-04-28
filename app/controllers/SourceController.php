<?php

class SourceController extends \BaseController {

	public function index()
	{
		$sources = Source::all();

		return View::make('sources.sources', ['sources' => $sources]);
	}

	public function show($shortname) {
		return Source::where('shortname', '=', $shortname)->get();
	}


	public function create($source) {
		$source = new Source();
		$source->save();
	}
}