<?php

namespace feedReader;

use SimpleXmlElement;
use PDO;

class Feed {

	private $url;
	private $db;
	private $MmoTTL = 600;
	private $BlizzardTTL = 600;
	private $tables = array('MmoNews','BlizzardNews');
	private $tblpre = 'news_';
	
	
   	function __construct() {
		$this->MmoTTL 			= $GLOBALS['feedreader']['MmoTTL'];
		$this->BlizzardNewsTTL  = $GLOBALS['feedreader']['BlizzardNewsTTL'];		
		$this->openDatabase();
		$this->initTables();
   	}


	function getFeed($limit=100, $type=null){
		//mount url
		$this->url=$GLOBALS['feedreader']['urls'][strtolower($type)];
		$objectID= md5($this->url);
		if ($type) {
			if ($this->checkCache($objectID, $type)) {
				$objectJSON=$this->getData($objectID, $type);
				return $objectJSON;
			} else {
				$content = file_get_contents($this->url);
				$xml = new SimpleXmlElement($content);
				$objectJSON = json_encode($xml);
				$this->genericInsert($objectID, $objectJSON, $type);
				return $objectJSON;
			}
		}
		return false;	     
	}
   	
   	function __destruct() {
   		$this->db = null;
   	}
   	
   	public function genericInsert($objectID,$data, $table){
   		$sql = "DELETE FROM ".$this->tblpre.$table." WHERE ObjectID = '".$objectID."'";
   		#print $sql;
   		$this->db->prepare($sql)->execute();
   		
	   	$splitdata = $this->dataBreak($data);
	   	foreach ($splitdata as $part => $datapart){
	   		$sql = "REPLACE INTO ".$this->tblpre.$table." (ObjectID,Part,Timestamp,Data) VALUES ('$objectID',".$part.",'".time()."',:data)";
			$sth = $this->db->prepare($sql);
			$sth->bindParam(':data', $datapart, PDO::PARAM_STR);
			$sth->execute();	   	
	   	}
   		unset($splitdata);
   	}
   	
   	/**
   	 * Since there is a limit in MySQL on how much data there can be in one row its being split up a bit.
   	 * @param String $data
   	 * @return An array with the data
   	 */
   	private function dataBreak($data){
   		$maxsize = 100000;
   		for ($position = 0; $position < strlen($data); $position += $maxsize){
   			$sub = substr($data, $position, $maxsize);
   			$returndata[] = $sub;
   		}
   		return $returndata; 
   	}
   	
   	public function checkCache($objectID,$table){
   		$sql = "SELECT Timestamp FROM ".$this->tblpre.$table." WHERE ObjectID = '".$objectID."' LIMIT 1";
		#print $sql."\n";
   		$timestamp = $this->{$table.'TTL'};
   		$sth = $this->db->query($sql);
   		if ($row = $sth->fetch()){
			if ($row['Timestamp']+$timestamp > time()){
				return true;
			}
   		}
		return false;
   	}

   	
   	/**
   	 * Get the data from cache.
   	 * @param String $objectID
   	 * @param String $table
   	 */
   	public function getData($objectID,$table){
   		$sql = "SELECT Data FROM ".$this->tblpre.$table." WHERE ObjectID = '".$objectID."' ORDER BY Part";
   		if($sth = $this->db->query($sql)) {
			$returndata = '';
			while ($row = $sth->fetch()){
   				$returndata .= $row['Data'];
			}
   			return $returndata;
		} else {
		  die("Error:" . $sql);
		}
		return false;
   	}

	private function openDatabase(){
   		$this->db = new SafePDO();
   	}
   	
   	private function initTables(){
   		foreach ($this->tables as $tablename){
	   		$this->createTable($tablename);
   		}
   	}
   	
   	private function createTable($tablename){
   		$tablename = $this->tblpre.$tablename;
   		$statement = "CREATE TABLE IF NOT EXISTS $tablename (
				  `ObjectID` varchar(50) NOT NULL,
				  `Data` longblob NOT NULL,
				  `Part` int(11) NOT NULL,
				  `Timestamp` varchar(75) NOT NULL,
				  PRIMARY KEY (`ObjectID`,`Part`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8;";   		
   		$sth = $this->db->prepare($statement);
   		$sth->execute();
   	}
}
