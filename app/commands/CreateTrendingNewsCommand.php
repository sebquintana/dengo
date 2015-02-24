<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Dengo\TrendingNews\EloquentTrendingNewsRepository;
use Dengo\TrendingWords\EloquentTrendingWordsRepository;
use Dengo\News\EloquentNewsRepository;
use Dengo\Text\TextCleaner;
use Dengo\Order\Sorter;

class CreateTrendingNewsCommand extends Command {

	protected $name = 'trendingNews:create';
	protected $description = 'Create the tranding news';

	public function __construct()
	{
		parent::__construct();
	}

	public function fire()
	{
		$textCleaner = new TextCleaner();
		$sorter = new Sorter($textCleaner);
		$trendingNewsRepository = new EloquentTrendingNewsRepository();
		$trendingWordsRepository = new EloquentTrendingWordsRepository();
		$newsRepository = new EloquentNewsRepository();
		$trendingNewsController = new TrendingNewsController($sorter, $textCleaner,$trendingNewsRepository, $trendingWordsRepository, $newsRepository);
	
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