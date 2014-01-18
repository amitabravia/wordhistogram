<?php
require("autoload.php");
class ParseText{
	private $keywords;

	function __construct($searchtext){
		//$this-phrases=preg_split('/\s*[,.?;:!-]\s*/u',$searchtext,-1,  PREG_SPLIT_NO_EMPTY);
		$this->keywords=preg_split('/((^\p{P}+)|(\p{P}*\s+\p{P}*)|(\p{P}+$))/',$searchtext,-1,PREG_SPLIT_NO_EMPTY);

	}
	
	function getKeyWords(){
		return $this->keywords;
	}

	function checkWord($dbh,$keyword){
		$sth=$dbh->prepare("select frequency from histogram where keyword=?");
		$sth->bindParam(1,$keyword,PDO::PARAM_STR);
		if($sth->execute()){
			if($k=$sth->fetch(PDO::FETCH_ASSOC))
				return $k['frequency'];
			else
				return false;
		}
		else
			return -1;
	}

	function updateWordCount($dbh,$keyword,$count){
		
		$sth=$dbh->prepare("update histogram set frequency = ? where keyword = ?");
		$k=$sth->execute(array($count+1,strtolower($keyword)));
		if($k)
			return true;
		else
			return false;	
	}

	function insertWord($dbh,$keyword){
	
		$sth=$dbh->prepare("insert into histogram (keyword,frequency) values(?,?)");
		$k=$sth->execute(array(strtolower($keyword),1));
		if($k)
			return true;
		else
			return false;
	}

}
?>
