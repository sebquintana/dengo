<?php

class News extends Eloquent {

	public $timestamps = false;
	//protected $fillable = array('id', 'title', 'Re');	
	protected $guarded = array('id');

	protected $table = 'news';

	public function getLatestsNews(){
		$latestsNewsArray = array();
		$latestsNewsArray = $this->where('pubdate', '>=', DateManager::getDengoDateLimit())->get();
		return $latestsNewsArray;
	}
}