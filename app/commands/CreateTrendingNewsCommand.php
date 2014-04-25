<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateTrendingNewsCommand extends Command {

	protected $name = 'trendingNews:create';
	protected $description = 'Create the tranding news';

	public function __construct()
	{
		parent::__construct();
	}

	public function fire()
	{
		$newsModel = new News();
		$trendingWordsModel = new TrendingWords();
		$trendingNews = new TrendingNews();
		$configurationManager = new ConfigurationManager();
		$textCleaner = new TextCleaner($configurationManager);
		$sorter = new Sorter($configurationManager, $textCleaner);
		$trendingNewsController = new TrendingNewsController($newsModel, $trendingWordsModel, $trendingNews, $sorter, $textCleaner);
		$this->info("Creating the trending news.");
		$trendingNewsController->createTrendingNews();
		$this->info("TrendingNews created succesfully.");
		$this->info("...");
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