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
			if(strcmp($word, $unwantedWord)){
				return false;
			}
			return true;
		}
		
	}

	public function getUnwantedWordsArray(){
		$unwantedWordsFile = 'properties/unwantedWords.csv';
		$delimiter = ',';
		$enclosure = '"';
		$file = fopen($unwantedWordsFile,"r");
		$unwantedWordsArray = fgetcsv($file,0,$delimiter,$enclosure);
		return ($unwantedWordsArray);
	}

	public function getUnwantedSymbolsArray(){
		$unwantedSymbolsArray = $this->configManager->getArrayCharacters();
		return $unwantedSymbolsArray;
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
		$filteredText = ltrim($filteredText);
		return $filteredText;
	}
	
	public function removeWhiteSpacesExcess($filteredText){
		$filteredText = preg_replace('/\s\s+/', ' ', $filteredText);
		return $filteredText;
	
	}
	
	public function removeUnwantedCharsFromStringForRegex($string){
		$filteredString = str_replace($this->unwantedCharsForRegex, "", $string);
		return($filteredString);
	}
	
	public function removeUnwantedTermsFromString($string){
		$filteredString = str_replace($this->getUnwantedSymbolsArray(), "", $string);
		return($filteredString);
	}
	
	public function normalize ($string){
		$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðòóôõöøùúûýýþÿRr';
		$modificadas = 'aaaaaaaceeeeiiiidoooooouuuuybsaaaaaaaceeeeiiiidoooooouuuyybyRr';
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($originales), $modificadas);
		return utf8_encode($string);
	}
}