<?php
include_once("adb.php");

/**
 * Labs  class
 */
class labs extends adb {

    function labs() {
        
    }

    /**
     * Gets lab names
     * @return a list of all the names of the labs
     */
    function getLabNames() {
        $strQuery = "select labname from sweb_lab";
        return $this->query($strQuery);
    }
}
?>