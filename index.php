<html>
	<head>
		<title>Index</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
			
		</script>
	</head>
	<style>
	

	</style>
	<body>
		<table>
			<tr>
				<td colspan="2" id="pageheader">
					BOOK-A-LAB
				</td>
			</tr>
			<tr>
				<td id="mainnav" style span = "color: lightblue">
					<div class="menuitem">menu 1</div>
					<div class="menuitem">menu 2</div>
					<div class="menuitem">menu 3</div>
					<div class="menuitem">menu 4</div>
				</td>
				<td id="content">
					<div id="divPageMenu">
						<span class="menuitem" >page menu 1</span>
						<span class="menuitem" >page menu 2</span>
						<span class="menuitem" >page menu 3</span>
						<input type="text" id="txtSearch" />
						<span class="menuitem">search</span>		
					</div>
					<div id="divStatus" class="status">
						status message
					</div>
					<div id="divContent">
						Content space
						<span class="clickspot">click here </span>
						<table id="tableExample" class="reportTable" width="100%">
							<tr class="header">
								<td> Booking ID </td>
								<td> Lab Name </td>
								<td> Booking Date </td>
								<td> Start Time </td>
								<td> End Time </td>
								<td> Booking Status </td>
							</tr>
							
							<?php
							include_once("booking.php");
							$book = new booking();
							
							$row = $book -> viewMyBooking(3);
							
							if ($row!=false)
							{
								echo"<tr>
				
				<td bgcolor = lightblue>{$row["booking_id"]}</td> <td bgcolor = lightblue> {$row["labname"]} </td> <td bgcolor= lightblue>{$row["bookingdate"]}</td>  <td bgcolor= lightblue>{$row["start_time"]}</td> <td bgcolor= lightblue>{$row["end_time"]}</td>
				<td bgcolor= lightblue>{$row["bookingstatus"]}</td> </tr>";	
	
							
							}
								
							?>
								
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>	