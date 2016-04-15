<html>
	<head>
		<title>Lab Time | Add Booking</title>
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

		<table id="tableformat" align="center">
		<!--This creates the form in which the user enter the details-->
			<form action="" method="GET">
			<!--This displays the labels and text boxes in order-->
				<tr>
					<td color="white"><label align="center">User ID</label></td>
					<td><input type="text" name="user_id"></td>
					
				</tr>
				<tr>
					<td><label>Name/Org:</label></td>
					<td><input type="text" name="org_name"></td>
				</tr>
				<tr>
					<td><label>Event Name:</label></td>
					<td><input type="text" name="event_name"></td>
				</tr>
				<tr>
					<td><label>Event Description:</label></td>
					<td><input type="text" name="event_description"></td>
				</tr>
				<tr>
					<td><label>Lab Name:</label></td>
					<td><input type="text" name="org_name"></td>
				</tr>
				<tr>
					<td><label>Date:</label></td>
					<td><input type=date name="bookingdate"/></td>
				</tr>
				<tr>
					<td><label>Time:</label></td>
					<td><select name = "bookingtime">
							<option value="8:00-9:00 am">8:00-9:00 am</option>
							<option value="9:00-10:00 am">9:00-10:00 am</option>
							<option value="10:00-11:00 am">10:00-11:00 am</option>
							<option value="11:00-12:00 am">11:00-12:00 am</option>
							<option value="12:00-1:00 pm">12:00-1:00 pm</option>
						</select>
					</td>
				</tr>
				<tr><td></td>
					<td>
						<input type="submit" value="Submit">
						<input type="submit" value="Cancel">
					</td>
				</tr>
			</form>
		</table>	
	</body> 
</html>