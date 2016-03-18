<?php
	$color = 1;
	//include booking class
	include_once("booking.php");
	
	//create object from booking class
	$obj = new booking();
?>
<html>
	<head>
	</head>
	<body>
		<form action="" method="GET">
						<input type="text" name="date">
						<input type="submit" value="search" >		
		</form>
	</body>
</html>	

<?php
	if(isset($_REQUEST['date'])){
		$temp = $_REQUEST['date'];
		$date = "\"$temp\"";
	
	$t = $obj->viewBookingByDate($date);
	
	if(!$t)
		echo "Unable to retrieve bookings";
	
	$row = $obj->fetch();
	
	// print_r($e);
	
	echo "<table cellspacing= 1 border=1 cellpadding=3>
			<tr style='background-color:#C47451;text-align:left'>
			<td>Lab Name</td>
			<td>Starting Time</td>
			<td>Ending Time</td>
			</tr>";
	
	if($color==1){
		echo	
			"<tr style='background-color:#FFF380;text-align:left'>
			<td>{$row['labname']}</td>
			<td><strong>{$row['start_time']}</strong></td>
			<td><strong>{$row['end_time']}</strong></td>
			</tr>";
		$color=2;
	}
	
	else{
		echo 
			"<tr style='background-color:#FFA62F;text-align:left'>
			<td>{$row['labname']}</td>
			<td><strong>{$row['start_time']}</strong></td>
			<td><strong>{$row['end_time']}</strong></td>
			</tr>";
		$color=1;
	}
	echo "</table>";
	}
	else{
		echo "Please enter a date";
	}
	
?>
