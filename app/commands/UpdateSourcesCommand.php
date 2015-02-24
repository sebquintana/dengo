<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Dengo\Sources\Source;

class UpdateSourcesCommand extends Command {

	private $rssFeedsXmlFile = 'app/properties/rssSources.xml';
	protected $name = 'sources:update';
	protected $description = 'Update the sources database.';

	public function __construct()
	{
		parent::__construct();
	}


	public function fire()
	{
		$this->updateSources($this->rssFeedsXmlFile);
	}

	protected function getArguments()
	{
		return array(
			array('example', InputArgument::OPTIONAL, 'An example argument.'),
		);
	}

	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

	private function updateSources($rssFeedsXmlFile){

		$arrayRss = simplexml_load_file($rssFeedsXmlFile);

		foreach ($arrayRss as $rss) {

				$dbResult = Source::where('shortname', '=', $rss->shortname)->get();
				// Ver como mejorar esto: lo que hace es ver si el resultado es vacio.
				if($dbResult == "[]"){
					$this->info("Inserting a new RSS: " . $rss->name);
					$this->saveSource($rss);
				} else {
					$this->info("RSS already inserted: " . $rss->name);
				}
		}
	}	

	private function saveSource($rss){
		$source = new Source();
		$source->name = $rss->name;
		$source->shortname = $rss->shortname;
		$source->country = $rss->country;
		$source->save();
	}
}