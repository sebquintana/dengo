<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateSourcesCommand extends Command {

	private $rssFeedsXmlFile = 'app/properties/rssFeeds.xml';
	protected $name = 'sources:update';
	protected $description = 'Update the sources database.';

	public function __construct()
	{
		parent::__construct();
	}


	public function fire()
	{
		$this->validateAllSourcesExistOnDB($this->rssFeedsXmlFile);
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

	private function validateAllSourcesExistOnDB($rssFeedsXmlFile){
		$arrayRss = simplexml_load_file($rssFeedsXmlFile);
		foreach ($arrayRss as $rss) {
				$this->sourceIsLoadedInDB($rss);
		}
	}	

	private function sourceIsLoadedInDB($rss){
		$rssShortName = $rss->shortname;
		if(Source::where('shortname', '=', $rssShortName)->get() == false){
			$this->info("Inserting a new RSS : " . $rss->shortname);
			$this->insertNewSource($rss);
		} else {
			$this->info("RSS already inserted : " . $rss->shortname);
		}
	}

	private function insertNewSource($rss){
		$source = new Source();
		$source->name = $rss->name;
		$source->shortname = $rss->shorName;
		$source->type = $rss->type;
		$source->save();
	}
}