<?php
//The session starts when the page is open
	session_start();

		if(!isset($_SESSION['USER']['user_id'])){ //The sessions is checked for an id
			header("Location: login.php");	 	 //If there is no id, it returns to the login page
			exit();
		}

	$firstname = $_SESSION['USER']['firstname'];  //The first name of the user is saved an displayed in the html
	echo "<span style = 'color:#A32222; #1472A5; padding: 20px; position: absolute; top: 11%;' ><b> Welcome $firstname </b> </span>";
?>

<html>
	<head>
		<title>Add New Booking</title>

		<link rel="stylesheet" href="style.css"> 
	<body>
		<header  id="pageheader"> 
			<div style="width:10%; height:100%;float: left;"></div>
			<div style="width:80%; float: left;">
				<center><img src="images/logo.gif" style="width:180px;height:105%";></center>
			</div>
			<div style="width:10%; float: left;">
					<span class= "logout"> Logout</span>
			</div>
		</header> 



		<div id="navbar">
			<table align="center">
			<!--This creates the menu bar-->
				<th>
					<td class="item" onclick= "location.href='viewmybookings.php'">My Bookings</td>
					<td class="item">Master Schedule</td>
					<td class="item">Manage Users</td>
					<td class="item">+ Add a booking</td>
				</th>
			</table>	
		</div>

		<!-- Where main content will be -->
		<div id="content">
				<div id="leftdiv">
				</div>

				<center><div id="middlediv">
					<table id="tableformat" align="center">
					<!--This creates the form in which the user enter the details-->
					<form action="" method="POST" >
					<!--This displays the labels and text boxes in order-->
						<tr>

						<td><input type= "hidden" id="id" value ="<?php echo $_SESSION['USER']['user_id']; ?>"></td>
						<td><input  type= "hidden" id="cmd" value ="1"></td>
							
						</tr>

						<tr>
							<td><input type="text" placeholder="Name/Organization" id="org_name"></td>
						</tr>
						<tr>
							<td><input type="text" placeholder="Event Name" id="event_name"></td>
						</tr>
						<tr>
							<td><input type="text" placeholder="Event Description" id="event_description"></td>
						</tr>
						<tr>
							<td><select id="labname">
								<option value='' >Select a lab</option>
								<?php
									//a call to the class
									include_once("labs.php");
									$labs= new labs();
									$result=$labs->getAllLabs();
									//echo $strQuery;
									if($result==false){
										//
										echo "result is false";
									}else{
										while($row=$labs->fetch()){
											echo "<option value='{$row['labname']}'>{$row['labname']}</option>";
										}
									}//display in loop
								?>	
							 </select>
						</tr>
						<tr>
							<td><input type=date id="bookingdate" placeholder="Date" /></td>
						</tr>
						<tr>
							<td><select id = "bookingtime">
									<option value=null>Select the time</option>
									<option value="8:00-9:00 am">8:00-9:00 am</option>
									<option value="9:00-10:00 am">9:00-10:00 am</option>
									<option value="10:00-11:00 am">10:00-11:00 am</option>
									<option value="11:00-12:00 am">11:00-12:00 am</option>
									<option value="1:00-2:00 pm">1:00-2:00 pm</option>
									<option value="2:00-3:00 pm">2:00-3:00 pm</option>
									<option value="3:00-4:00 pm">3:00-4:00 pm</option>
									<option value="4:00-5:00 pm">4:00-5:00 pm</option>
									<option value="5:00-6:00 pm">5:00-6:00 pm</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
									<input type="button" style="float:right"; onclick="addbooking()" value="Submit">
										<input type="submit"  value="Cancel">
									</td>
								</tr>
							</form>
						</table>
					</div>
				</center>

				<div id="rightdiv">
				</div>
		</div>

	

		</div>

	</body> 

	<footer id="footer"></footer>
</html>
			