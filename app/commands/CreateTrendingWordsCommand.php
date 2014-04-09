<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateTrendingWordsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'trendingWords:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create the trending words and save in database';

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
		$configManager = new ConfigurationManager();
		$textCleaner = new TextCleaner($configManager);
		$trendingWordsController = new TrendingWordsController($newsModel, $textCleaner);
		$this->info("Creating the trending words.");
		$trendingWordsController->createTrendingWords();
		$this->info("TrendingWords created succesfully.");
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
