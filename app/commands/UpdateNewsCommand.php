<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateNewsCommand extends Command {

	protected $rssManager;
	private $rssFeedsXmlFile = 'app/properties/rssFeeds.xml';
	protected $name = 'news:update';
	protected $description = 'Update news database.';

	public function __construct()
	{
		parent::__construct();
		$rssParser = new RSSParser();
		$configManager = new ConfigurationManager();
		$this->rssManager = new RSSManager($rssParser, $configManager);
	}

	public function fire()
	{
		$this->saveAllNewsFromONlineRss($this->rssFeedsXmlFile);
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

	function saveAllNewsFromONlineRss($rssFeedsXmlFile){
		$this->info("Getting all news");
		$newsArray = $this->rssManager->getAllNewsFromRemote($rssFeedsXmlFile);
		$counter = 0;
		$this->info("Saving news");
		foreach ($newsArray as $news){
 				if(! News::find(md5($news->title . $news->resume))){
 					$news->id = md5($news->title . $news->resume);
 					$news->save();
 					$counter++;
 				}
 		}
 		$this->info("Number of news added ==> " . $counter);
	}
}