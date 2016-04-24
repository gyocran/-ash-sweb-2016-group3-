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
			*customized function for confirming or rejecting  delete request
			*/
			function confirmDeleteDialog(obj){
				current_object = obj;
				current_row_id = current_object.parentNode.parentNode.rowIndex;
				current_booking_id = $(current_object).closest('tr').attr('id');
				
				dhtmlx.confirm(
					{
						text:"Do you really want to delete this record?", 
						callback:function(result){
							if (result) { deleteBooking(); }
						}
					}
				);
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
			
			/**
			*fetches  booking details from server to fill edit form
			*/
			function fetchCurrentBookingDetails(booking_id, user_id){
				$(function(){
					$.getJSON("bookingajax.php?cmd=0"+"&booking_id="+booking_id+"&user_id="+user_id, function(data){
					
							var labs = "<option value ='Dlab'>Dlab</option><option value ='englab'>englab</option>"+
							"<option value ='lab221'>lab221</option><option value ='lab222'>lab222</option>"+
							"<option value="+data.labname+" selected>"+data.labname+"</option>";
							
							var time = "<option value ='8:00-9:00 am'>8:00-9:00 am</option><option value ='9:00-10:00 am'>9:00-10:00 am</option>"+
							"<option value="+data.bookingtime+" selected>"+data.bookingtime+"</option>"+
							"<option value ='10:00-11:00 am'>10:00-11:00 am</option><option value ='11:00-12:00 am'>11:00-12:00 am</option>"+
							"<option value ='12:00-1:00 pm'>12:00-1:00 pm</option><option value ='1:00-2:00 pm'>1:00-2:00 pm</option>"+
							"<option value ='2:00-3:00 pm'>2:00-3:00 pm</option><option value ='3:00-4:00 pm'>3:00-4:00 pm</option>"+
							"<option value ='4:00-5:00 pm'>4:00-5:00 pm</option><option value ='5:00-6:00 pm'>5:00-6:00 pm</option>";
							
							$("form#editForm input#cmd").val('4');
							$("form#editForm input#booking_id").val(data.booking_id);
							$("form#editForm input#user_id").val(data.user_id);
							$("form#editForm input#org_name").val(data.org_name);
							$("form#editForm input#event_name").val(data.event_name);
							$("form#editForm input#event_description").val(data.event_description);
							$("form#editForm #labname").html(labs);
							$("form#editForm input#bookingdate").val(data.bookingdate);
							$("form#editForm #bookingtime").html(time);
					});
				});
			}
			
			/**
			*shows a form with booking records ready to be editted and submitted
			*/
			function showEditForm(obj){
				current_object = obj;
				current_row_id = current_object.parentNode.parentNode.rowIndex;
				current_booking_id = $(current_object).closest('tr').attr('id');
				
				$("#tableformat #editForm").html("");
				var edit_form = "<tr><td><input  type= 'hidden' id='cmd' value ='4' /></td></tr>" +
							"<tr><td><input type='hidden' id='booking_id'  value ="+current_booking_id+" /></td></tr>"+
							"<tr><td><input type='hidden' id='user_id'  value ="+current_user_id+" /></td></tr>"+
							"<tr><td><input type='text'  id='org_name'  value ='' /></td></tr>"+
							"<tr><td><input type='text'  id='event_name'  value ='' /></td></tr>"+
							"<tr><td><input type='text'  id='event_description'  value ='' /></td></tr>"+
							"<tr><td><select id='labname'></select></td></tr>"+
							"<tr><td><input type='date' id='bookingdate'  value ='' /></td></tr>"+
							"<tr><td><select id = 'bookingtime'></select></td></tr>"+
							"<tr><td><button style='float:right'; onclick='editBooking()' >Update</button><input type='submit'  value='Cancel' /></td></tr>";
				
				$(edit_form).appendTo("#tableformat #editForm");
				
				fetchCurrentBookingDetails(current_booking_id, current_user_id);
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