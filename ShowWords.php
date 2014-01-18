<?php
require('autoload.php');
class ShowWords{
	private $dbc;

	function __construct(){
		$this->dbc=$this->dbh=(new NewCon("wordogram"))->getCon();
	}

	function sortbyMostSearched(){
		$dbh=$this->dbc;
		$data=array();
		$sth=$dbh->prepare("select id,keyword,frequency from histogram order by frequency desc");
		$sth->execute();
		while($res=$sth->fetch(PDO::FETCH_ASSOC)){
			$data[$res['id']]=array($res['keyword'],$res['frequency']);
		}
		return $data;
	}

	function sortWordsByFrequency($freq){
		$dbh=$this->dbc;
		$data=array();
		if($freq<=0)
			$freq=1;
		$sth=$dbh->prepare("select id,frequency,keyword from histogram where frequency >=? limit 10");
		$sth->bindParam(1,$freq,PDO::PARAM_INT);
		$sth->execute();
		while($res=$sth->fetch(PDO::FETCH_ASSOC)){
			if(abs($res['frequency']-$freq)<=3)
				$data[$res['id']]=$res['keyword'];
		}
		return $data;
	}

	function sortbyStem($word=''){
		$dbh=$this->dbc;
		$data=array();
		$stem=(new Stemmer())->stem($word);
		$sth=$dbh->prepare("select id,keyword from histogram where keyword like '%".$stem."%' limit 10");
		$sth->execute();
		while($res=$sth->fetch(PDO::FETCH_ASSOC)){
			$data[$res['id']]=$res['keyword'];
		}
		return $data;
	}
}

