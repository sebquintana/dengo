<?php

class TextCleaner {
	
	private $unwantedSymbols = array(".",",",")","(","\"","!","¡","\'",":",";","?","¿","=","/","&","#","°","*","¬","|","@","·","~","½","\"","{","[","]","}","\\","“","”");
	
	public function cleanArray($array) {

		$filteredArray = $this->removeUnwantedTermsFromArray($array);
		return $filteredArray;
	}

	public function cleanText($text){
        
		$unwantedWordsArray = $this->getUnwantedWordsArray();
        $cleanText = str_replace($this->getUnwantedSymbolsArray(), "", $text);
        $cleanText = trim($this->normalize($cleanText));
		foreach($unwantedWordsArray as $pattern){
			$pattern = "/(^|\s)" . $pattern . "($|\s)/i";
			$cleanText = preg_replace($pattern, " ", $cleanText);
		}
		return $cleanText;
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

	public function removeUnwantedTermsFromArray($array){
        
		$unwantedWordsArray = $this->getUnwantedWordsArray();
		$filteredArray = array();
		$index = 0;
		foreach($array as $title){
            $filteredTitle = str_replace($this->getUnwantedSymbolsArray(), "", $title);
            $filteredTitle = trim($this->normalize($filteredTitle));
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
		return ltrim($filteredText);
	}
	
	public function removeWhiteSpacesExcess($filteredText){

		return preg_replace('/\s\s+/', ' ', $filteredText);
	}
	
	public function removeUnwantedSymbolsFromString($string){

		return str_replace($this->unwantedSymbols, "", $string);	
	}

	public function normalize ($string){
		
		/*$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðòóôõöøùúûýýþÿRr';
		$modificadas = 'aaaaaaaceeeeiiiidoooooouuuuybsaaaaaaaceeeeiiiidoooooouuuyybyRr';*/
        $originales =  'ÀÇÉÍÓÚÜÝáæçéíóúu';
        $modificadas = 'aceiouuyaceioouu';
		$string = utf8_decode($string);
		$string = strtr($string, utf8_decode($originales), $modificadas);
		return utf8_encode($string);
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

	public function getUnwantedSymbolsArray() {

			return $this->unwantedSymbols;
	}
}