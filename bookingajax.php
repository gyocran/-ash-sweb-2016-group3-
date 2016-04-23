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
		case 2:
			myBookings();
			break;
		case 3:
			deleteBooking();
			break;
		default:
			echo '{"result":0, "message":"wrong command"}';
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
	
	// function to view user booking
	function myBookings(){
		include_once("booking.php");
		//check if there is a user code
		if(!isset($_REQUEST['id'])){
			echo '{"result":0,"message":"User code not provided"}';		
			return;
		}
		$userID=$_REQUEST["id"];
		
		//create an object of booking
		$book=new booking();
		
		// call get user method
		$view=$book->viewMyBooking($userID);

		
		// checking if bookings have been gotten from database
		if($view==false){
			echo '{"result":0,"message":"User code not provided"}';	
			return;
		}
		
		// getting the bookings 
		$db = $book -> fetch();
		
		// checking for bookings and printing them in JSON format
		if ($db==false)
		{
			echo "Error";
		}
		else{
		echo '{"result":1,"booking":[';
		   while($db!=false){
			echo json_encode($db);
			$db = $book -> fetch();
			if ($db)
			{
				echo ',';	
			}

		   }
		echo ']}';
		}
	}
?>