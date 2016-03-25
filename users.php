<?php

/**
*/
include_once("adb.php");

/**
*Users  class
*/
class users extends adb{

	/**
	*constructor
	*/
	function __construct(){
	}
	
	/**
	*Adds a new user
	*@param string username login name
	*@param string password login password
	*@param string firstname first name
	*@param string lastname last name
	*@param int usergroup group id
	*@param string status status of the user account
	*@param string permission permission as an int
	*@return boolean returns true if successful or false 
	*/
	function addUser($username,$password='none',$firstname='none',$lastname='none',
		$usergroup=0,$status='none',$permission='none'){
		
		$strQuery="INSERT INTO sweb_user SET
					username = '$username',
					password = '$password',
					firstname = '$firstname',
					lastname = '$lastname',
					usergroup = '$usergroup', 
					status = '$status',
					permission = '$permission' ";
		return $this->query($strQuery);				
	}
	
	/**
	*gets user records based on the filter
	*@param string mixed condition to filter. If  false, then filter will not be applied
	*@return boolean true if successful, else false
	*/
	function getUsers($filter=false){
		$strQuery="SELECT * FROM sweb_user";
		
		if($filter){
			$strQuery=$strQuery . " where $filter";
		}
		
		return $this->query($strQuery);
	}
	
	/**
	*Searches for user by username, fristname, lastname 
	*@param string text search text
	*@return boolean true if successful, else false
	*/
	function searchUsers($text=false, $groupID=false){
		$filter=false;
		
		if($text){
			$filter = " username like '%$text%' or firstname like '%$text%' or lastname like '%$text%' ";
		}
		
		if($groupID){
			$filter = " usergroup = $groupID";
		}
		
		if($text && $groupID){
			$filter = " (username like '%$text%' or firstname like '%$text%' or lastname like '%$text%') and (usergroup = '$groupID')";
		}
		
		return $this->getUsers($filter);
	}
	
	/**
	*delete user
	*@param int usercode the user code to be deleted
	*returns true if the user is deleted, else false
	*/
	function deleteUser($usercode){
		$strQuery = "DELETE FROM sweb_user WHERE user_id = '$usercode' ";
		
		return $this->query($strQuery);
	}
	
	/**
	*edit user
	*@param int usercode the user code to be updated
	*returns true if the user is updated, else false
	*/
	function editUser($usercode,$username,$firstname,$lastname,$password,$usergroup,$permission,$status){
		$strQuery = "UPDATE sweb_user SET
						username = '$username',
						password = '$password',
						firstname = '$firstname',
						lastname = '$lastname',
						usergroup = '$usergroup', 
						status = '$status',
						permission = '$permission' 
						WHERE user_id = '$usercode' ";
		
		return $this->query($strQuery);
	}
	
	/**
	*change a user status
	*@param int usercode the user  to change  status
	*@param string status the status to be changed
	*returns true if the user status is changed, else false
	*/
	function changeUserStatus($usercode,$status){
		$strQuery = "UPDATE sweb_user SET status = '$status'
				    WHERE user_id = '$usercode' ";
		
		return $this->query($strQuery);
	}

}
?>