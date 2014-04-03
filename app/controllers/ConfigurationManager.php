<?php

class ConfigurationManager {

	function getArrayCharacters() {
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
	
	function getArrayAcronim(){
	
		$arrayAcronims = array(
		"EE.UU.",
		"L.A.",
		);
	return $arrayAcronims;
	}
	
	function getArrayReplaceAcronim(){
		$arrayReplaceAcronim = array(
		"EEUU",
		"LA",
		);
	return $arrayReplaceAcronim;
	}
	
	function getArticles(){
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