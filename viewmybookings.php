<?php
	// checking if session has started
	session_start();

	// checking to see if session contains the user id
	if(!isset($_SESSION['USER']['user_id'])){
		header("Location: index.php");
		exit();
	}

	// storing and printing the firstname
	$firstname = $_SESSION['USER']['firstname'];
	echo "<span style = 'color:#A32222; #1472A5; padding: 20px; position: absolute; top: 11%;' ><b> Welcome $firstname </b> </span>";
		
?>
<html>
	<head>
		<title>My Bookings</title>
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-1.12.1.js"></script>
		
		<link rel="stylesheet" type="text/css" href="js/codebase/themes/message_default.css">
		<link rel="stylesheet" type="text/css" href="js/codebase/dhtmlx.css"/>
		
		<script type="text/javascript" src='js/codebase/message.js'></script>
		<script type="text/javascript" src="js/codebase/dhtmlx.js"></script>
	</head>
	
	<!--printing the view bookings table after the page loads -->
	<body onload= "viewBooking('<?php echo $_SESSION['USER']['user_id']; ?>')">
	
		
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
					<td class="item">My Bookings</td>
					<td class="item">Master Schedule</td>
					<td class="item">Manage Users</td>
					<td class="item" onclick="location.href='addbooking.php'">+ Add a booking</td>
				</tr>
			</table>	
		</div>
		
		<script>
			var current_object;
			var current_booking_id;
			var current_row_id;
			var current_user_id = <?php echo $_SESSION['USER']['user_id']; ?>;
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
						
					var data = "<tr id="+book.booking[i].booking_id+">"+ "<td>" + book.booking[i].booking_id + "</td>" + "<td>"+ book.booking[i].labname+ "</td>" +
					"<td>"+book.booking[i].bookingdate+ "</td>" + "<td>" + book.booking[i].bookingtime + "</td>" +
					"<td>"+ book.booking[i].org_name + "</td>" + "<td>" +
					book.booking[i].event_name + "</td>" + "<td>" + book.booking[i].event_description + "</td>" + "<td>"+ 
					"<span class='clickspot' onclick='showEditForm(this)'>"+ "Edit" + "</span>" + "<td>"+ 
					"<span class='clickspot' onclick='confirmDeleteDialog(this)'>"+ "Delete" + "</span>" + "</tr>";
					
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
			
			/**
			*makes an AJAX call to the server to delete a booking
			*/
			function deleteBooking(){
				
				var ajaxPageUrl="bookingajax.php?cmd=3&booking_id="+current_booking_id+"&user_id="+current_user_id;
				$.ajax(
					ajaxPageUrl,
					{async:true, complete:deleteBookingComplete}	
				);
			}
			
			/**
			*callback function for deleteBooking ajax call
			*/
			function deleteBookingComplete(xhr,status){
				if(status!="success"){
					dhtmlx.message("error while deleting booking");
					return;
				}

				// Get JSON String
				var JSONString = xhr.responseText;
				
				// Convert JSON String to JavaScript Object
				 var JSONObject = $.parseJSON(JSONString);
				 
				 // Dump all data of the Object in the console
				 console.log(JSONObject);
				 
				if(JSONObject.result == 1){
					document.getElementById("report").deleteRow(current_row_id);
				
					dhtmlx.message.expire = 10000; 
					dhtmlx.message(JSONObject.message);
				}else{
					dhtmlx.message.expire = 10000;
					dhtmlx.message(JSONObject.message);
				}
			}
		</script>

		<!-- Where main content will be -->
		<div id="content">
			<div id="leftdiv">
			</div>

			<center>
			<div id="middlediv">
				<table id = "report" class="viewTable">
					<thead> </thead>
								
					<tbody> </tbody>
				</table>
				
				<div id="tableformat" align="center">
					<form id="editForm" action="" method="POST" ></form>
				</div>
			</div>
			</center>

			<div id="rightdiv">
			</div>
		</div>
	</body> 
</html>