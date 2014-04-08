<?php

class RSSManager {
	
	private $parser;
	private $configManager;
	
	function __construct(RSSParser $rssParser, ConfigurationManager $configManager){
		$this->parser = $rssParser;
		$this->configManager = $configManager;
	}
	
	function getAllNewsFromRemote($rssFeedsXmlFile){
		$arrayRss = simplexml_load_file($rssFeedsXmlFile);
		$arrayNewsAll = array();
		foreach ($arrayRss as $rss) {
			$rssSource = $rss->rssRemote;
			$fixedRss = $this->checkAndFixRssFeed($rssSource);
			$isValidRss = ($fixedRss instanceof SimpleXMLElement);
			if ($isValidRss){
				$rssName = $rss->name;
				$rssShortname = $rss->shortname;
				$arrayNews =  $this->parser->parse($fixedRss,$rssName, $rssShortname);
				$arrayNewsAll = array_merge($arrayNewsAll, $arrayNews);
			}
		}
	
		return($arrayNewsAll);
	}
	/*
	 * @Returns: a valid Rss source in success, false on failure
	 */
	function checkAndFixRssFeed($rssFeed){
		$rssStartChar = '<';
		$rssAsString = false;
		try {
			$rssAsString = file_get_contents($rssFeed);
		}
		catch(Exception $e) {
			//file_put_contents('../logs/parserErrors.txt', $e->getMessage(), FILE_APPEND);
		}
		if ($rssAsString != false){
			
			$rssAsString = $this->fixIsoAndSpecChars($rssAsString);
			
			$rssStartCharPosition = stripos($rssAsString, $rssStartChar);
			
			if ($rssStartCharPosition != 0){
				$fixedRssString= $this->fixRssFeed($rssAsString, $rssStartCharPosition);
				$fixedRss=simplexml_load_string($fixedRssString);
			}
			else {
				$fixedRss = simplexml_load_file($rssFeed);
				//echo "entre a cargar la fuente " . $rssFeed ." como file \n";
			}
		}
		else {
			$fixedRss = false;
		}
		
		return ($fixedRss);
	}
	
	private function fixRssFeed($rssAsString,$rssStartCharPosition){
		$fixedRss= substr($rssAsString, $rssStartCharPosition);
		return ($fixedRss);
	}
	
	function fixIsoAndSpecChars($rssFeed){
		
		$feed = $rssFeed;
		
		if(strpos($feed, "ISO-8859-1") !== FALSE){
			$feed = str_replace("ISO-8859-1", "UTF-8", $feed);
			$feed = utf8_encode($feed);
			$feed = html_entity_decode($feed,ENT_NOQUOTES,"UTF-8");
		}
		
		$feed = str_replace("&amp;ldquo;", '"', $feed);
		$feed = str_replace("&amp;rdquo;", '"',$feed);
		
		$feed = str_replace("&ldquo;", '"', $feed);
		$feed = str_replace("&rdquo;", '"',$feed);
		
		$originalAcronim = $this->configManager->getArrayAcronim();
		$replaceAcronim = $this->configManager->getArrayReplaceAcronim();
		$feed = str_replace($originalAcronim, $replaceAcronim, $feed);
		
		return $feed;
	}
}