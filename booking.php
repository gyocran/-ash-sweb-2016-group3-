<?php

include_once("adb.php");

/*
class booking
*/

class booking extends adb
{
	function booking()
	{
		
	}
	
	
	/**
	* gets the bookings made by a particular userID
	*@param int userID user code
	*/
	function getMyBooking($userID)
	{	
	
	$strQuery ="select booking_id, labname, bookingdate, bookingtime, org_name, event_name, event_description from sweb_booking where user_id = $userID";
	
	return $this -> query($strQuery);
	}
	
}

	
?>