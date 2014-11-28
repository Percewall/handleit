<?php

namespace feedReader;

class feedReader {
	
	/*private $region;
	private $realm;
	private $cacheEnabled = TRUE;
	private $characterExcludeFields = FALSE;
	*/
	function __construct() {
		echo "entra";	
	}

	public function getMmoChampion() {
		$url = "http://www.mmo-champion.com/external.php?do=rss&type=newcontent&sectionid=1&days=120&count=10";
		$feed = new Feed($url);
		return $feed;
	}

}

