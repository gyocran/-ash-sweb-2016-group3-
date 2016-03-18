<?php

	if (isset($_GET['bookingId'])){
		$bookingId = $_REQUEST['bookingId'];
		
		include_once("booking.php");
		$bookingObj = new booking();
		$delete_result = $bookingObj->deleteBooking($bookingId);
		
		if (!$delete_result){
			echo $conn->error;
			exit();
		}else{
			header('location:index.php');
		}
	}
	
	//redirect to list
	header('location:index.php');	
?>