<?php

$rssFeedsXmlFile = 'app/properties/rssFeeds.xml';

echo "Validating XML and DB Sources \n";
validateAllSourcesExistOnDB($rssFeedsXmlFile);
echo "Saving News into DB \n";
saveAllNewsFromONlineRss($rssFeedsXmlFile);
//echo "Creating Trending News And WordsFile \n";
//createTrendingNewsAndWordsFile();
//echo "Creating Twitter Feeds \n";
//createTwitterFeeds();

function saveAllNewsFromONlineRss($rssFeedsXmlFile){

		$rssManager = new RSSManager();
		$newsArray = $rssManager->getAllNewsFromRemote($rssFeedsXmlFile);
		foreach ($newsArray as $news){
 				if(! News::find(md5($news->title . $news->resume))){
 					$news->save();
 				}
 		}
}
 	
function validateAllSourcesExistOnDB($rssFeedsXmlFile){
	$arrayRss = simplexml_load_file($rssFeedsXmlFile);
		foreach ($arrayRss as $rss) {
			sourceIsLoadedInDB($rss);
		}
}	

function sourceIsLoadedInDB($rss){
	$rssShortName = $rss->shortName;
	if(Source::where('shortname', '=', $shortname)->get() == false){
		insertNewSource($rss);
	}
}

function insertNewSource($rss){
	$source = new Source();
	$source->name = $rss->name;
	$source->shortName = $rss->shorName;
	$source->type = $rss->type;
	$source->save();
}

function createTrendingNewsAndWordsFile(){

	$htmlCreator = ApplicationContext::getServices('htmlCreator');
	$htmlCreator->createTrendingWordsFile();
	$htmlCreator->createTrendingNewsFile();
}

function createTwitterFeeds(){

	$twitterPostsManager = ApplicationContext::getServices('twitterPostsManager');
	$rssfeed = $twitterPostsManager->generateRSSFeed();
	$twitterPostsManager->saveRSSFeedToFile($rssfeed);
}