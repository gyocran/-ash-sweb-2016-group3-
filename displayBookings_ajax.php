<?php

//check command
if (!isset($_REQUEST['cmd'])) {
    echo "cmd is not provided";
    exit();
}
/* get command */
$cmd = $_REQUEST['cmd'];
switch ($cmd) {
    case 1:
        displayByDay();  //if cmd=1 display by day
        break;
    case 2:
        displayByWeek(); //if cmd=2 display by week
        break;
    default:
        echo "wrong cmd"; //change to json message
        break;
}

function displayByDay() {

//include booking class
    include_once("booking.php");
    include_once("labs.php");

// create object from booking class
    $obj = new booking();
    $obj2 = new labs();

// today's date
    $date = date("Y-m-d");
    echo "All bookings for $date";

//array of all the possible booking times
    $times = array("8:00-9:00 am", "9:00-10:00 am", "10:00-11:00 am",
        "11:00-12:00 pm", "12:00-1:00 pm", "1:00-2:00 pm", "2:00-3:00 pm",
        "3:00-4:00 pm", "4:00-5:00 pm", "5:00-6:00 pm");

//array of all the lab names
    $labs = array();
    if (!$obj2->getLabNames()) {
        echo "Retrieval of lab names failed";
    } else {
        $temp = $obj2->fetch();
        while ($temp) {
            array_push($labs, $temp);
            $temp = $obj2->fetch();
        }
    }

//array of all the bookings for today
    $allbookings = array();
    if (!$obj->viewBookingByDate($date)) {
        echo "Retrieval of bookings failed";
    } else {
        $row = $obj->fetch();
        while ($row) {
            array_push($allbookings, $row);
            $row = $obj->fetch();
        }
    }
//table head
    echo "<table cellspacing= 1 border=1 cellpadding=3>
			<tr>
                        <th></th>
			<th colspan=10>Time</th>
			</tr>";
    echo "<tr>
			<th>LABS</th>";
    foreach ($times as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";

//display contents of bookings in the table
    foreach ($labs as $valOne) {
        echo "<tr><td>{$valOne['labname']}</td>";
        foreach ($times as $valTwo) {
            if (in_array(array('labname' => $valOne['labname'],
                        'bookingtime' => $valTwo), $allbookings)) {
                echo "<td>Booked</td>";
            } else {
                echo "<td></td>";
            }
        }
    }

    echo "</table>";
}

function displayByWeek() {

//include booking class
    include_once("labs.php");
    include_once("booking.php");

// create object from booking class
    $obj = new booking();
    $obj2 = new labs();

//array of dates for the week
    $dates = $obj->getDates();

    /*
     * get first and last days of the week in year-month-day format
     * One week is from one Monday to the next
     */
    $startDate = date("Y-m-d", strtotime($dates[0]));
    $endDate = date("Y-m-d", strtotime($dates[7]));

//array of booking times
    $times = array("8:00-9:00 am", "9:00-10:00 am", "10:00-11:00 am",
        "11:00-12:00 pm", "12:00-1:00 pm", "1:00-2:00 pm", "2:00-3:00 pm",
        "3:00-4:00 pm", "4:00-5:00 pm", "5:00-6:00 pm");

//get array of all lab names
    $labs = array();
    if (!$obj2->getLabNames()) {
        echo "Retrieval of lab names failed";
    } else {
        $temp = $obj2->fetch();
        while ($temp) {
            array_push($labs, $temp);
            $temp = $obj2->fetch();
        }
    }

//get all bookings for the week using start and end dates
    $weekBookings = array();
    if (!$obj->viewBookingByWeek($startDate, $endDate)) {
        echo "Retrieval of this week's bookings failed";
    } else {
        $temp = $obj->fetch();
        while ($temp) {
            array_push($weekBookings, $temp);
            $temp = $obj->fetch();
        }
    }

//Table heading
//echo "<table cellspacing=1 border=1 cellpadding=3>   
//           <tr>
//           <th colspan=2></th>
//           <th colspan=10>Time</th>            
//            </tr>";
//echo "<tr>
////            <th>Date</th>
////            <th>LAB</th>";
//foreach ($times as $value) {
//    echo "<td>$value</td>";
//}
//echo "</tr>";
//echo "</table>";
//print_r($weekBookings);
//$t = date("Y-m-d", strtotime($dates[0]));
//echo "j $t";

    foreach ($dates as $valOne) {
        echo "<table cellspacing=1 border=1 cellpadding=3>   
           <tr>
           <th colspan=2></th>
           <th colspan=10>Time</th>            
            </tr>";
        echo "<tr>
            <th>Date</th>
            <th>LAB</th>";
        //print out time values from array
        foreach ($times as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
        foreach ($labs as $valTwo) {
            echo "<tr><td rowspan=0>$valOne</td>"; //print out the date
            echo "<td>{$valTwo['labname']}</td>"; //print out the lab name
            foreach ($times as $valThree) {
                if (in_array(array('bookingdate' =>
                            date("Y-m-d", strtotime($valOne)),
                            'labname' => $valTwo['labname'],
                            'bookingtime' => $valThree), $weekBookings)) {
                    echo "<td>Booked</td>";
                } else {
                    echo "<td></td>";
//                echo "</table>";
                }
//            echo "</table>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}
