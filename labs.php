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
     * Gets lab names
     * @return a list of all the names of the labs
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
//include_once("labs.php");
//$obj=new labs();
//$labs = array();
//    if(!$obj->getLabNames()){
//        echo "Retrieval of lab names failed";
//    }
//    else{
//        $temp = $obj->fetch();
//        while($temp){
//            array_push($labs, $temp);
//            $temp=$obj->fetch();
//        }
//    }
//    print_r($labs);
?>