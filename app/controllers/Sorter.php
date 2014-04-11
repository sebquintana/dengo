<?php

class Sorter {

	private $configManager;
	private $textCleaner;
	
	function __construct(ConfigurationManager $configurationManager,TextCleaner $textCleaner){
		$this->configManager = $configurationManager;
		$this->textCleaner = $textCleaner;
	}
	
	function NewsSort($array,$method){
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

	function sortByWeight($array){
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

	function sortBySourceName($array){
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
	
	function calculateWeight($keywordArray,$title,$resume,$pubDate){
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
				// $log1 = "=================== TRENDING WORD ==================";
				// $log2 = "=================== TITLE WORD ==================";
				// $log3 = "=================== RESULT ==================";
				// var_dump($log1);
				// var_dump($kw);
				// var_dump($log2);
				// var_dump($wordsInTitle[$titleIndex]);
				// var_dump($log3);
				// var_dump($foundInTitle);
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

	function calculateTrendingNewsWeight($keywordArray,$title,$resume,$pubDate){
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
				// $log1 = "=================== TRENDING WORD ==================";
				// $log2 = "=================== TITLE WORD ==================";
				// $log3 = "=================== RESULT ==================";
				// var_dump($log1);
				// var_dump($kw->word);
				// var_dump($log2);
				// var_dump($wordsInTitle[$titleIndex]);
				// var_dump($log3);
				// var_dump($foundInTitle);
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


	function searchString($kw,$texto){
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
	
	function calculateTimeBonus($pubDate){
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
}