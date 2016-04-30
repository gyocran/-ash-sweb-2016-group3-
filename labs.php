<?php
/**
*Maame Yaa Afriyie Poku
*/
include_once("adb.php");
/**
*Labs  class
*/
class labs extends adb{
	function labs(){
	
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

//Test
/*$obj=new labs();
if(!$obj->query("select * from sweb_lab"))
{
	echo "error";
	exit();
}
print_r($obj->fetch());*/
?>