<?php namespace Dengo\TrendingNews;

use Dengo\TrendingNews\TrendingNews;

class EloquentTrendingNewsRepository implements ITrendingNewsRepository {
	
	public function save(TrendingNews $trendingNews)
	{
		$trendingNews->save();
	}

	public function all()
	{
		return TrendingNews::orderBy('weight', 'desc')->get();
	}

	public function deleteAll()
	{
		TrendingNews::truncate();
	}
}