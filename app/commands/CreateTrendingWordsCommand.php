<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Dengo\News\EloquentNewsRepository;
use Dengo\TrendingNews\TrendingNews;
use Dengo\Text\TextCleaner;

class CreateTrendingWordsCommand extends Command {

	protected $name = 'trendingWords:create';
	protected $description = 'Create the trending words and save in database';

	public function __construct()
	{
		parent::__construct();
	}

	public function fire()
	{
		$newsRepository = new EloquentNewsRepository();
		$trendingNews = new TrendingNews();
		$textCleaner = new TextCleaner();
		$trendingWordsController = new TrendingWordsController($textCleaner, $trendingNews, $newsRepository);

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
