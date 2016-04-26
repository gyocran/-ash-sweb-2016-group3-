<?php

/**
 */
include_once("adb.php");

/**
 * Booking class
 */
class booking extends adb {

   function bookings(){
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
    function getBooking($filter = false) {
        $strQuery = "SELECT booking_id, labname, bookingdate, bookingtime, org_name, event_name, event_description FROM sweb_booking";

        if ($filter) {
            $strQuery = $strQuery . " where $filter";
        }
        return $this->query($strQuery);
    }

    /**
     * gets the bookings made by a particular userID
     * @param int userID user code
     */
    function viewMyBooking($userID) {
        $filter = "user_id = $userID order by booking_id DESC limit 30";
        return $this->getBooking($filter);
    }

}

$obj = new booking();
?>