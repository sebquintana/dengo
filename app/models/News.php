<?php

class News extends Eloquent {

	public $timestamps = false;
	//protected $fillable = array('id', 'title', 'Re');	
	protected $guarded = array('id');

	protected $table = 'news';

	private $weight;

	public function setWeight($weight) {
		$this->weight = $weight;
	}

	public function getWeight() {
		return $this->weight;
	}
}