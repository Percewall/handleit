<?php

namespace feedReader;

class feedReader {
	
	/*private $region;
	private $realm;
	private $cacheEnabled = TRUE;
	private $characterExcludeFields = FALSE;
	 */
	function __construct(){
   		$GLOBALS['feedreader']['cachestatus'] = TRUE;
   		$GLOBALS['feedreader']['urls']['mmonews'] = "http://www.mmo-champion.com/external.php?do=rss&type=newcontent&sectionid=1&days=120&count=10";
   		$GLOBALS['feedreader']['urls']['blizzardnews'] = "http://www.battle.net/wow/es/feed/news";
   		$GLOBALS['feedreader']['MmoTTL'] = 10000;
   		$GLOBALS['feedreader']['BlizzardNewsTTL'] = 10000;
	}

	public function getMmoChampion() {
		$feed = new Feed($url);
		$content = $feed->getFeed();
		return $content;
	}

	public function getBlizzard() {
		$feed = new Feed();
		$content = $feed->getFeed(10, 'BlizzardNews');
		return $content;
	}

}

