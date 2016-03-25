<?php
	//check for user code
	//include users.php
	//create an object of users and delete the user
	
	if (isset($_GET['usercode'])){
		$usercode = $_REQUEST['usercode'];
		$tempStatus = $_REQUEST['status'];
		$status="";
		
		if($tempStatus=="ENABLED"){
			$status="DISABLED";
		}else if($tempStatus=="DISABLED"){
			$status="ENABLED";
		}
		
		include_once("users.php");
		$userObj = new users();
		$change_status_result = $userObj->changeUserStatus($usercode,$status);
		
		if (!$change_status_result){
			echo $conn->error;
			exit();
		}else{
			header('location:userslist.php');
		}
	}
	
	
	//redirect to list
	header('location:userslist.php');	
?>