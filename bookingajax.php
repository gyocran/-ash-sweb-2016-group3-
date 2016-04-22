<?php
//check command
	if(!isset($_REQUEST['cmd'])){
		echo "Command is not provided";
		exit();
	}
	/*get command*/
	$command=$_REQUEST['cmd'];
	
	switch($command)
	{
		case 2:
		myBookings();
		break;
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