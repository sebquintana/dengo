<?php

use Dengo\News\News;
use Dengo\Dates\DateManager;

class RSSParser {

	public function parse($rssFeed, $shortname){

		$newsArray =  array();
		$i = 0;
		foreach($rssFeed->channel->item as $item){
			$newsArray[$i] = $this->createNews($item, $shortname);
			$i = $i + 1;
		}
		return ($newsArray);
	}

	public function createNews($item, $shortname){

		$news = new News();
		$news->title = strip_tags($item->title);
		$news->pubdate = DateManager::convertToSql(DateManager::convertToPhp($item->pubDate));
		$news->source = $shortname;
		$news->resume = $this->shorten(strip_tags($item->description));
		if ($shortname == 'cronica'){
			$link = 'http://www.cronica.com.ar' . $item->link;
			$news->link = $link;
		} else {
			$news->link = $item->link;
		}
		if ($item->enclosure->count() > 0){
			$isImage = strpos((string)$item->enclosure->attributes()->type, 'image');
			if ($isImage === false){
			}
			else{
				$news->image = (string)$item->enclosure->attributes()->url;
			}
		}
		return $news;
	}

	public function shorten($resume){

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