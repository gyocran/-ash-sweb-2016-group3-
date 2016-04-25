<?php
include_once("..\booking.php");

class testbooking extends PHPUnit_Framework_TestCase{

	public function testViewBooking(){
            
           
            
		$bookingObj=new booking();
	
		//act
		$this->assertEquals(true, $bookingObj->viewMyBooking(3) );
                $row=$bookingObj->fetch();
		//assert
		$this->assertGreaterThan(0, count($row));
	}

	
	
}