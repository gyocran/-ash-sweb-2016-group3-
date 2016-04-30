<?php

include_once("adb.php");

class booking extends adb {

    // Constructor
    function booking() {
        
    }
    
    /**
     * Gets bookings for a specific date
     * @param A date
     * @return A list of all the labs and times they have been booked
     */
    function viewBookingByDate($date) {
        $strQuery = "SELECT labname,bookingtime FROM `sweb_booking` WHERE bookingdate = \"$date\"";
//         echo $strQuery;
        return $this->query($strQuery);
    }
    
    /**
     * Gets bookings for the week
     * @param Date on which week begins
     * @param Date on which week ends
     * @return A list of all the dates as well as labs and times they have been booked
     */
    function viewBookingByWeek($startDate,$endDate){
        $strQuery = "select bookingdate,labname,bookingtime from `sweb_booking` where bookingdate between \"$startDate\" and \"$endDate\"";
//        echo $strQuery;
        return $this->query($strQuery);
    }
    

//    function getBookedDates() {
//        $strQuery = "SELECT bookingdate FROM `sweb_booking`";
//        return $this->query($strQuery);
//    }
    
    /**
     * Gets all the dates within current week
     * Week begins on Monday and ends on the next Monday
     * @param 
     * @return A list of all the dates within the week
     */
    function getDates(){
        $dates = array();
        $startDate= date("F j, Y", strtotime( "previous monday" ));
        $endDate = date("F j, Y", strtotime("+7 day", strtotime($startDate)));
    
        while (strtotime($startDate) <= strtotime($endDate)) {
            array_push($dates,$startDate);
            $startDate = date("F j, Y", strtotime("+1 day", strtotime($startDate)));   
        }
        return $dates;
}
}
    //unit test for viewBookingByWeek
//include_once("booking.php");
//$obj = new booking();
//$allbookings = array();
//if (!$obj->viewBookingByWeek("2016-04-25", "2016-05-02")) {
//    echo "failed to retrieve bookings for week";
//} else {
//    $row = $obj->fetch();
//    while ($row) {
//        array_push($allbookings, $row);
//        $row = $obj->fetch();
//    }
//}
//print_r($allbookings);

//$arr = $obj->fetch();
//print_r($arr);


//unit test for viewBookingByDay
//include_once("booking.php");
//$obj = new booking();
//$allbookings = array();
//if (!$obj->viewBookingByDate("2016-04-29")) {
//    echo "Retrieval of bookings failed";
//} else {
//    $row = $obj->fetch();
//    while ($row) {
//        array_push($allbookings, $row);
//        $row = $obj->fetch();
//    }
//}
//print_r($allbookings);


//unit test for getDates
//include_once("booking.php");
//    $obj = new booking();
//    $arr = $obj->getDates();
//    print_r($arr);
?>