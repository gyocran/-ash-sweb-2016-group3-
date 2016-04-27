<?php 
/*
*@author Maame Yaa Afriyie Poku
*/

/*
*Add Booking Ajax
*/


/*
*check command
*/

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

	/*
	*Add Booking function
	*/
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


			/**creates an object of the class*/
			include_once("bookings.php");
			$obj= new bookings();
			
			/**calls the add function and checks */
			if($obj->addBookings($userid, $org_name,$event_name,$event_description,$labname,$bookingdate,$bookingtime))
			{
				echo '{"result":1, "message":"Booking added"}'; //JSON message sent
			}
			else{
			
				echo  '{"result":0, "message":"Booking was not added. This time slot has already been taken for this lab"}'; //JSON message sent
			}			
	}

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

?>
