<?php

/**
*/
include_once("adb.php");

/**
* Booking class
*/
class booking extends adb{

	/**
	* constructor
	*/
	function __construct(){
	}
	
	
	/**
	* gets booking records based on the filter
	* @param string mixed condition to filter. If  false, then filter will not be applied
	* @return boolean true if successful, else false
	*/
	function getBooking($filter=false){
		$strQuery="SELECT * FROM sweb_booking";
		
		if($filter){
			$strQuery=$strQuery . " where $filter";
		}
		
		return $this->query($strQuery);
	}
	
	/**
	* delete booking
	* @param int $bookingId the booking id to be deleted
	* returns true if the booking is deleted, else false
	*/
	function deleteBooking($bookingId){
		$strQuery = "DELETE FROM sweb_booking WHERE booking_id = '$bookingId' ";
		
		return $this->query($strQuery);
	}
}
?>