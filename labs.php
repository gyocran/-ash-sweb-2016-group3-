<?php
include_once("adb.php");

/**
<<<<<<< HEAD
 * Labs  class
 */
class labs extends adb {

    function labs() {
        
    }

    /**
     * Gets lab names
     * @return a list of all the names of the labs
=======
*Labs  class
*/
class labs extends adb{
	function _construct(){
	
	}

	/**
	*Gets all labs 
	*/
	function getAllLabs(){
		$strQuery="select labname, department,supervisor_id from sweb_lab";
		return $this->query($strQuery);
	
	}
	
	/**
     * Gets lab names
>>>>>>> version2
     */
    function getLabNames() {
        $strQuery = "select labname from sweb_lab";
        return $this->query($strQuery);
    }
<<<<<<< HEAD

=======
    
>>>>>>> version2
}
?>