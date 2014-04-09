<?php

class TrendingWords  extends Eloquent{
	
	protected $table = 'trendingWords';

	public $timestamps = false;

	protected $fillable = array('id', 'word', 'weight');	
}