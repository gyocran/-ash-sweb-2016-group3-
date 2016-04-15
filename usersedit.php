<!DOCTYPE html>
<html>
	<head>
		<title>Lab Time | Edit User</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header  id="pageheader"> 
			<center><img src="images/pic.png" style="width:200px;height:90%";></center>
		</header> 
		<center><div><p1>This is the write up</p1></div></center>
		
		<table align="center">
		<!--This creates the menu bar-->
			<tr>
				<td class="item"><a class="a" href= "index.php?id=2"/>My Bookings</td>
				<td class="item"><a class="a" href= "viewmasterschedule.php"/>Master Schedule</td>
				<td class="item"><a class="a" href= "userslist.php"/>Manage Users</td>
				<td class="item" style="font-size:medium"><a class="a" href= "#"/>Logout</td>
			</tr>
		</table>
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

					<div id="divContent">
						<table id="tableformat" align="center">
					<form action = "" method = "POST">
						<tr>
						<td color="white"><label align="center">Username</label></td>
						<td><input type = "text" name = "username" value = "<?php echo $old_username; ?>"/> </td>
						 </tr>
						 
						 <tr>
						<td color="white"><label align="center">Password</label></td>
						<td><input type = "password" name = "password" value = "<?php echo $old_password; ?>"/> </td>
						</tr>
						 
						<tr>
						<td color="white"><label align="center">Firstname</label></td>
						<td><input type = "text" name = "firstname" value = "<?php echo $old_firstname; ?>"/> </td>
						</tr>
						 
						<tr>
						<td color="white"><label align="center">Lastname</label></td>
						<td><input type = "text" name = "lastname" value = "<?php echo $old_lastname; ?>"/> </td>
						</tr>
						 
						<tr>
						<td color="white"><label align="center">Usergroup</label></td>
						<td><select name = "usergroup"/> 
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
							</select></td>
						</tr>
				 
						<tr>
						<td color="white"><label align="center">Account Status</label></td>
						<td> <?php 
							if ($old_status == "ENABLED"){
								echo "<input type = 'radio' name = 'status' value = 'ENABLED' checked='checked' />Enabled
									<input type = 'radio' name = 'status' value = 'DISABLED'/>Disabled </td>";
							}else if ($old_status == "DISABLED"){
								echo "<input type = 'radio' name = 'status' value = 'ENABLED' />Enabled
									<input type = 'radio' name = 'status' value = 'DISABLED' checked='checked' />Disabled </td>";
							}else{
								echo "<input type = 'radio' name = 'status' value = 'ENABLED' />Enabled
									<input type = 'radio' name = 'status' value = 'DISABLED' />Disabled </td>";
							}
						?>
						</tr>
				
						<tr>
						<td color="white"><label align="center">Permission</label></td>
						<td><?php 
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
						</td>
						</tr>
						<tr><td></td>
					<td>
						<input type = "submit" name="submit" value = "Update" />
							</td>
				</tr>
					</form>
				</td>		
			</tr>			
		</table>		
	</body>
</html>