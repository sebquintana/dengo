<?php namespace Dengo\News;

use Dengo\Dates\DateManager;

class News extends \Eloquent {

	protected $table = 'news';

	public $timestamps = false;

	public function getLatestsNews(){
		return $this->where('pubdate', '>=', DateManager::getDengoDateLimit())->get();
	}

	public function scopeSearchDate($query){
        return $query->where('pubdate', '>=', DateManager::getSearchLimit());
    }
}