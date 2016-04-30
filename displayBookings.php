<html>
	<head>
		<title>Lab Time | MasterSchedule</title>
		<link rel="stylesheet" href="css/style.css">
		<script type="text/javascript" src="js/jquery-1.12.1.js"></script>
		
		<script type="text/javascript">
			function displayBookingsComplete(xhr) {
				var obj = $.parseJSON(xhr.responseText);
				var i = 0;
				var j = 0;
				var k = 0;
				var result = obj.AllBookings.outcome[0].result;

				// if result==2, display by week
				if (result === 2) {
				    document.writeln(document.getElementById('displayTable').innerHTML="<table class = 'viewTable'>");
				    document.writeln("<tr><td colspan=2></td>");
				    document.writeln("<th colspan=10>Time</th>");
				    document.writeln("</tr>");
				    document.writeln("<tr>");
				    document.writeln("<th>Date</th>");
				    document.writeln("<th>Labs</th>");
				    for (j = 0; j < obj.AllBookings.times.length; j++) {
					document.writeln("<td>" + obj.AllBookings.times[j].Time + "</td>");
				    }
				    document.writeln("</tr>");
				    for (i = 0; i < obj.AllBookings.bookings.length; i++) {
					var mod = i % 4;
					if (mod === 0) {
					    document.writeln("<tr><td rowspan = 4>" + obj.AllBookings.bookings[i].Date + "</td>");
					}

					document.writeln("<td>" + obj.AllBookings.bookings[i].LabName + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status0 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status1 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status2 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status3 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status4 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status5 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status6 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status7 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status8 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status9 + "</td>");
					document.writeln("</tr>");
					console.log(k);
					console.log(i);
				    }
				}



				else {
				    document.writeln("<table>");
				    document.writeln("<tr>");
				    document.writeln("<td></td>");
				    document.writeln("<th colspan=10>Time</th>");
				    document.writeln("</tr>");
				    document.writeln("<tr>");
				    document.writeln("<th>Labs</th>");
				    console.log(obj.AllBookings.bookings.length);
				    for (i = 0; i < obj.AllBookings.times.length; i++) {
					document.writeln("<td>" + obj.AllBookings.times[i].Time + "</td>");
				    }

				    for (i = 0; i < obj.AllBookings.bookings.length; i++) {
					document.writeln("</tr>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].LabName + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status0 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status1 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status2 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status3 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status4 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status5 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status6 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status7 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status8 + "</td>");
					document.writeln("<td>" + obj.AllBookings.bookings[i].status9 + "</td>");
					document.writeln("</tr>");
				    }

				}
				document.writeln("</table>");
			    }

			    function displayBookings(obj) {
				var theUrl = "displayBookings_ajax.php?cmd=" + obj.value;
				$.ajax(theUrl,
					{async: true,
					complete: displayBookingsComplete}
				);
			    }
		</script>
	</head>
    
	<body>
		<header id="pageheader">

			<div style="width:10%; height:100%;float: left;"></div>

			<div style="width:80%; float: left;">
				<center><img src="css/images/logo.gif" style="width:180px;height:105%;"> </center>
			</div>

			<div style="width:10%; float: left;">	
			<span class= "logout" onClick="location.href='index.php'"> Login</span>
			</div>

		</header>	

		<div id ="navbar">
			<table align="center">
			<!--This creates the menu bar-->
				<tr>
					<td class="item" onclick="location.href='viewmybookings.php'">My Bookings</td>
					<td class="item" onclick="location.href = 'displayBookings.php'">Master Schedule</td>
					<td class="item" onclick="location.href='manage_users.php'">Manage Users</td>
					<td class="item" onclick="location.href = 'addbooking.php'">+ Add a booking</td>
				</tr>
			</table>	
		</div>

		<!-- Where main content will be -->
		<div id="content">
			<div id="leftdiv">
			</div>
			
			<center>
			<div id="middlediv">
				<p id="h">Please Select Your Option From The Drop Down Below</p>
				<form id="form">
				    <select id= "displayvalue" onchange="displayBookings(this)">
					<option value='0'></option>
					<option value='1'><strong>Today</strong></option>
					<option value='2'><strong>This week</strong></option>
				    </select>
				</form>
		
				<table id="displayTable"></table>
			</div>
			</center>

			<div id="rightdiv">
			</div>
		</div>
		
	</body> 
	
	<footer id="footer"></footer>
</html>

