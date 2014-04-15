<?php

class ConfigurationManager {

	public function getArrayCharacters() {

		$arrayUnwantedCharacters = array(
		".",
		",",
		")",
		"(",
		"\"",
		"!",
		"\'",
		":",
		";",
		"?",
		"¡",
		"=",
		"/",
		"&",
		"#",
		"°",
		"*",
		"¬",
		"|",
		"@",
		"·",
		"~",
		"½",
		"\"",
		"{",
		"[",
		"]",
		"}",
		"\\",
		);
		return $arrayUnwantedCharacters;
	}
	
	public function getArrayAcronim(){
	
		$arrayAcronims = array(
		"EE.UU.",
		"L.A.",
		);
		return $arrayAcronims;
	}
	
	public function getArrayReplaceAcronim(){

		$arrayReplaceAcronim = array(
		"EEUU",
		"LA",
		);
		return $arrayReplaceAcronim;
	}
	
	public function getArticles(){
		
		$articles = array(
		'el',
		'la',
		'los',
		'las',
		'en',
		'una',
		'unos',
		'unas',
		'lo',
		'al',
		'de',
		'del',
			);
		return $articles;
	}
}