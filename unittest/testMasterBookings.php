<?php

include_once("booking.php");

class testMasterBookings extends PHPUnit_Framework_TestCase {

    public function testViewBookingByDate() {

        //Arrange
        $obj = new booking();
        $functionBookings = array();

        //Act
        $obj->viewBookingByDate("2016-04-28");
        $row = $obj->fetch();

        //store all bookings in an array
        while ($row) {
            array_push($functionBookings, $row);
            $row = $obj->fetch();
        }
        
        //create an array of the bookings for the day from database and compare it to what is retrieved from the function
        $databaseBookings = array(
            array("labname" => "lab221", "bookingtime" => "12:00-1:00 pm"),
            array("labname" => "lab221", "bookingtime" => "11:00-12:00 pm"));

        //Assert
        $this->assertSame($functionBookings, $databaseBookings);
    }

    public function testGetDates() {
        //Arrange
        $obj = new booking();

        //Act
        $result = $obj->getDates();
        $today = date("F j, Y", strtotime("today"));
        
        //Assert
        $this->assertContains($today, $result);
    }

    public function testViewBookingByWeek() {
        //Arrange
        $obj = new booking();
        $functionBookings = array();

        //Act
        $obj->viewBookingByWeek("2016-04-18", "2016-04-25");
        $row = $obj->fetch();

        //store all bookings in an array
        while ($row) {
            array_push($functionBookings, $row);
            $row = $obj->fetch();
        }
        
        //create an array of the bookings for the day from database and compare it to what is retrieved from the function
        $databaseBookings = array(
            array("bookingdate" => "2016-04-19", "labname" => "englab", "bookingtime" => "9:00-10:00 am"),
            array("bookingdate" => "2016-04-20", "labname" => "englab", "bookingtime" => "8:00-9:00 am"),
            array("bookingdate" => "2016-04-21", "labname" => "Dlab", "bookingtime" => "2:00-3:00 pm"),
            array("bookingdate" => "2016-04-22", "labname" => "lab221", "bookingtime" => "10:00-11:00 am"));

        //Assert
        $this->assertSame($databaseBookings, $functionBookings);
    }

}
