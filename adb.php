<?php

/**
*Database connection helper
*/
include_once("setting.php");

/**
* Database connection helper class
*/
class adb{
	var $db_conn=null;
	var $result=null;
	
	function __construct(){
		$this->connect();
	}
	
	/**
	*Connect to database 
	*@return boolean ture if connected else false
	*/
	function connect(){
		//connect
		$this->db_conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
		
		if($this->db_conn->connect_errno){
			//no connection, exit
			echo $conn->connect_errno;
			return false;
		}
		return true;
	}
	
	/**
	*Query the database 
	*@param string $strQuery sql string to execute
	*/
	function query($strQuery){
		if(!$this->connect()){
			$this->connect();
		}
		
		$this->result = $this->db_conn->query($strQuery);
		
		if(!$this->result){
			echo $conn->error;
			return false;
		}
		return true;
	}
	
	/**
	* Fetch from the current data set and return
	*@return array one record
	*/
	function fetch(){
		if(!$this->result){
			return false;
		}
		
		return $this->result->fetch_assoc();
	}
}

/*test code
$obj=new adb();
$obj->query("select * from users");
print_r($obj->fetch());
*/
?>