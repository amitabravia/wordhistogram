<?php
require_once('autoload.php');
session_start();
$_SESSION['suggs']=NULL;

if(isset($_POST['search']) && $_POST['search']=="Search"){
	if(isset($_POST['stext']) && !empty($_POST['stext'])){
		$_SESSION['suggs']="";
		$text=filter_var($_POST['stext'],FILTER_SANITIZE_STRING);
		$st=new ParseText($text);
		$keyword=$st->getKeyWords();
		//print_r($keyword);
		$dbh=(new NewCon('wordogram'))->getCon();
		foreach($keyword as $key){
			$key=strtolower($key);
			$resp=$st->checkWord($dbh,$key);
			if($resp>=0){
				$st->updateWordCount($dbh,$key,$resp);
				
				//use checkWord($dbh,$key) to get the count of each word and either set it in session or print it in html

			}
			if($resp==false){
				$st->insertWord($dbh,$key);
			}
			if($resp==-1)
				print_r("Error Connecting Database");
		}
	}
}


if(isset($_POST['related']) && $_POST['related']=="Lucky"){
	if(isset($_POST['stext']) && !empty($_POST['stext'])){
		$text=filter_var($_POST['stext'],FILTER_SANITIZE_STRING);
		$i=0;
		$word=array();
		$st=new ParseText($text);
		$keyword=$st->getKeyWords();
		print_r($keyword);
		$k=array();
		$i=0;
		$dbh=(new NewCon('wordogram'))->getCon();
		foreach($keyword as $key){
			$key=strtolower($key);
			$resp=$st->checkWord($dbh,$key);
			if($resp>=0){
				$words[$i++]=(new ShowWords())->sortWordsbyFrequency($resp);
			}
			if($resp==0){
				$st->insertWord($dbh,$key);
			}

			if($resp==false)
			{
				print_r("Error in Connecting Database");
			}
		}

		foreach($words as $word){
			foreach($word as $key){
				$keys[$i++]=$key;
			}
		}

		$_SESSION['suggs']=array_unique($keys);
		//setcookie('suggs',$words);
	}
}

if(isset($_POST['suggested']) && $_POST['suggested']=="Synonymous"){
	if(isset($_POST['stext']) && !empty($_POST['stext'])){
		$text=filter_var($_POST['stext'],FILTER_SANITIZE_STRING);
		$i=0;
		$_SESSION['suggs']="";
		$st=new ParseText($text);
		$words=$st->getKeyWords();
		$k=array();
		$i=0;
		$dbh=(new NewCon('wordogram'))->getCon();
		foreach($words as $word){
			$inflects=(new ShowWords())->sortbyStem($word);
			foreach($inflects as $inflect)
				$k[$i++]=$inflect;
		}
		$_SESSION['suggs']=array_unique($k);
	}
}
if(isset($_SESSION['suggs'])){
	header('Location:/wordhistogram/index.php');
	exit();
}

?>
