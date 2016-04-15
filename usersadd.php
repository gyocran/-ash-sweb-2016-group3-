<!DOCTYPE html>
<html>
	<head>
		<title>Lab Time | Add User</title>
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
								$strStatusMessage="error while adding user";
							}else{
								$strStatusMessage="$username added";
								echo "<script> location.replace('userslist.php'); </script>";
							}
						}
					?>

					<div id="divContent">
						<table id="tableformat" align="center">
					<form action = "" method = "POST">
						<tr>
						<td color="white"><label align="center">Username</label></td>
						<td><input type = "text" name = "username" value = ""/>  </td>
						 </tr>
						 
						 <tr>
						<td color="white"><label align="center">Password</label></td>
						<td> <input type = "password" name = "password" value = ""/></td>
						</tr>
						 
						<tr>
						<td color="white"><label align="center">Firstname</label></td>
						<td><input type = "text" name = "firstname" value = ""/></td>
						</tr>
						 
						<tr>
						<td color="white"><label align="center">Lastname</label></td>
						<td><input type = "text" name = "lastname" value = ""/></td>
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
									echo "<option value = {$row["usergroup_id"]}>{$row["groupname"]}</option>";
								}
							?>
							</select></td>
						</tr>
				 
						<tr>
						<td color="white"><label align="center">Account Status</label></td>
						<td> <input type = 'radio' name = 'status' value = 'ENABLED' />Enabled
							<input type = 'radio' name = 'status' value = 'DISABLED'/>Disabled</td>
						</tr>
				
						<tr>
						<td color="white"><label align="center">Permission</label></td>
						<td><input type ='checkbox' name ='permission[]' value='View' />View
							<input type ='checkbox' name ='permission[]' value='Add' />Add 
							<input type ='checkbox' name ='permission[]' value='Delete' />Delete 
							<input type ='checkbox' name ='permission[]' value='Update' />Update
						</td>
						</tr>
						<tr><td></td>
					<td>
						<input type = "submit" name = "submit" value = "Add" />
							</td>
				</tr>
					</form>
				</td>		
			</tr>			
		</table>		
	</body>
</html>