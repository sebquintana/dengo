<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateSourcesCommand extends Command {

	private $rssFeedsXmlFile = 'app/properties/rssFeeds.xml';
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'sources:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update the sources database.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//$this->comment("hola");

		$this->validateAllSourcesExistOnDB($this->rssFeedsXmlFile);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::OPTIONAL, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
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