<!DOCTYPE html>
<html>
	<head>
		<title>Users List</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
			
		</script>
	</head>
	<body>
		<table>
			<tr>
				<td colspan="2" id="pageheader">
					EDIT USER
				</td>
			</tr>
			<tr>
				<td id="mainnav">
					<div class="menuitem">menu 1</div>
					<div class="menuitem">menu 2</div>
					<div class="menuitem">menu 3</div>
					<div class="menuitem">menu 4</div>
				</td>
				<td id="content">
					<div id="divPageMenu">
						<span class="menuitem"><a href= "viewmasterschedule.php">View MasterSchedule</a></span>
						<span class="menuitem" ><a href= "index.php?id=2">My Bookings</a></span>
						<span class="menuitem" ><a href= "userslist.php">Manage Users</a></span>
						<input type="text" id="txtSearch" />
						<span class="menuitem">search</span>		
					</div>
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
									 echo "<script> location.replace('userslist.php'); </script>";
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
					<div id="divStatus" class="status">
						<?php echo  $strStatusMessage ?>
					</div>
					<div id="divContent">
						Content space
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
				</td>		
			</tr>			
		</table>		
	</body>
</html>