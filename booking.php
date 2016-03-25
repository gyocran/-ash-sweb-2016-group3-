<?php

include_once("adb.php");
class booking extends adb
{
	function booking(){
	}
	
	function getUserID()
	{
	$strQuery = "select sweb_booking.user_id from sweb_booking left join sweb_user on sweb_booking.user_id = sweb_user.user_id"; 
	
	return $this -> query($strQuery);
	}
	
	function getBookingID()
	{
		$userID = $this -> getUserID();
		$strQuery = "select booking_id from sweb_booking where user_id = $userID";
		
		return $this -> query($strQuery);
	}
	
	
	function getLabName()
	{
		$userID = $this -> getUserID();
		$strQuery = "select labname from sweb_booking where user_id = $userID";
		
		return $this -> query($strQuery);
	}
	
	function getBookingDate()
	{
		$userID = $this -> getUserID();
		$strQuery = "select bookingdate from sweb_booking where user_id = $userID";
		
		return $this -> query($strQuery);
	}
	
	function getStartTime()
	{
		$userID = $this -> getUserID();
		$strQuery = "select start_time from sweb_booking where user_id = $userID";
		
		return $this -> query($strQuery);
	}
	
	function getEndTime()
	{
		$userID = $this -> getUserID();
		$strQuery = "select end_time from sweb_booking where user_id = $userID";
		
		return $this -> query($strQuery);
	}
	
	function getBookingStatus()
	{
		$userID = $this -> getUserID();
		$strQuery = "select bookingstatus from sweb_booking where user_id = $userID";
		
		return $this -> query($strQuery);
	}
	
	
	function viewBooking()
	{
	$userID = $this -> getUserID();
	$strQuery ="select booking_id, labname, bookingdate, start_time, end_time, bookingstatus from sweb_booking where user_id = $userID";
	
	return $this -> query($strQuery);
	}
	
	function viewBookingByDate($date)
	{
		$strQuery ="select * from sweb_booking where bookingdate = \"$date\"";
		// echo $strQuery;
		return $this -> query($strQuery);
	}
	
	function getBookedDates(){
		$strQuery = "SELECT bookingdate FROM `sweb_booking`";
		return $this->query($strQuery);
	}
}

?>