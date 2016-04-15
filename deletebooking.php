<?php
	$userId = $_REQUEST['user_id'];
	
	if (isset($_GET['booking_id'])){
		$bookingId = $_REQUEST['booking_id'];
	
		include_once("booking.php");
		$bookingObj = new booking();
		$delete_result = $bookingObj->deleteBooking($bookingId);
		
		if (!$delete_result){
			echo $conn->error;
		}else{
			echo "<script> location.replace(' index.php?id=$userId '); </script>";
		}
	}
	
	
	//redirect to list
	echo "<script> location.replace(' index.php?id=$userId '); </script>";
?>