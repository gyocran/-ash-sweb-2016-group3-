<?php

include_once("adb.php");

class booking extends adb {

    function booking() {
        
    }

    function getUserID() {
        $strQuery = "select sweb_booking.user_id from sweb_booking left join sweb_user on sweb_booking.user_id = sweb_user.user_id";

        return $this->query($strQuery);
    }

    function getBookingID() {
        $userID = $this->getUserID();
        $strQuery = "select booking_id from sweb_booking where user_id = $userID";

        return $this->query($strQuery);
    }

    function getLabName() {
        $userID = $this->getUserID();
        $strQuery = "select labname from sweb_booking where user_id = $userID";

        return $this->query($strQuery);
    }

    function getBookingDate() {
        $userID = $this->getUserID();
        $strQuery = "select bookingdate from sweb_booking where user_id = $userID";

        return $this->query($strQuery);
    }

    function getStartTime() {
        $userID = $this->getUserID();
        $strQuery = "select start_time from sweb_booking where user_id = $userID";

        return $this->query($strQuery);
    }

    function getEndTime() {
        $userID = $this->getUserID();
        $strQuery = "select end_time from sweb_booking where user_id = $userID";

        return $this->query($strQuery);
    }

    function getBookingStatus() {
        $userID = $this->getUserID();
        $strQuery = "select bookingstatus from sweb_booking where user_id = $userID";

        return $this->query($strQuery);
    }

    function viewBooking() {
        $userID = $this->getUserID();
        $strQuery = "select booking_id, labname, bookingdate, start_time, end_time, bookingstatus from sweb_booking where user_id = $userID";

        return $this->query($strQuery);
    }
//
//    function viewBookingByDateAndLab($date,$lab) {
//        $strQuery = "SELECT labname,bookingtime "
//                . "FROM `sweb_booking` "
//                . "WHERE labname = $lab "
//                . "AND bookingdate = \"$date\"";
////         echo $strQuery;
//        return $this->query($strQuery);
//    }
    
    
    function viewBookingByDate($date) {
        $strQuery = "SELECT labname,bookingtime FROM `sweb_booking` WHERE bookingdate = \"$date\"";
//         echo $strQuery;
        return $this->query($strQuery);
    }
    
    function viewBookingByWeek($startDate,$endDate){
        $strQuery = "select bookingdate,labname,bookingtime from `sweb_booking` where bookingdate between \"$startDate\" and \"$endDate\"";
//        echo $strQuery;
        return $this->query($strQuery);
    }
    

    function getBookedDates() {
        $strQuery = "SELECT bookingdate FROM `sweb_booking`";
        return $this->query($strQuery);
    }
    
    //function to get dates of current week
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

    //unit test for viewBookingByWeek
//include_once("booking.php");
//$obj = new booking();
//if(!$obj->viewBookingByWeek("2016-03-22", "2016-04-12")){
//echo "failed to retrieve bookings for week";
//}
//
//$arr = $obj->fetch();
//print_r($arr);
}

//unit test for getDates
//include_once("booking.php");
//    $obj = new booking();
//    $arr = $obj->getDates();
//    print_r($arr);
?>