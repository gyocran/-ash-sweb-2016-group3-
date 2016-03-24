<?php
include_once("adb.php");

class usergroups extends adb{

	/**
	*constructor
	*/
	function __construct(){
	}
	
	/**
	*get all usergroups
	*returns true if the usergroups are fetched, else false
	*/
	function getAllUserGroups(){
		$strQuery="SELECT usergroup, groupname from wt_usergroup";
		return $this->query($strQuery);
	}
	
	/**
	*add usergroup
	*@param int usergroup the usergroup to be added
	*returns true if the usergroup is added, else false
	*/
	function addUserGroup($groupname){
		$strQuery = "INSERT INTO wt_usergroup SET
					groupname=$groupname";
		
		return $this->query($strQuery);	
	}
	
	/**
	*delete usergroup
	*@param int usergroup the usergroup to be deleted
	*returns true if the usergroup is deleted, else false
	*/
	function deleteUserGroup($usergroup){
		$strQuery = "DELETE FROM wt_usergroup WHERE usergroup = '$usergroup' ";
		
		return $this->query($strQuery);
	}
	
	/**
	*edit user
	*@param int usercode the user code to be updated
	*returns true if the user is updated, else false
	*/
	function editUser($usergroup){
		$strQuery = "UPDATE wt_usergroup SET
					usergroup = '$usergroup' ";
		
		return $this->query($strQuery);
	}

}

?>