<!DOCTYPE html>
<html>
	<head>
		<title>Add New User</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
			<!--add validation js script here
		</script>
	</head>
	<body>
		<table>
			<tr>
				<td colspan="2" id="pageheader">
					ADD NEW USER
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
						<span class="menuitem" >page menu 1</span>
						<span class="menuitem" >page menu 2</span>
						<span class="menuitem" >page menu 3</span>
						<input type="text" id="txtSearch" />
						<span class="menuitem">search</span>		
					</div>
					
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
	</body>
</html>
