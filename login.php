<?php

include_once 'adb.php';

/**
 * login class
 */
class login extends adb {

    /**
     * constructor
     */
    function __construct() {
        
    }

    /**
     * function authenticates user and gets user details
     * @param string username user name
     * @param string password user password
     */
    function userLogin($username, $password) {
        $str_query = "select user_id,username,password,firstname,lastname,usergroup,permission,status from sweb_user
				WHERE username='$username' and password=('$password')";

        return $this->query($str_query);
    }

}

?>