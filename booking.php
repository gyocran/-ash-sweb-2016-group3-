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
    

    
    /**
     * Gets all the dates within current week
     * Week begins on Monday and ends on the next Monday
     * @return An array of all the dates within the week
     */
    function getDates() {
        $today = date("l"); //today's day of the week
        
        // this if block prevents dates from the previous week being retrieved every monday
        if ($today != "Monday") {
            $startDate = date("F j, Y", strtotime("previous monday"));
        } else {
            $startDate = date("F j, Y", strtotime("monday"));
        }

        $endDate = date("F j, Y", strtotime("+7 day", strtotime($startDate)));
        $dates = array(); //array for the dates of the week
        while (strtotime($startDate) <= strtotime($endDate)) {
            array_push($dates, $startDate);
            $startDate = date("F j, Y", strtotime("+1 day", strtotime($startDate)));
        }
        return $dates;
    }

}
?>