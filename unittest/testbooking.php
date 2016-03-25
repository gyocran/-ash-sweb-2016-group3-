<?php
include_once("..\booking.php");

class testbooking extends PHPUnit_Framework_TestCase{

	public function testDeleteBooking(){
		//arrange
		$bookingObj=new booking();
	
		//act
		$this->assertEquals(true, $bookingObj->deleteBooking(4) );
	
		//assert
		$bookingObj->getBooking("booking_id = 4");
		$this->assertEquals(0, $bookingObj->getNumRows());
	}

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