<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateNewsCommand extends Command {

	protected $rssManager;
	private $rssFeedsXmlFile = 'app/properties/rssFeeds.xml';

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'news:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update news database.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$rssParser = new RSSParser();
		$configManager = new ConfigurationManager();
		$this->rssManager = new RSSManager($rssParser, $configManager);
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->saveAllNewsFromONlineRss($this->rssFeedsXmlFile);
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

	function saveAllNewsFromONlineRss($rssFeedsXmlFile){
		$this->info("Getting all news");
		$newsArray = $this->rssManager->getAllNewsFromRemote($rssFeedsXmlFile);
		$counter = 0;
		$this->info("Saving news");
		foreach ($newsArray as $news){
			//$this->info("en el foreach");
 				if(! News::find(md5($news->title . $news->resume))){
 					//$this->info("en el if");
 					//$this->info("vardump:" . var_dump($news));
 					$news->id = md5($news->title . $news->resume);
 					$news->save();
 					$counter++;
 				}
 		}
 		$this->info("Number of news added ==> " . $counter);
	}
}