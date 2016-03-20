<?php
include_once("..\booking.php");

class testbooking extends PHPUnit_Framework_TestCase{

	public function testUpdateBooking(){
		//arrange
		$bookingObj=new booking();
		$eventName = random_bytes(10);
	
		//act and assert
		$this->assertEquals(true, 
			$bookingObj->updateBooking(
			4,			        //booking id
			2, 			        // user id
			"arts factory",	              //organization name
			$eventName,		         //event name
			"come let us teach you some salsa moves!",           //event description
			"lab221",				//labname
			"2016-04-02",			//booking date
			"9:00-10:00 am"				//bookingime 
			)
		);
		
		//assert
		$bookingObj->getBooking("event_name = '$eventName' ");
		$this->assertEquals(1, $bookingObj->getNumRows());
	
	}
	
}