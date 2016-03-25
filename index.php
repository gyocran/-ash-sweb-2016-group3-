<html>
	<head>
		<title>Index</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
			
		</script>
	</head>
	<body>
		<table>
			<tr>
				<td colspan="2" id="pageheader">
					BOOK-A-LAB
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
						<span class="menuitem"><a href= "#">View MasterSchedule</a></span>
						<span class="menuitem" ><a href= "index.php?id=2">My Bookings</a></span>
						<span class="menuitem" ><a href= "userslist.php">Manage Users</a></span>
						<input type="text" id="txtSearch" />
						<span class="menuitem">search</span>		
					</div>
					<div id="divStatus" class="status">
						status message
					</div>
					<div id="divContent">
						Content space
						<span class="clickspot">click here </span>
						
						<div>
							<input type="button" onClick="location.href='addbooking.php' " value="Add a New Booking">						
						</div>
						
						<table id="tableExample" class="reportTable" width="100%">
							<tr class="header">
								<td> Booking ID </td>
								<td> Lab Name </td>
								<td> Booking Date </td>
								<td> Booking Time</td>
								<td> Name of Organization </td>
								<td> Event Name </td>
								<td> Event Description </td>
								<td> </td>
								<td></td>
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
							
								while ($row = $book -> fetch()){
									echo"<tr>
									<td bgcolor = lightblue>{$row["booking_id"]}</td> 
									<td bgcolor = lightblue> {$row["labname"]} </td> 
									<td bgcolor= lightblue>{$row["bookingdate"]}</td>  
									<td bgcolor= lightblue>{$row["bookingtime"]}</td> 
									<td bgcolor= lightblue>{$row["org_name"]}</td>
									<td bgcolor= lightblue>{$row["event_name"]}</td> 
									<td bgcolor= lightblue>{$row["event_description"]}</td> 
									<td bgcolor=lightblue><a href = 'editbooking.php?booking_id={$row["booking_id"]}' >Edit</a></td>
									<td bgcolor=lightblue><a href = 'deletebooking.php?booking_id={$row["booking_id"]}&user_id={$row["user_id"]}' >Delete</a></td>
									</tr>";
								}
							}
							
							
							?>
								
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>	