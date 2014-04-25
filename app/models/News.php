<?php

class News extends Eloquent {

	public $timestamps = false;
	protected $guarded = array('id');
	protected $table = 'news';

	public function getLatestsNews(){
		return $this->where('pubdate', '>=', DateManager::getDengoDateLimit())->get();
	}

	public function scopeSearchDate($query){
        return $query->where('pubdate', '>=', DateManager::getSearchLimit());
    }

}