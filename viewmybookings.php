<?php
	// checking if session has started
	session_start();

	// checking to see if session contains the user id
	if(!isset($_SESSION['USER']['user_id'])){
		header("Location: login.php");
		exit();
	}

	// storing and printing the firstname
	$firstname = $_SESSION['USER']['firstname'];
	echo "<span style = 'color:#A32222; #1472A5; padding: 20px; position: absolute; top: 11%;' ><b> Welcome $firstname </b> </span>";
		
?>
<html>
	<head>
		<title>My Bookings</title>
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="js/jquery-1.12.1.js"></script>
	</head>
	
	<!--printing the view bookings table after the page loads -->
	<body onload= "viewBooking('<?php echo $_SESSION['USER']['user_id']; ?>')">
	
		
		<header id="pageheader">

			<div style="width:10%; height:100%;float: left;"></div>

			<div style="width:80%; float: left;">
				<center><img src="images/logo.gif" style="width:180px;height:105%;"> </center>
			</div>

			<div style="width:10%; float: left;">	
			<span class= "logout" onClick="location.href='logout.php'"> Logout</span>
			</div>

		</header>	

		<div id ="navbar">
			<table align="center">
			<!--This creates the menu bar-->
				<tr>
					<td class="item">My Bookings</td>
					<td class="item">Master Schedule</td>
					<td class="item">Manage Users</td>
					<td class="item" onclick="location.href='addbooking.php'">+ Add a booking</td>
				</tr>
			</table>	
		</div>
		
		<script>
			
			/*
			callback function for view booking method
			*/
			function viewBookingComplete(xhr,status)
			{
				if (status!="success")
				{
					alert("Error");
					return;
				}
				
				var book = $.parseJSON(xhr.responseText);
				
				if (book==false)
				{
				alert("Error loading bookings");	
				}
				else
				{
					// printing the table headers
					$("#report thead").html("");
					var dataHeader = "<tr>" + "<th>" + "Booking ID" + "</th>" + "<th>" + "Lab Name" + "</th>" + "<th>" + 
					 "Booking Date" + "</th>" + "<th>" + "Booking Time" + "</th>" + "<th>" + "Name of Organization" + "</th>" +
					"<th>" + "Event Name" + "</th>"+ "<th>" + "Event Description" + "</th>" + "<th>" + " " + "</th>"+
					"<th>" + " " + "</th>"+ "</tr>";
					$(dataHeader).appendTo("#report thead");
					
					
					// printing the table data
					$("#report tbody").html("");
					for(i=0; i< book.booking.length; i++){
						
					var data = "<tr>"+ "<td>" + book.booking[i].booking_id + "</td>" + "<td>"+ book.booking[i].labname+ "</td>" +
					"<td>"+book.booking[i].bookingdate+ "</td>" + "<td>" + book.booking[i].bookingtime + "</td>" +
					"<td>"+ book.booking[i].org_name + "</td>" + "<td>" +
					book.booking[i].event_name + "</td>" + "<td>" + book.booking[i].event_description + "</td>" + "<td>"+ 
					"<span class='clickspot'>"+ "Edit" + "</span>" + "<td>"+ 
					"<span class='clickspot'>"+ "Delete" + "</span>" + "</tr>";
					
					$(data).appendTo("#report tbody");
					}
					
				}
			}
			
			
			/*makes request to the ajax page
			*/
			function viewBooking(id)
			{
				var url = "bookingajax.php?cmd=2&id="+id;
				$.ajax(url,{
					async:true, complete: viewBookingComplete
				});
				
			}
		</script>

		<!-- Where main content will be -->
		<div id="content">
				<div id="leftdiv">
				</div>

		<center><div id="middlediv">
				<table id = "report" class="viewTable">
						<thead> </thead>
							
						<tbody> </tbody>
							
				</table>	
				
		</div></center>

				<div id="rightdiv">
				</div>
		</div>

	

		</div>

	</body> 
</html>