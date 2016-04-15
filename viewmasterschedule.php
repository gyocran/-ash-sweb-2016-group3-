<?php
	//include booking class
	include_once("booking.php");
	include_once("labs.php");

	// create object from booking class
	$obj = new booking();
	$obj2 = new labs();
?>
<html>
	<head>
	<title>Master Schedule for the day</title>
	</head>
	<body>
<?php 
	$date = date("Y-m-d");
	echo "All bookings for $date";
?>
		
<?php
			// form action="" method="GET">
				// <select name="date">
	//get all labs
	$times = array("8:00-9:00 am","9:00-10:00 am","10:00-11:00 am","11:00-12:00 pm","12:00-1:00 pm","1:00-2:00 pm","2:00-3:00 pm","3:00-4:00 pm","4:00-5:00 pm","5:00-6:00 pm");
	$rowcolor1 = "style='background-color:darkblue;color:white'";
	$rowcolor2 = "style='background-color:blue;color:white'";
	
	if(!$obj2->getAllLabs()){
		echo "Retrieval of all labs failed";
	}

	//fetch the result
	$labs=$obj2->fetch();
	
	//get all bookings for particular date
	if(!$obj->viewBookingByDate($date)){
		echo "Retrieval of bookings failed";
	}
	else{
	$row=$obj->fetch();

	//PUT IN A FUNCTION TABLE HEADING
	echo "<table cellspacing= 1 border=1 cellpadding=3>
			<tr>
			<td $rowcolor1>Time</td>
			</tr>";
	echo "<tr>
			<td $rowcolor1>LABS</td>";
			foreach($times as $value){
				echo "<td $rowcolor1>$value</td>";
			}
	echo "</tr>";

		while($row){
			echo "<tr>
				<td>{$row['labname']}</td>";
				foreach($times as $value){
					if($row['bookingtime']==$value){
						echo "<td>Booked</td>";
					}
					else{
						echo "<td></td>";
					}
				}
			$row=$obj->fetch();
		}
		echo "</table>";
	}
	
?>

			
				<input type="submit" value="search" >		
		</form>
	</body>
</html>	

<?php
	
?>