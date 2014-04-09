<?php
//require 'vendor/autoload.php';

class RSSParser {

	function parse($rssFeed, $source, $shortname){

		$newsArray =  array();
		$i = 0;
		foreach($rssFeed->channel->item as $item){
			$newsArray[$i] = $this->createNews($item,$shortname, $source);
			$i = $i + 1;
		}
		return ($newsArray);
	}

	function createNews($item, $shortname, $source){

		$news = new News();
		$news->title = strip_tags($item->title);
		//$news->pubdate = DateManager::convertToPhp($item->pubDate);
		$news->pubdate = DateManager::convertToSql(DateManager::convertToPhp($item->pubDate));
		$news->source = $source;
		$news->resume = $this->shorten(strip_tags($item->description));
		if ($shortname == 'cronica'){
			$link = 'http://www.cronica.com.ar' . $item->link;
			$news->link = $link;
		} else {
			$news->link = $item->link;
		}
		//saving image if possible
		if ($item->enclosure->count() > 0){
			$isImage = strpos((string)$item->enclosure->attributes()->type, 'image');
			if ($isImage === false){
			}
			else{
				//echo "Image Link: " . $item->enclosure->attributes()->url . "\n";
				$news->image = (string)$item->enclosure->attributes()->url;
			}
		}
		return $news;
	}

	function shorten($resume){
		$resume = (string)$resume;
		$wc = strlen($resume);
		$charLimit = 300;
		$index=0;
		$insideCharLimit=true;
		$lastSpacePosition=0;
		if ($wc > $charLimit){
			while($index < $wc && $insideCharLimit){
				$actualChar = $resume[$index];
				if($actualChar == " "){
					if($index > $charLimit){
						$insideCharLimit=false;
					}else{
						$lastSpacePosition = $index;
					}
				}
				$index++;
			}
			$shortenResume = substr($resume,0,$lastSpacePosition) . " ...";
		}else{
			$shortenResume = $resume;
		}
		return($shortenResume);
	}
}
?>