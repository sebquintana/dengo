<?php

class News extends Eloquent {

	public $timestamps = false;
	protected $guarded = array('id');
	protected $table = 'news';

	public function getLatestsNews(){
		$latestsNewsArray = array();
		$latestsNewsArray = $this->where('pubdate', '>=', DateManager::getDengoDateLimit())->get();
		return $latestsNewsArray;
	}

	public function scopeSearchDate($query){
        return $query->where('pubdate', '>=', DateManager::getSearchLimit());
    }

}