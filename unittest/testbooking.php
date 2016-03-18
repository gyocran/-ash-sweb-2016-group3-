<?php
include_once("..\booking.php");

class testbooking extends PHPUnit_Framework_TestCase{

	public function testDeleteBooking(){
		//arrange
		$bookingObj=new booking();
	
		//act
		$this->assertEquals(true, $bookingObj->deleteBooking(4) );
	
		//assert
		$bookingObj->getBooking("booking_id = '4' ");
		$this->assertEquals(null, $bookingObj->fetch());
	}
	
}