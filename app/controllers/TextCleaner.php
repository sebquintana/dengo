<?php

class TextCleaner {
	
	private $configManager;
	private $unwantedCharsForRegex = array(".","“","”",",",")","(","\"","!","\'",";","?","¡","=","/","&","#","°","*","¬","|","@","·","~","½","{","[","]","}","\\",);
	
	public function __construct(ConfigurationManager $configManager){

		$this->configManager = $configManager;
	}
	
	public function cleanArray($array) {

		$filteredArray = $this->removeUnwantedTermsFromArray($array);
		return $filteredArray;
	}

	public function isValidWord($word) {

		$unwantedWordsArray = $this->getUnwantedWordsArray();
		foreach ($unwantedWordsArray as $unwantedWord) {
			if($word == $unwantedWord){
				return false;
			}
		}
		return true;
	}

	public function getUnwantedWordsArray(){

		$unwantedWordsFile = 'app/properties/unwantedWords.csv';
		$delimiter = ',';
		$enclosure = '"';
		$file = fopen($unwantedWordsFile,"r");
		$unwantedWordsArray = fgetcsv($file,0,$delimiter,$enclosure);
		return $unwantedWordsArray;
	}

	public function getUnwantedSymbolsArray(){

		return $this->configManager->getArrayCharacters();
	}

	public function removeUnwantedTermsFromArray($array){

		$unwantedWordsArray = $this->getUnwantedWordsArray();
		$filteredArray = array();
		$index = 0;
		foreach($array as $title){
			$filteredTitle = str_replace($this->getUnwantedSymbolsArray(), "", $title);
			foreach($unwantedWordsArray as $pattern){
				$pattern = "/(^|\s)" . $pattern . "($|\s)/i";
				$filteredTitle = preg_replace($pattern, " ", $filteredTitle);
			}
			$filteredTitle = $this->normalize($filteredTitle);
			$filteredArray[$index] = $filteredTitle;
			$index++;
		}
		return($filteredArray);
	}
	
	public function removeUnwantedWords($text) {

		$unwantedWordsArray = $this->getUnwantedWordsArray();
		$filteredText = str_replace($this->getUnwantedSymbolsArray(), " ", $text);
		foreach($unwantedWordsArray as $pattern){
			$pattern = "/(^|\s)" . $pattern . "($|\s)/i";
			$filteredText = preg_replace($pattern, " ", $filteredText);
		}
		$filteredText = $this->removeWhiteSpacesExcess($filteredText);
		return ltrim($filteredText);
	}
	
	public function removeWhiteSpacesExcess($filteredText){

		return preg_replace('/\s\s+/', ' ', $filteredText);
	}
	
	public function removeUnwantedCharsFromStringForRegex($string){

		return str_replace($this->unwantedCharsForRegex, "", $string);
	}
	
	public function removeUnwantedTermsFromString($string){

		return str_replace($this->getUnwantedSymbolsArray(), "", $string);
	}
	
	public function normalize ($string){
		
		$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðòóôõöøùúûýýþÿRr';
		$modificadas = 'aaaaaaaceeeeiiiidoooooouuuuybsaaaaaaaceeeeiiiidoooooouuuyybyRr';
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($originales), $modificadas);
		return utf8_encode($string);
	}
}