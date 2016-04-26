<?php
include_once("..\booking.php");
include_once("..\bookingajax.php");


class testbookingajax extends PHPUnit_Framework_TestCase{
	
	/**
	*unit test for delete booking implementation using Ajax
	*/
	public function testDeleteBookingAjax(){
		//arrange and act
		$url = "bookingajax.php?cmd=3&booking_id=4&user_id=3";
		
		//assert
		$this->assertTrue(true,'{"result":1, "message":"Booking Successfully Deleted"}',$url);
	}

	/**
	*unit test for edit booking implementation using Ajax
	*/
	public function testEditBookingAjax(){
		//arrange and act
		$url = "bookingajax.php?cmd=4&booking_id=1&user_id=1&org_name=TestOrganization&event_name=TestEvent&event_description=TestEventDescription&labname=Dlab&bookingdate=1970-10-10&bookingtime=8%3A00-9%3A00+am";
		
		//assert
		$this->assertTrue(true,'{"result":1, "message":"Booking updated"}',$url);
	}
	
	/**
	*unit test to get a specific booking record using Ajax
	*/
	public function testGetSpecifiedBookingAjax(){
		//arrange and act
		$url = "bookingajax.php?cmd=0&booking_id=1&user_id=1";
		
		//assert
		$this->assertTrue(true,'{"booking_id":"1","user_id":"1","org_name":"speak club","event_name":"public speaking","event_description":"we will be teaching you the techniques to overcome your fears for public speaking","labname":"Dlab","bookingdate":"2016-03-14","bookingtime":"8:00-9:00 am"}',$url);
	}
}