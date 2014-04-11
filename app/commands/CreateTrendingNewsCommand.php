<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateTrendingNewsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'trendingNews:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create the tranding news';

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
		$newsModel = new News();
		$trendingWordsModel = new TrendingWords();
		$trendingNews = new TrendingNews();
		$configurationManager = new ConfigurationManager();
		$textCleaner = new TextCleaner($configurationManager);
		$sorter = new Sorter($configurationManager, $textCleaner);
		$trendingNewsController = new TrendingNewsController($newsModel, $trendingWordsModel, $trendingNews, $sorter);
		$this->info("Creating the trending news.");
		$trendingNewsController->createTrendingNews();
		$this->info("TrendingNews created succesfully.");
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

}