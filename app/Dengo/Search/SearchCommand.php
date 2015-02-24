<?php namespace Dengo\Search;

class SearchCommand {
	/*
	* DTO
	*/

	public $words;

	function __construct($words)
	{
		$this->words = $words;
	}
}