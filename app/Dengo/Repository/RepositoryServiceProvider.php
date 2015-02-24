<?php namespace Dengo\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind('Dengo\TrendingNews\ITrendingNewsRepository',
			'Dengo\TrendingNews\EloquentTrendingNewsRepository');

		$this->app->bind('Dengo\TrendingWords\ITrendingWordsRepository',
			'Dengo\TrendingWords\EloquentTrendingWordsRepository');

		$this->app->bind('Dengo\News\INewsRepository',
			'Dengo\News\EloquentNewsRepository');
	}
}