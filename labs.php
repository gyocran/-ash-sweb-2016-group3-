<?php

/**
 * Maame Yaa Afriyie Poku
 */
include_once("adb.php");

/**
 * Labs  class
 */
class labs extends adb {

    function labs() {
        
    }

    /**
     * Gets all labs 
     */
    function getAllLabs() {
        $strQuery = "select labname, department,supervisor_id from sweb_lab";
        return $this->query($strQuery);
    }
    
    /**
     * Gets lab names
     */
    function getLabNames() {
        $strQuery = "select labname from sweb_lab";
        return $this->query($strQuery);
    }

}

//Test
/* $obj=new labs();
  if(!$obj->query("select * from sweb_lab"))
  {
  echo "error";
  exit();
  }
  print_r($obj->fetch()); */

//unit test for getLabNames()
//$labs = array();
//    if(!$obj2->getLabNames()){
//        echo "Retrieval of lab names failed";
//    }
//    else{
//        $temp = $obj2->fetch();
//        while($temp){
//            array_push($labs, $temp);
//            $temp=$obj2->fetch();
//        }
//    }
//    print_r($labs);
?>