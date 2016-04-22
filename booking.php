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
		$strQuery="SELECT booking_id, labname, bookingdate, bookingtime, org_name, event_name, event_description FROM sweb_booking";
		
		if($filter){
			$strQuery=$strQuery . " where $filter";
		}
		return $this->query($strQuery);
	}
	
	
	/**
	* gets the bookings made by a particular userID
	*@param int userID user code
	*/
	function viewMyBooking($userID){
		$filter = "user_id = $userID order by booking_id DESC limit 30";
		return $this->getBooking($filter);
	
	}
	}
	
?>