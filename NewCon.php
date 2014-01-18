<?php
class NewCon{
	const DB_LOC="./databases/";
	private $con=NULL;
	function __construct($dbname="tests"){
		try{
		
			$this->con=new PDO("sqlite:".NewCon::DB_LOC.$dbname.".db");
		}
		catch(PDOException $e){
			print_r($e->getMessage());
		}
	}

	public function getCon(){
		return $this->con;
	}
}
?>
