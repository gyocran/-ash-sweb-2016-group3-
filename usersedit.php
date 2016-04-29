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
						$strStatusMessage ="Update user";
						$old_username = '';
						$old_password = '';
						$old_firstname = '';
						$old_lastname = '';
						$old_usergroup = -1; 
						$old_status = '';
						$old_permission = ''; 
						
						if (isset($_GET['usercode'])){
							$usercode = $_GET['usercode'];
							
							include_once("users.php");
							$userObj=new users();
							$userObj->getUsers("user_id='$usercode' ");
							$row = $userObj->fetch();
							
							if(isset($_POST['submit'])){
								$username = $_REQUEST['username'];
								$password = $_REQUEST['password'];
								$firstname = $_REQUEST['firstname'];
								$lastname = $_REQUEST['lastname'];
								$usergroup = $_REQUEST['usergroup'];
								$status = $_REQUEST['status'];
								
								$optionArray = $_REQUEST['permission'];
								$permission = implode(',', $optionArray );
								
								$r=$userObj->editUser($usercode,$username,$firstname,$lastname,$password,$usergroup,$permission,$status);
											
								//1) what is the purpose of this if block
								if($r==false){
									$strStatusMessage="error while updating user";
								}else{
									$strStatusMessage="$username updated";
									 echo "<script> location.replace('manage_users.php'); </script>";
								}
									
								
							}
							
							$old_username = $row['username'];
							$old_password = $row['password'];
							$old_firstname = $row['firstname'];
							$old_lastname = $row['lastname'];
							$old_usergroup = $row['usergroup'];
							$old_status = $row['status'];
							$old_permission = $row['permission'];
						}
					?>
					
					<form action = "" method = "POST">
						Username:	<input type = "text" name = "username" value = "<?php echo $old_username; ?>"/> <br>
						 <br>
						Password:	  <input type = "password" name = "password" value = "<?php echo $old_password; ?>"/> <br>
						 <br>
						Firstname:	<input type = "text" name = "firstname" value = "<?php echo $old_firstname; ?>"/> <br>
						 <br>
						Lastname:	  <input type = "text" name = "lastname" value = "<?php echo $old_lastname; ?>"/> <br>
						 <br>
						Usergroup:	<select name = "usergroup"/> 
							<?php
								include_once("usergroups.php");
								$usergroupObj = new usergroups();
								$usergroupObj->getAllUserGroups();
								
								echo "<option value = '-1'>-- select usergroup --</option>";
								while($row = $usergroupObj->fetch()){
									$selected = ($row["usergroup_id"] === $old_usergroup)? selected : "";  
									echo "<option value = {$row["usergroup_id"]} $selected >{$row["groupname"]}</option>";
								}
							?>
							</select><br>
						<br>
				 
						Account Status: 
						<?php 
							if ($old_status == "ENABLED"){
								echo "<input type = 'radio' name = 'status' value = 'ENABLED' checked='checked' />Enabled
									<input type = 'radio' name = 'status' value = 'DISABLED'/>Disabled <br>";
							}else if ($old_status == "DISABLED"){
								echo "<input type = 'radio' name = 'status' value = 'ENABLED' />Enabled
									<input type = 'radio' name = 'status' value = 'DISABLED' checked='checked' />Disabled <br>";
							}else{
								echo "<input type = 'radio' name = 'status' value = 'ENABLED' />Enabled
									<input type = 'radio' name = 'status' value = 'DISABLED' />Disabled <br>";
							}
						?>
						<br>
				
						User Permission:
						<?php 
							if (stristr($old_permission, 'View') ){
								echo "<input type ='checkbox' name ='permission[]' value='View' checked />View"; 
							}else{
								echo "<input type ='checkbox' name ='permission[]' value='View' />View"; 
							}
							
							if (stristr($old_permission, 'Add') ){
								echo "<input type ='checkbox' name ='permission[]' value='Add' checked />Add"; 
							}else{
								echo "<input type ='checkbox' name ='permission[]' value='Add' />Add"; 
							}
							
							if (stristr($old_permission, 'Delete') ){
								echo "<input type ='checkbox' name ='permission[]' value='Delete' checked />Delete"; 
							}else{
								echo "<input type ='checkbox' name ='permission[]' value='Delete' />Delete"; 
							}
							
							if (stristr($old_permission, 'Update') ){
								echo "<input type ='checkbox' name ='permission[]' value='Update' checked />Update"; 
							}else{
								echo "<input type ='checkbox' name ='permission[]' value='Update' />Update"; 
							}
						?>
						
						<br>
				
						<input type = "submit" name="submit" value = "Update" />
					</form>
			</center>

			<div id="rightdiv">
			</div>
		</div>
	</body> 
	
	<footer id="footer"></footer>
</html>