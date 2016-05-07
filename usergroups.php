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
		$strQuery="SELECT usergroup_id, groupname from sweb_usergroup";
		return $this->query($strQuery);
	}
	
	/**
	*add usergroup
	*@param int usergroup the usergroup to be added
	*returns true if the usergroup is added, else false
	*/
	function addUserGroup($groupname){
		$strQuery = "INSERT INTO sweb_usergroup SET
					groupname=$groupname";
		
		return $this->query($strQuery);	
	}
	
	/**
	*delete usergroup
	*@param int usergroup the usergroup to be deleted
	*returns true if the usergroup is deleted, else false
	*/
	function deleteUserGroup($usergroup){
		$strQuery = "DELETE FROM sweb_usergroup WHERE usergroup_id = '$usergroup' ";
		
		return $this->query($strQuery);
	}
	
	/**
	*edit user
	*@param int usercode the user code to be updated
	*returns true if the user is updated, else false
	*/
	function editUserGroup($usergroup, $groupname){
		$strQuery = "UPDATE sweb_usergroup SET
					groupname = '$groupname' 
				    WHERE usergroup_id = '$usergroup' ";
		
		return $this->query($strQuery);
	}

}

?>