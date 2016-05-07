<?php
	//check command
	if(!isset($_REQUEST['cmd'])){
		echo "cmd is not provided";
		exit();
	}
	
	//get command
	$cmd=$_REQUEST['cmd'];
	switch($cmd){
		case 0:
			getUserGroups();		//if cmd=1 the call delete
			break;
		case 9:
			getLabs();
			break;
		case 1:
			deleteUser();		//if cmd=1 the call delete
			break;
		case 2:
			changeUserStatus();	//if cmd=2 the change status
			break;
		case 3:
			viewUsers();	//if cmd=3 list users
			break;
		case 4:
			addUser();	//if cmd=3 list users
			break;
		default:
			echo "wrong cmd";	//change to json message
			break;
	}
	
	function deleteUser(){
		//check if there is a user code
		if(!isset($_REQUEST['uc'])){
			echo '{"result":0,"message":"usercode is not given"}';
			exit();
		}
		//get usercode
		$usercode=$_REQUEST['uc'];
		
		include("users.php");
		$user = new users();
		
		//get details of user being deleted
		$user->getUsers("user_id = $usercode");
		$user_detail = $user->fetch();
		//print_r($user_detail);
		
		//delete the user
		if($user->deleteUser($usercode)){
			echo json_encode($user_detail);
		}else{
			echo '{"result":0,"message":"user was not deleted"}';
		}
	}
	
	function getUserGroups(){
	
		$con=mysqli_connect("localhost","simon","phpdev","ash_sweb_group_3_db");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }

		$sql="SELECT usergroup_id, groupname from sweb_usergroup";
		$result=mysqli_query($con,$sql);

		// Fetch all
		$usergroup_details = mysqli_fetch_all($result,MYSQLI_ASSOC);
		//print_r($users_details);
		
		if($usergroup_details){
			echo json_encode($usergroup_details);
		}else{
			echo '{"result":0,"message":"Please Check your records. No Usergroups added Yet"}';
		}
	}
	
	function getLabs(){
	
		$con=mysqli_connect("localhost","simon","phpdev","ash_sweb_group_3_db");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }

		$sql="SELECT labname, department,supervisor_id FROM sweb_lab";
		$result=mysqli_query($con,$sql);

		// Fetch all
		$usergroup_details = mysqli_fetch_all($result,MYSQLI_ASSOC);
		//print_r($users_details);
		
		if($usergroup_details){
			echo json_encode($usergroup_details);
		}else{
			echo '{"result":0,"message":"Please Check your records. No Labs added Yet"}';
		}
	}
	
	function changeUserStatus(){
		include_once("users.php");
		// the user code from the request array
		if(!isset($_REQUEST["uc"])){
			echo '{"result":0,"message":"user code is not correct"}';
			//echo "0";
			return;
		}
		$usercode=$_REQUEST["uc"];
		//create an object of users
		$obj=new users();
		// call change status method of user class
		$row=$obj->getUser($usercode);
		//print_r($row);
		if($row==false){
			echo "0";
			return;
		}
		//if current status is 2 then change it to 1
		if($row["NSTATUS"]==2){
			$result=$obj->changeUserStatus($usercode,1);
		}else{	//esle change status to 2
			$result=$obj->changeUserStatus($usercode,2);
		}
		
		if($result==false){
			echo "0";	
			return false;
		}
		//return json message
		echo '{"result":1,"message":"status changed"}';
			
	}
	
	function viewUsers(){
		
		$con=mysqli_connect("localhost","simon","phpdev","ash_sweb_group_3_db");
		// Check connection
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }

		$sql="SELECT user_id, username, firstname, lastname, permission, 
					sweb_user.usergroup, status, groupname, permission+0 as npermission, status+0 as nstatus 
					FROM sweb_user 
					LEFT JOIN sweb_usergroup 
					ON sweb_user.usergroup = sweb_usergroup.usergroup_id";
		$result=mysqli_query($con,$sql);

		// Fetch all
		$users_details = mysqli_fetch_all($result,MYSQLI_ASSOC);
		//print_r($users_details);
		
		if($users_details){
			echo json_encode($users_details);
		}else{
			echo '{"result":0,"message":"Please Check your records. No Users added Yet"}';
		}
	}
	
	function addUser(){
		if(isset($_REQUEST['submit'])){
				echo "inside if passed";
			$username = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			$firstname = $_REQUEST['firstname'];
			$lastname = $_REQUEST['lastname'];
			$usergroup = $_REQUEST['usergroup'];
			$status = $_REQUEST['status'];
			
			$optionArray = $_REQUEST['permission'];
			$permission = implode(',', $optionArray );
			
			include_once("users.php");
			$userObj=new users();
			$r=$userObj->addUser($username,$password,$firstname,$lastname,$usergroup,$status,$permission);
							
			//1) what is the purpose of this if block
			if($r==false){
				echo '{"result":0,"message":"error while adding user"}';
			}else{
				echo "<script> location.replace('manage_users.php'); </script>";
			}
		}
	}

?>