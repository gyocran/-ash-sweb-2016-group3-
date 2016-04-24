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
	*Adds a new booking
	*@param int user_id user id
	*@param string org_name Organization name
	*@param string event_name Event name
	*@param string event_description event description
	*@param string labname lab name
	*@param date bookingdate booking date 
	*@param string bookingtime booking time 
	*/
	function addBookings($user_id, $org_name,$event_name,$event_description,$labname,$bookingdate,$bookingtime){
		$strQuery="insert into sweb_booking set
						user_id='$user_id',
						org_name='$org_name',
						event_name='$event_name',
						event_description = '$event_description',
						labname='$labname',
						bookingdate='$bookingdate',
						bookingtime='$bookingtime'
						";
		return $this->query($strQuery);				
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
	function deleteBooking($bookingId, $userId){
		$strQuery = "DELETE FROM sweb_booking WHERE booking_id = '$bookingId' and user_id = '$userId' ";
	
		return $this->query($strQuery);
	}
	
	/**
	* edit booking
	* @param int bookingId booking id
	* @param string labName lab name
	* @param int userId user id
	* @param string bookingDate booking date
	* @param string startTime start time
	* @param string endTime end time
	* returns true if the booking is updated, else false
	*/
	function updateBooking($bookingId, $userId, $orgName, $eventName, $eventDesc, $labName, $bookingDate, $bookingTime){
		//booking slot is available
		if($this->checkSlotAvailabilty($labName, $bookingDate, $bookingTime) == null){
			$strQuery = "UPDATE sweb_booking SET
						user_id = '$userId',
						org_name = '$orgName',
						event_name = '$eventName',
						event_description = '$eventDesc',
						labname = '$labName',
						bookingdate = '$bookingDate',
						bookingtime = '$bookingTime'
					WHERE booking_id = '$bookingId' and user_id = '$userId' ";
		
			return $this->query($strQuery);
		}
		
		//booking slot is not available
		if($this->checkSlotAvailabilty($labName, $bookingDate, $bookingTime) != null){
			$row = $this->checkSlotAvailabilty($labName, $bookingDate, $bookingTime);
			
			//check whether current row with similar labname,bookingdate and bookingtime is the same row being updated
			if ($bookingId == $row['booking_id']){
				$strQuery = "UPDATE sweb_booking SET
							user_id = '$userId',
							org_name = '$orgName',
							event_name = '$eventName',
							event_description = '$eventDesc',
							labname = '$labName',
							bookingdate = '$bookingDate',
							bookingtime = '$bookingTime'
						WHERE booking_id = '$bookingId' and user_id = '$userId' ";
		
				return $this->query($strQuery);
			}
			
			return false;
		}
		
	}
	
	/**
	* check booking slot availability
	* @param string bookingDate the booking date
	* @param string bookingtime the event start time
	* @param string endTime the event end time
	* returns true if the booking slot is available, else false
	*/
	function checkSlotAvailabilty($labName, $bookingDate, $bookingTime){
		$filter = " (labname = '$labName') and (bookingdate = '$bookingDate') and (bookingtime = '$bookingTime') ";
		$this->getBooking($filter);
		$row = $this->fetch();
		
		//booking slot available
		if ($row == null){
			return $row;
		}
		
		//booking slot not available
		return $row;
	}
	
	/**
	* gets the bookings made by a particular userID
	*@param int userID user code
	*/
	function viewMyBooking($userID){
		$this->getBooking(" user_id = $userID");
		return $this->fetch();
	}

}

?>