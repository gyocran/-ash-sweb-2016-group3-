<?php
	//check for user code
	
	
	//include users.php
	
	//create an object of users and delete the user
	
	if (isset($_GET['usercode'])){
		$usercode = $_REQUEST['usercode'];
		
		include_once("users.php");
		$userObj = new users();
		$delete_result = $userObj->deleteUser($usercode);
		
		if (!$delete_result){
			echo $conn->error;
			exit();
		}else{
			header('location:userslist.php');
		}
	}
	
	
	//redirect to list
	header('location:userslist.php');	
?>