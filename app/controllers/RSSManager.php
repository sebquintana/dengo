<?php
use Dengo\Text\TextCleaner;

class RSSManager {
	
	private $parser;
	private $textCleaner;
	
	public function __construct(RSSParser $rssParser, TextCleaner $textCleaner){

		$this->parser = $rssParser;
		$this->textCleaner = $textCleaner;
	}
	/*
	* @Returns: all news from all sources
	*/
	public function getAllNews($rssFeedsXmlFile){

		$arrayRss = simplexml_load_file($rssFeedsXmlFile);
		
		$arrayNewsAll = array();

		foreach ($arrayRss as $rss) {
			$rssSource = $rss->rssRemote;
			$fixedRss = $this->checkAndFixRssFeed($rssSource);
			if($fixedRss != false){
				$isValidRss = ($fixedRss instanceof SimpleXMLElement);
				if ($isValidRss){
					$rssName = $rss->name;
					$rssShortname = $rss->shortname;
					$arrayNews =  $this->parser->parse($fixedRss, $rssShortname);
					$arrayNewsAll = array_merge($arrayNewsAll, $arrayNews);
				}
			}
		}
	
		return($arrayNewsAll);
	}
	/*
	 * @Returns: a valid Rss source in success, false on failure
	 */
	public function checkAndFixRssFeed($rssFeed){

		$rssStartChar = '<';
		$rssAsString = false;
		$fixedRss = false;
		try {
			$rssAsString = file_get_contents($rssFeed);
		
			if ($rssAsString != false){
				$rssAsString = $this->fixIsoAndSpecChars($rssAsString);	
				$rssStartCharPosition = stripos($rssAsString, $rssStartChar);
				
				if ($rssStartCharPosition != 0){
					$fixedRssString= $this->fixRssFeed($rssAsString, $rssStartCharPosition);
					$fixedRss=simplexml_load_string($fixedRssString);
				} else {
					$fixedRss = simplexml_load_file($rssFeed);
				}
			}
		} catch(Exception $e) {
			Log::error($e->getMessage());
		}
		
		return ($fixedRss);
	}
	
	private function fixRssFeed($rssAsString,$rssStartCharPosition){

		return substr($rssAsString, $rssStartCharPosition);
	}
	
	public function fixIsoAndSpecChars($rssFeed){
		
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
		
		$originalAcronim = $this->textCleaner->getArrayAcronim();
		$replaceAcronim = $this->textCleaner->getArrayReplaceAcronim();
		$feed = str_replace($originalAcronim, $replaceAcronim, $feed);
		
		return $feed;
	}
}