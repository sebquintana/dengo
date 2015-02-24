<?php namespace Dengo\TrendingNews;

use Dengo\TrendingNews\TrendingNews;

interface ITrendingNewsRepository {
	
	public function save(TrendingNews $trendingNews);

	public function all();

	public function deleteAll();
}