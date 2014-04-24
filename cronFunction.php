<?php		
$rssParser = new RSSParser();
$configManager = new ConfigurationManager();
$rssManager = new RSSManager($rssParser, $configManager);

echo "Getting all news \n";
$newsArray = $rssManager->getAllNewsFromRemote('app/properties/rssFeeds.xml');
$counter = 0;
echo "Saving news \n";
foreach ($newsArray as $news){
	if(! News::find(md5($news->title . $news->resume))){
		$news->id = md5($news->title . $news->resume);
		$news->save();
		$counter++;
	}
}
//echo "Number of news added: " . $counter "\n";