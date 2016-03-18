<?php

include_once("adb.php");
class booking extends adb
{
	function booking()
	{
		
	}
	
	
	function getMyBooking($userID)
	{	
	
	$strQuery ="select booking_id, labname, bookingdate, start_time, end_time, bookingstatus from sweb_booking where user_id = $userID";
	
	return $this -> query($strQuery);
	}
	
	function viewMyBooking($userID)
	{
		$book = $this -> getMyBooking($userID);
		
		if ($book==false){
			echo"Error";
			exit();
		}
		
		else 
		{
			$row = $this -> fetch();
		}
		
		return $row;
	}
	
}

/**	$obj = new booking ();
	
	$x = $obj -> getMyBooking(3);
	
	if ($x==false){
		echo"Error";
		exit();
	}
	
	else
	{
		echo "Successful";
		
		$y = $obj -> viewMyBooking(3);
		print_r($y);
		
	}*/

?>