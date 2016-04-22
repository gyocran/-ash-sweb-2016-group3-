<?php
/**
*Maame Yaa Afriyie Poku
*/
include_once("adb.php");
/**
*Bookings  class
*/
class bookings extends adb{
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

	/*function checkAvailability($labname, $bookingdate, $bookingtime){
		$strQuery="select * from sweb_booking where labname='$labname', bookingdate='$bookingdate' AND bookingtime='$bookingtime' ";
		return $this->query($strQuery);
	}*/
}

/*$obj=new bookings();
$test=$obj->addBookings('2','Test club','test event','test description','Dlab','2016-05-08','4:00-5:00 pm');

if($test == false)
{
	echo "error";
	exit();
}

$s = $test->fetch_assoc();
print_r($s);*/
?>