<?php

namespace feedRead;

class Feed {

	function __construct($feed_url){

	    $content = file_get_contents($feed_url);
	    $x = new SimpleXmlElement($content);
		
		return $x;	     
	}

