<?php
	// checking if session has started
	session_start();

	// checking to see if session contains the user id
	if(!isset($_SESSION['USER']['user_id'])){
		header("Location: index.php");
		exit();
	}
	
	if ($_SESSION['USER']['usergroup'] != 1){
		header("Location: viewmybookings.php");
	}

	// storing and printing the firstname
	$firstname = $_SESSION['USER']['firstname'];
	echo "<span style = 'color:#A32222; #1472A5; padding: 20px; position: absolute; top: 11%;' ><b> Welcome $firstname </b> </span>";
		
?>
<html>
	<head>
		<title>Lab Time | Manage Users</title>
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-1.12.1.js"></script>
		
		<link rel="stylesheet" type="text/css" href="js/codebase/themes/message_default.css">
		<link rel="stylesheet" type="text/css" href="js/codebase/dhtmlx.css"/>
		
		<script type="text/javascript" src='js/codebase/message.js'></script>
		<script type="text/javascript" src="js/codebase/dhtmlx.js"></script>
	</head>
	
	<body>
		<header id="pageheader">

			<div style="width:10%; height:100%;float: left;"></div>

			<div style="width:80%; float: left;">
				<center><img src="css/images/logo.gif" style="width:180px;height:105%;"> </center>
			</div>

			<div style="width:10%; float: left;">	
			<span class= "logout" onClick="location.href='logout.php'"> Logout</span>
			</div>

		</header>	

		<div id ="navbar">
			<table align="center">
			<!--This creates the menu bar-->
				<tr>
					<td class="item" onclick="location.href='viewmybookings.php'">My Bookings</td>
					<td class="item" onclick="location.href = 'displayBookings.php'">Master Schedule</td>
					<td class="item" onclick="location.href='manage_users.php'">Manage Users</td>
					<td class="item" onclick="location.href = 'addbooking.php'">+ Add a booking</td>
				</tr>
			</table>	
		</div>

		<!-- Where main content will be -->
		<div id="content">
			<div id="leftdiv">
			</div>

			<center>
			<div id="middlediv">
				<table>
					<?php
						if(isset($_POST['submit'])){
				
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
								echo "error while adding user";
							}else{
								header('location:manage_users.php');
							}
						}
					?>
		
					<form action = "" method = "POST">
						Username:	<input type = "text" name = "username" value = ""/> <br>
						 <br>
						Password:	  <input type = "password" name = "password" value = ""/> <br>
						 <br>
						Firstname:	<input type = "text" name = "firstname" value = ""/> <br>
						 <br>
						Lastname:	  <input type = "text" name = "lastname" value = ""/> <br>
						 <br>
						Usergroup:	<select name = "usergroup"/> 
							<?php
								include_once("usergroups.php");
								$usergroupObj = new usergroups();
								$usergroupObj->getAllUserGroups();
								
								echo "<option value = '-1'>-- select usergroup --</option>";
								while($row = $usergroupObj->fetch()){
									echo "<option value = {$row["usergroup_id"]}>{$row["groupname"]}</option>";
								}
							?>
							</select><br>
						 <br>
						 
						Account Status: 
							<input type = 'radio' name = 'status' value = 'ENABLED' />Enabled
							<input type = 'radio' name = 'status' value = 'DISABLED'/>Disabled<br>
						<br>
						
						User Permission:
							<input type ='checkbox' name ='permission[]' value='View' />View
							<input type ='checkbox' name ='permission[]' value='Add' />Add 
							<input type ='checkbox' name ='permission[]' value='Delete' />Delete 
							<input type ='checkbox' name ='permission[]' value='Update' />Update
						<br>
						<input type = "submit" name = "submit" value = "Add" />
					</form>	
				</td>		
			</tr>			
		</table>				
			</div>
			</center>

			<div id="rightdiv">
			</div>
		</div>
	</body> 
	
	<footer id="footer"></footer>
</html>