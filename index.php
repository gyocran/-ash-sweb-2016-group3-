<html>
	<head>
		<title>Lab Time | Home</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<header  id="pageheader"> 
			<center><img src="pic.png" style="width:200px;height:90%";></center>
		</header> 
		<table align="center">
		<!--This creates the menu bar-->
			<tr>
				<td class="item">My Bookings</td>
				<td class="item">Master Schedule</td>
				<td class="item">Manage Users</td>
				<td class="item">Logout</td>
			</tr>
		</table>
			
		<table id="tableformat" align="center">
		<!--This creates the form in which the user enter the details-->
			<!---->
				<table class="reportTable">
				<input class="button-add" onClick="'' " value="Add New Booking" style="float:right">
							<tr class="header">
							<th>Booking ID</th>
							<th>Lab Name</th>
							<th>Booking Date</th>
							<th>Booking Time</th>
							<th>Name of Organization</th>
							<th>Event Name</th>
							<th>Event Description</th>
							<th></th>
							<th></th>
							<th></th>
							</tr>
							
							<?php
							include_once("booking.php");
							
							if (isset ($_REQUEST['id'])){
								
								$userID = $_REQUEST['id'];
							
							$book = new booking();
							
							$booking = $book -> viewMyBooking($userID);
							
							if ($booking==false){
								echo "Error";
								exit();
							}
							
							else
							{
								$row = $book ->fetch();
							$counter =1;
							while ($row!=false)
							{
								
								if ($counter%2==0)
								{
								echo"<tr>
				
				<td bgcolor = #ffff66>{$row["booking_id"]}</td> <td bgcolor = #ffff66> {$row["labname"]} </td> <td bgcolor= #ffff66>{$row["bookingdate"]}</td>  <td bgcolor= #ffff66>{$row["bookingtime"]}</td> <td bgcolor= #ffff66>{$row["org_name"]}</td>
				<td bgcolor= #ffff66>{$row["event_name"]}</td> <td bgcolor= #ffff66>{$row["event_description"]}</td>
				<td bgcolor= #ffff66 width=3.5%> <a href = 'editbooking.php?booking_id={$row["booking_id"]}' ><img src='pencil.jpg' alt='edit' style='width:80%; height:45%;'> </a> </td>
				<td bgcolor= #ffff66 width=3.5%> <a href = 'deletebooking.php?booking_id={$row["booking_id"]}&user_id={$row["user_id"]}' ><img src='delete.jpg' alt='delete' style='width:75%; height:15%;'></a></td>  
				</tr>";	
								}
								
								else
								{
									echo"<tr>
				
				<td>{$row["booking_id"]}</td> <td> {$row["labname"]} </td> <td>{$row["bookingdate"]}</td>  <td>{$row["bookingtime"]}</td> <td>{$row["org_name"]}</td>
				<td>{$row["event_name"]}</td> <td>{$row["event_description"]}</td>
				<td width=3.5%> <a href = 'editbooking.php?booking_id={$row["booking_id"]}' ><img src='pencil.jpg' alt='edit' style='width:80%; height:45%;'> </a> </td>
				<td width=3.5%> <a href = 'deletebooking.php?booking_id={$row["booking_id"]}&user_id={$row["user_id"]}' ><img src='delete.jpg' alt='delete' style='width:75%; height:15%;'></a></td>  
				</tr>";	
								}
							$counter++;
							$row = $book ->fetch();
							
							}
							}
							}
							?>

				</table>	
	</body> 
</html>