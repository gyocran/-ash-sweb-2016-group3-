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
					<td class="item" onclick="">Master Schedule</td>
					<td class="item" onclick="location.href='manage_users.php'">Manage Users</td>
					<td class="item" onclick="">+ Add a booking</td>
				</tr>
			</table>	
		</div>
		
		

		<!-- Where main content will be -->
		<div id="content">
				<div id="leftdiv">
				</div>

				<center><div id="middlediv">
					<table class="viewTable">
						<div>
							<input type="button" onClick="location.href='usersadd.php' " value="Add a New User">						
						</div>
						<div>
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
							<input type="submit" name="submit" value="Search" >		
						</form>
						</div>
						
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
								
								echo "<table class='viewTable'>";
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
								
								
								echo "<table class='viewTable'>";
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
					</table>
					
				</div></center>

				<div id="rightdiv">
				</div>
		</div>
	</body> 
	
	<footer id="footer"></footer>
</html>