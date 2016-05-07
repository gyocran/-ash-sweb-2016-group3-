<?php
	//check command
	if(!isset($_REQUEST['cmd'])){
		echo '{"result":0, "message":"command not provided"}';
		exit();
	}
	
	//get command
	$cmd=$_REQUEST['cmd'];
	switch($cmd)
	{	
		case 0:
			getSpecifiedBooking();
			break;
		case 1:
			addBooking(); 
			break;
		case 2:
			myBookings();
			break;
		case 3:
			deleteBooking();
			break;
		case 4:
			editBooking();
			break;
		default:
			echo '{"result":0, "message":"wrong command"}';
			break;
	}
	
	/**
	*get a specified booking record
	*/
	function getSpecifiedBooking(){
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
		$bookingObj->getBooking(" booking_id = '$booking_id' and user_id = '$user_id' ");
		$booking_details = $bookingObj->fetch();
		
		if ($booking_details){
			echo json_encode($booking_details);
		}else{
			echo '{"result":0, "message":"Booking not found"}';
		}
		
	}
	
	/*
	*Add Booking function
	*function to add booking
	*/
	function addBooking(){
		if(!isset($_REQUEST['id'])){
			echo '{"result":0, "message":"usercode not given"}';
			exit();
		}
		$userid=$_REQUEST['id'];
		$org_name=$_REQUEST['org_name'];
		$event_name=$_REQUEST['event_name'];
		$event_description=$_REQUEST['event_description'];
		$labname=$_REQUEST['labname'];
		$bookingdate=$_REQUEST['bookingdate'];
		$bookingtime=$_REQUEST['bookingtime'];


		/**creates an object of the class*/
		include_once("booking.php");
		$obj= new booking();
		    
		/**calls the add function and checks */
		if($obj->addBookings($userid, $org_name,$event_name,$event_description,$labname,$bookingdate,$bookingtime))
		{
			echo '{"result":1, "message":"Booking added"}'; //JSON message sent
		}
		else{
		    
			echo  '{"result":0, "message":"Booking was not added. This time slot has already been taken for this lab"}'; //JSON message sent
		}           
	}
	
	/*
	*function to view user booking
	*/
	function myBookings() {
		include_once("booking.php");
		//check if there is a user code
		if (!isset($_REQUEST['id'])) {
			echo '{"result":0,"message":"User code not provided"}';
			return;
		}
		$userID = $_REQUEST["id"];

		//create an object of booking
		$book = new booking();

		// call get user method
		$view = $book->viewMyBooking($userID);


		// checking if bookings have been gotten from database
		if ($view == false) {
			echo '{"result":0,"message":"User code not provided"}';
			return;
		}

		// getting the bookings 
		$db = $book->fetch();

		// checking for bookings and printing them in JSON format
		if ($db == false) {
			echo "Error";
		} else {
			echo '{"result":1,"booking":[';
			while ($db != false) {
				echo json_encode($db);
				$db = $book->fetch();
					if ($db) {
						echo ',';
					}
			}
			echo ']}';
		}
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
	
	/**
	*edit a specified booking record
	*/
	function editBooking(){		
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
		$bookingObj=new booking();
		
		$user_id = $_REQUEST['user_id'];
		$org_name = $_REQUEST['org_name'];
		$event_name = $_REQUEST['event_name'];
		$event_description = $_REQUEST['event_description'];
		$labname = $_REQUEST['labname'];
		$bookingdate = $_REQUEST['bookingdate'];
		$bookingtime = $_REQUEST['bookingtime'];
		
		$update_result = $bookingObj->updateBooking($booking_id, $user_id, $org_name, $event_name, $event_description, $labname, $bookingdate, $bookingtime);
					
		if($update_result){
			echo '{"result":1, "message":"Booking updated"}';
		}else{
			echo  '{"result":0, "message":"Booking was not updated"}';
		}
	}
?>