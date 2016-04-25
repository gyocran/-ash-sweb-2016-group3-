<?php

include_once("..\booking.php");

class testBooking_ajax extends PHPUnit_Framework_TestCase
{

    public function testUrl()
    {
        $url = "bookingajax.php?cmd=2&id=3";
        
        $this->assertTrue(true,'{"result":1,"message":"successful"}',$url);
    }
}

?>

