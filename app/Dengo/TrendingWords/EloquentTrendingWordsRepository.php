<?php namespace Dengo\TrendingWords;

use Dengo\TrendingWords\TrendingWords;

class EloquentTrendingWordsRepository implements ITrendingWordsRepository {
	
	public function all()
	{
		return TrendingWords::all();
	}
}