<?php
//check command
	if(!isset($_REQUEST['cmd'])){
		echo "Command is not provided";
		exit();
	}
	/*get command*/
	$cmd=$_REQUEST['cmd'];
	
	switch($cmd)
	{
		case 1:
			addBooking();		//if cmd=1 the addbooking function
			break;
		case 2:
			myBookings();
			break;
	}

	// function to add booking
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


			//creates an object of the class
			include_once("bookings.php");
			$obj= new bookings();
			
			//calls the add function and checks 
			if($obj->addBookings($userid, $org_name,$event_name,$event_description,$labname,$bookingdate,$bookingtime))
			{
				echo '{"result":1, "message":"Booking added"}';
			}
			else{
			
				echo  '{"result":0, "message":"Booking was not added"}';
			}			
	}

?>
