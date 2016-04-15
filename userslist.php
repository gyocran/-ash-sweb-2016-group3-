<!DOCTYPE html>
<html>
	<head>
		<title>Lab Time | Edit Booking</title>
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
					
		<div id="divContent">
						
				<div>
					<input type="button" onClick="location.href='usersadd.php' " value="Add New User">						
				</div>
				
				<form action="" method="POST">
					<input type="text" name="txtSearch">
					<select name = "usergroup"/> 
						<?php
							include_once("usergroups.php");
							$usergroupObj = new usergroups();
							$usergroupObj->getAllUserGroups();
							
							echo "<option value = '-1' >--Filter Search By UserGroup--</option>";
							while($row = $usergroupObj->fetch()){
								echo "<option value = {$row["usergroup_id"]} >{$row["groupname"]}</option>";
							}
						?>
					</select>
					<input type="submit" name="submit" value="search" >		
				</form>
				
				<?php

					//1) Create object of users class
					//2) Call the object's getUsers method and check for error
					//3) show the result
					
					include_once("users.php");
					$userObj = new users();
					$results = $userObj->getUsers();
								
					//1) what is the purpose of this if block
					if(!$results){
						$strStatusMessage="error while getting user";
					}else{
						$strStatusMessage="users gotten";
					}
					
					//If no st_var  and no sort_var
					if ( !isset($_POST['submit']) ){
						
						echo "<table border=0.7 width = 100%>";
						echo "<th bgcolor=orange style=color:white>UserName</th>
							<th bgcolor=orange style=color:white>Full Name</th>
							<th bgcolor=orange style=color:white>Group</th>
							<th bgcolor=orange style=color:white>Status</th>
							<th bgcolor=orange style=color:white></th>
							<th bgcolor=orange style=color:white></th>";
							
						$mem=0;
						while($row = $userObj->fetch()){
							if($mem ==0){
								echo "<tr>
										<td bgcolor=white>{$row["username"]}</td>
										<td bgcolor=white>{$row["firstname"]} {$row["lastname"]}</td>
										<td align=right bgcolor=white>{$row["usergroup"]}</td>
										<td bgcolor=white><a href = 'change_user_status.php?usercode={$row["user_id"]}&status={$row["status"]}' >{$row["status"]}</a></td>
										<td bgcolor=white><a href = 'usersedit.php?usercode={$row["user_id"]}' >Edit</a></td>
										<td bgcolor=white><a href = 'usersdelete.php?usercode={$row["user_id"]}' >Delete</a></td>
									</tr>";
								$mem=1;	
							}else{
								echo "<tr>
										<td bgcolor=orange>{$row["username"]}</td>
										<td bgcolor=orange>{$row["firstname"]} {$row["lastname"]}</td>
										<td align=right bgcolor=orange>{$row["usergroup"]}</td>
										<td bgcolor=orange><a href = 'change_user_status.php?usercode={$row["user_id"]}&status={$row["status"]}' >{$row["status"]}</a></td>
										<td><a href = 'usersedit.php?usercode={$row["user_id"]}' >Edit</a></td>
										<td><a href = 'usersdelete.php?usercode={$row["user_id"]}' >Delete</a></td>
									</tr>";
								$mem=0;	
							}
						}
						echo "</table>";
					
					//Else if st_var but no sort_var
					}else if ( isset($_POST['submit']) ){
						$searchTxt = $_REQUEST['txtSearch'];
						$groupID = $_REQUEST['usergroup'];
						
						if($searchTxt==null && $groupID==-1){
							$userObj->searchUsers(false, false);
						}else if($searchTxt==null && $groupID!=-1){
							$userObj->searchUsers(false, $groupID);
						}else if($searchTxt!=null && $groupID==-1){
							$userObj->searchUsers($searchTxt, false);
						}else if($searchTxt!=null && $groupID!=-1){
							$userObj->searchUsers($searchTxt, $groupID);
						}
						
						
						echo "<table border=0.7 width = 100%>>";
						echo "<th bgcolor=orange style=color:white>UserName</th>
							<th bgcolor=orange style=color:white>Full Name</th>
							<th bgcolor=orange style=color:white>Group</th>
							<th bgcolor=orange style=color:white>Status</th>
							<th bgcolor=orange style=color:white></th>
							<th bgcolor=orange style=color:white></th>";
					
						$mem=0;
						while($row = $userObj->fetch()){
							if($mem ==0){
								echo "<tr>
										<td bgcolor=white>{$row["username"]}</td>
										<td bgcolor=white>{$row["firstname"]} {$row["lastname"]}</td>
										<td align=right bgcolor=white>{$row["usergroup"]}</td>
										<td bgcolor=white><a href = 'change_user_status.php?usercode={$row["user_id"]}&status={$row["status"]}' >{$row["status"]}</a></td>
										<td bgcolor=white><a href = 'usersedit.php?usercode={$row["user_id"]}' >Edit</a></td>
										<td bgcolor=white><a href = 'usersdelete.php?usercode={$row["user_id"]}' >Delete</a></td>
									</tr>";
								$mem=1;	
							}else{
								echo "<tr>
										<td bgcolor=orange>{$row["username"]}</td>
										<td bgcolor=orange>{$row["firstname"]} {$row["lastname"]}</td>
										<td align=right bgcolor=orange>{$row["usergroup"]}</td>
										<td bgcolor=orange><a href = 'change_user_status.php?usercode={$row["user_id"]}&status={$row["status"]}' >{$row["status"]}</a></td>
										<td bgcolor=orange><a href = 'usersedit.php?usercode={$row["user_id"]}' >Edit</a></td>
										<td bgcolor=orange><a href = 'usersdelete.php?usercode={$row["user_id"]}' >Delete</a></td>
									</tr>";
								$mem=0;	
							}
						}
						
						echo "</table>";
					}
				?>		
		</div>
	</body>
</html>	