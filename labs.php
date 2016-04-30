<?php
/**
*Maame Yaa Afriyie Poku
*/
include_once("adb.php");
/**
*Labs  class
*/
class labs extends adb{

	function _construct(){
	
	}

	/**
	*Gets all labs 
	*/
	function getAllLabs(){
		$strQuery="select labname,department,supervisor_id from sweb_lab";
		echo $strQuery;
		return $this->query($strQuery);
	}
	
}
?>