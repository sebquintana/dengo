<?php

class Sorter {

	private $configManager;
	private $textCleaner;
	
	public function __construct(ConfigurationManager $configurationManager,TextCleaner $textCleaner){

		$this->configManager = $configurationManager;
		$this->textCleaner = $textCleaner;
	}
	
	public function NewsSort($array,$method){

		switch ($method) {
			case "diario":
				$sortedArray = $this->sortBySourceName($array);
				break;
			case "peso":
				$sortedArray = $this->sortByWeight($array);
				break;
		}
		return ($sortedArray);
	}

	public function sortByWeight($array){

		if (count($array)< 2) {
			return $array;
		}
		$pivot = $array[0];
		$left = $right = array();
		for ($i = 1; $i < count($array); $i++) {
			if ($array[$i]->weight > $pivot->weight){
				$left[] = $array[$i];
			}
			else{
				$right[] = $array[$i];
			}
		}
		return array_merge($this->sortByWeight($left), array($pivot), $this->sortByWeight($right));
	}

	public function sortBySourceName($array){

		if (count($array)< 2) {
			return $array;
		}
		usort($array, "cmp");
		return $array;
	}

	//The comparison function must return an integer less than, equal to, or greater than zero if the first argument is
	//considered to be respectively less than, equal to, or greater than the second.
	function cmp($a, $b){
		$ret_value;
		//Returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal.
		$string_ret_val = strcmp($a->getSource(), $b->getSource());

		//si son iguales, pregunto por el peso
		if ($string_ret_val == 0){
			if ($a->getWeight() == $b->getWeight()){
				$ret_value = 0;
			}
			else{
				$ret_value = ($a->getWeight() < $b->getWeight()) ? -1 : 1;
			}
		}
		//sino utilizo el valor devuelto por strcmp
		else{
			$ret_value = $string_ret_val;
		}
		return $ret_value;
	}
	
	public function calculateWeight($keywordArray,$title,$resume,$pubDate){

		$titleWeight=0;
		$resumeWeight=0;
		$multiplyFactorTitle = 2;
		$base = 1;
		$multiplyFactorResume = 1;
		$wordsInTitle = explode(" ",$title);
		$wordsInResume = explode(" ",$resume);
		$keywordArraySize=count($keywordArray);
		$wordsInTitleSize = count($wordsInTitle);
		$wordsInResumeSize  = count($wordsInResume);
		$maxTitleWeight = $keywordArraySize * $multiplyFactorTitle;
		$maxResumeWeight = $keywordArraySize * $multiplyFactorResume;
		foreach($keywordArray as $kw){
			$titleIndex = 0;
			$resumeIndex = 0;
			$foundInTitle = false;
			$foundInResume = false;
			while(!$foundInTitle && $titleIndex < $wordsInTitleSize){
				$foundInTitle = $this->searchString($kw,$wordsInTitle[$titleIndex]);
				$titleIndex++;
			}
			if ($foundInTitle){
				$titleWeight = $titleWeight + ($base * $multiplyFactorTitle);
			}
			while(!$foundInResume && $resumeIndex < $wordsInResumeSize){
				$foundInResume = $this->searchString($kw,$wordsInResume[$resumeIndex]);
				$resumeIndex++;
			}
			if ($foundInResume){
				$resumeWeight = $resumeWeight + ($base * $multiplyFactorResume);
			}
		}
		
		$titleKeyWordMatchPercentage = ($titleWeight * 100) / $maxTitleWeight;
		$resumeKeyWordMatchPercentage = ($resumeWeight * 100) / $maxResumeWeight;
		
		if ($titleKeyWordMatchPercentage == 100){
			$bonusTitleMatch = 3;
		}
		else{
			$bonusTitleMatch = 0;
		}
		
		if ($resumeKeyWordMatchPercentage == 100){
			$bonusResumeMatch = 2;
		}
		else{
			$bonusResumeMatch = 0;
		}
		
		$titleWeight = $titleWeight + $bonusTitleMatch;
		$resumeWeight = $resumeWeight + $bonusResumeMatch;
		$weight = $titleWeight + $resumeWeight;
		if ($weight > 0){
			$weight = $weight + $this->calculateTimeBonus($pubDate);
		}
		return($weight);
	}

	public function calculateTrendingNewsWeight($keywordArray,$title,$resume,$pubDate,$image){

		$titleWeight=0;
		$resumeWeight=0;
		$multiplyFactorTitle = 2;
		$base = 1;
		$multiplyFactorResume = 1;
		$wordsInTitle = explode(" ",$title);
		$wordsInResume = explode(" ",$resume);
		$keywordArraySize=count($keywordArray);
		$wordsInTitleSize = count($wordsInTitle);
		$wordsInResumeSize  = count($wordsInResume);
		$maxTitleWeight = $keywordArraySize * $multiplyFactorTitle;
		$maxResumeWeight = $keywordArraySize * $multiplyFactorResume;
		foreach($keywordArray as $kw){
			$titleIndex = 0;
			$resumeIndex = 0;
			$foundInTitle = false;
			$foundInResume = false;
			while(!$foundInTitle && $titleIndex < $wordsInTitleSize){
				 $foundInTitle = $this->searchString($kw->word,$wordsInTitle[$titleIndex]);

				$titleIndex++;
			}
			if ($foundInTitle){
				$titleWeight = $titleWeight + ($base * $multiplyFactorTitle);
			}
			while(!$foundInResume && $resumeIndex < $wordsInResumeSize){
				$foundInResume = $this->searchString($kw,$wordsInResume[$resumeIndex]);
				$resumeIndex++;
			}
			if ($foundInResume){
				$resumeWeight = $resumeWeight + ($base * $multiplyFactorResume);
			}
		}
		
		$titleKeyWordMatchPercentage = ($titleWeight * 100) / $maxTitleWeight;
		$resumeKeyWordMatchPercentage = ($resumeWeight * 100) / $maxResumeWeight;
		
		if ($titleKeyWordMatchPercentage == 100){
			$bonusTitleMatch = 3;
		}
		else{
			$bonusTitleMatch = 0;
		}
		
		if ($resumeKeyWordMatchPercentage == 100){
			$bonusResumeMatch = 2;
		}
		else{
			$bonusResumeMatch = 0;
		}
		
		$titleWeight = $titleWeight + $bonusTitleMatch;
		$resumeWeight = $resumeWeight + $bonusResumeMatch;
		$weight = $titleWeight + $resumeWeight;
		if ($weight > 0){
			$weight = $weight + $this->calculateTimeBonus($pubDate);
		}
		if(!is_null($image)){
			$weight = $weight * 2;
		}
		return($weight);
	}


	public function searchString($kw,$texto){

		$found = FALSE;
		$key = str_replace($this->configManager->getArrayCharacters(), "", $kw);
		$key = $this->textCleaner->normalize($key);
		$text = str_replace($this->configManager->getArrayCharacters(), "", $texto);
		$text = $this->textCleaner->normalize($text);
		if(stripos($text,$key) !== FALSE){
			$longitud_kw = strlen($key);
			$longitud_text = strlen($text);
			if ($longitud_kw !== $longitud_text){
				$found = FALSE;
			}else{
				$found = TRUE;
			}
		}
		return ($found);
	}
	
	public function calculateTimeBonus($pubDate){

		$phpPubDate = DateManager::convertToPhp($pubDate);
		$currentDate = date('d-m-Y H:i');
		$timeDelta = strtotime($currentDate) - strtotime($phpPubDate);
		$timeDeltainMins = $timeDelta / 60;
		
		if($timeDeltainMins < 30){
			$timeBonus = 2;
		}
		else{
			if ($timeDeltainMins < 60){
				$timeBonus = 1;
			}
			else{
				$timeBonus = 0;
			}
		}
		return ($timeBonus);
	}

	public function newsAreRelated($title,$otherTitle){

		$relationshipLimit = 3;
		$newsKWs =  $this->checkAndCombineWordArray(explode(" ",$title));
		$otherNewsKW =  $this->checkAndCombineWordArray(explode(" ",$otherTitle));
		$wordsInCommon = array_uintersect($newsKWs, $otherNewsKW, 'strcasecmp');
		return count($wordsInCommon) > $relationshipLimit;
	}
		
	
	
	public function checkAndCombineWordArray($titleWordsArray){
		
		$combinedTitleWordsArray = array();
		$limit = count ($titleWordsArray);
		$index=0;
		while ($index < $limit){
			$currentWord = $this->textCleaner->removeUnwantedCharsFromStringForRegex($titleWordsArray[$index]);
			$result = preg_match_all('"([A-Z][a-zA-Z]*)+[^:]$"', $currentWord, $arr, PREG_PATTERN_ORDER);
			if ($result > 0){
				$index++;
				$combinedWord=$currentWord;
				while ($result > 0 && ($index +1) <= $limit){
					$nextWord = $this->textCleaner->removeUnwantedCharsFromStringForRegex($titleWordsArray[$index]);
					$result = preg_match_all('"([A-Z][a-zA-Z]*)+[^:]$"', $nextWord, $arr, PREG_PATTERN_ORDER);
					if ($result > 0){
							$combinedWord = $combinedWord . " " . $this->textCleaner->removeUnwantedTermsFromString($nextWord);
							$index++;
					} else {
							//Si entre aca es porque o no empieza con mayusculas o termina con ":"
							$result = preg_match_all('"([A-Z][a-zA-Z]*)+"', $nextWord, $arr, PREG_PATTERN_ORDER);
							if($result > 0){
								$combinedWord = $combinedWord . " " . $this->textCleaner->removeUnwantedTermsFromString($nextWord);
								//Fuerzo result a 0 porque se que aca comienza una cita textual (despues de los :)
								$result=0;
							} else {
								//Vuelvo el indice uno para atras, porque es una palabra que no tiene que ver con la "Frase"
										$index--;
									}
							}
				}
			} else {
					//Si entre aca es porque o no empieza con mayusculas
					$combinedWord = $this->textCleaner->removeUnwantedTermsFromString($currentWord);
					}
			$index++;
			if (strlen($combinedWord) > 3){
				$combinedTitleWordsArray[] = $combinedWord;
			}
		}	
		return ($combinedTitleWordsArray);
	}
}