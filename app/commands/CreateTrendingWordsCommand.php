<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateTrendingWordsCommand extends Command {

	protected $name = 'trendingWords:create';
	protected $description = 'Create the trending words and save in database';

	public function __construct()
	{
		parent::__construct();
	}

	public function fire()
	{
		$news = new News();
		$trendingNews = new TrendingNews();
		$configManager = new ConfigurationManager();
		$textCleaner = new TextCleaner($configManager);
		$trendingWordsController = new TrendingWordsController($textCleaner, $trendingNews, $news);
		$this->info("Creating the trending words.");
		$trendingWordsController->createTrendingWords();
		$this->info("TrendingWords created succesfully.");
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

}
