<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Dengo\News\EloquentNewsRepository;
use Dengo\Text\TextCleaner;

class UpdateNewsCommand extends Command {

	protected $rssManager;
	protected $newsRepository;
	private $rssFeedsXmlFile = 'app/properties/rssSources.xml';
	protected $name = 'news:update';
	protected $description = 'Update news database.';

	public function __construct()
	{
		parent::__construct();
		$rssParser = new RSSParser();
		$textCleaner = new TextCleaner();
		$this->rssManager = new RSSManager($rssParser, $textCleaner);
		$this->newsRepository = new EloquentNewsRepository();
	}

	public function fire()
	{
		$this->updateNews($this->rssFeedsXmlFile);
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

	function updateNews($rssFeedsXmlFile){
		
		$newsArray = $this->getNews($rssFeedsXmlFile);

		$counter = $this->saveNews($newsArray);

 		$this->info("Number of news added ==> " . $counter);
	}

	/*
	* TODO: probar usando simple pie a ver que pasa .
	*/
	function getNews($rssFeedsXmlFile)
	{
		$this->info("Getting all news");
		return $newsArray = $this->rssManager->getAllNews($rssFeedsXmlFile);
	}

	function saveNews($newsArray)
	{
		$counter = 0;
		$this->info("Saving news");
		foreach ($newsArray as $news){
 			//if(! News::find(md5($news->title . $news->resume))){
 			//	$news->id = md5($news->title . $news->resume);
 			if(! $this->newsRepository->find($news)){
 				$this->newsRepository->save($news);
 				$counter++;
 			}
 		}
 		return $counter;
	}
}