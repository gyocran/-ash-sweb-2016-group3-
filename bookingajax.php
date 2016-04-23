<?php
	//check command
	if(!isset($_REQUEST['cmd'])){
		echo "cmd is not provided";
		exit();
	}
	
	//get command
	$cmd=$_REQUEST['cmd'];
	switch($cmd)
	{
		case 3:
			deleteBooking();
			break;
		default:
			echo "wrong cmd";	//change to json message
			break;
	}
	
	/**
	*delete a specified booking record
	*/
	function deleteBooking(){
		if(!isset($_REQUEST['user_id'])){
			echo  '{"result":0, "message":"User id not provided"}';
			exit();
		}
		
		$user_id = $_REQUEST['user_id'];
	
		if (!isset($_REQUEST['booking_id'])){
			echo  '{"result":0, "message":"Booking id not provided"}';
			exit();
		}
		
		$booking_id = $_REQUEST['booking_id'];
		
		include_once("booking.php");
		$bookingObj = new booking();
		$delete_result = $bookingObj->deleteBooking($booking_id, $user_id);
		
		if (!$delete_result){
			echo  '{"result":0, "message":"Booking was not Deleted"}';
		}else{
			echo '{"result":1, "message":"Booking Successfully Deleted"}';
		}
		
	}
?>