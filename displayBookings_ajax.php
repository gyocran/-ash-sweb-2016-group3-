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
        echo '{"result":0,"message":"wrong cmd provided"}'; //change to json message
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
    $date = date("Y-m-d",  strtotime("today"));
//    echo "All bookings for $date";

    //creation of JSON object
    echo "{\"AllBookings\":";
    
    // used to tell javascript to print by day or by week
    echo "{\"outcome\":[{\"result\": 1}],";
    
//array of all the possible booking times
    $times = array("8:00-9:00 am", "9:00-10:00 am", "10:00-11:00 am",
        "11:00-12:00 pm", "12:00-1:00 pm", "1:00-2:00 pm", "2:00-3:00 pm",
        "3:00-4:00 pm", "4:00-5:00 pm", "5:00-6:00 pm");
    
//        creation of JSON array of times
$timesLength = count($times); //get the length of the times array
    $count = 0; //this determines whether to place ',' in json object

    echo "
	\"times\": [";
    foreach ($times as $value) {
        echo "{
		\"Time\": \"$value\"
                }";
            if($count<$timesLength-1){
                echo ",";
            }
            $count++;
    }
    echo "],";
    
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
    
    
//    print_r($labs);
    $labsLength = count($labs); //get the length of the labs array
    $count = 0; //this determines whether to place ',' in json object
    //creation of JSON array of times
    echo "\"labs\": [";
    foreach ($labs as $value) {
        echo "{
		\"LabName\": \"{$value['labname']}\"
                }";
            if($count<$labsLength-1){
                echo ",";
            }
            $count++;
    }
    echo "],";
 
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
    
//    print_r($allbookings);
//    $bookingsLength = count($allbookings); //get the length of the allbookings array
//    $count = 0; //this determines whether to place ',' in json object
//    //creation of JSON array of times
//    echo "\"bookings\": [";
//    foreach ($allbookings as $value) {
//        echo "{
//		\"labName\": \"{$value['labname']}\"
//                ,";
//        echo "\"bookingTime\": \"{$value['bookingtime']}\"
//                }";
//            if($count<$bookingsLength-1){
//                echo ",";
//            }
//            $count++;
//    }
//    echo "]}";
//    
    
//table head
//    echo "<table cellspacing= 1 border=1 cellpadding=3>
//			<tr>
//                        <th></th>
//			<th colspan=10>Time</th>
//			</tr>";
//    echo "<tr>
//			<th>LABS</th>";
//    foreach ($times as $value) {
//        echo "<td>$value</td>";
//    }
//    echo "</tr>";
//    echo "[";
//    
//    
//display contents of bookings in the t/able
    
    $bookingsLength = count($times); //get the length of the allbookings array
    $labsLength = count($labs);
    //creation of JSON array of bookings
    echo "\"bookings\": [";
    $outerCount = 0;
    foreach ($labs as $valOne) {
        $innerCount = 0; //this determines whether to place ',' in json object
       
//        echo "{
//        echo "<tr><td>{$valOne['labname']}</td>";
        echo "{\"LabName\":\"{$valOne['labname']}\",";
        foreach ($times as $valTwo) {
//            echo "{";
            if (in_array(array('labname' => $valOne['labname'],
                        'bookingtime' => $valTwo), $allbookings)) {
                echo "
		\"status{$innerCount}\": \"booked\"
                ";
            } else {
               echo "
		\"status{$innerCount}\": \"\"
                ";
            }
//            echo "}";
            if($innerCount<$bookingsLength-1){
                echo ",";
            }
            $innerCount++;
        }
        echo "}";
        if($outerCount<$labsLength-1){
                echo ",";
            }
            $outerCount++;
//        echo "]";
    }
    echo "]}";
    echo "}";
}

function displayByWeek() {
//echo "{\"result\":0,\"message\":\"user code is not correct\"}";

//include booking class
    include_once("labs.php");
    include_once("booking.php");

// create object from booking class
    $obj = new booking();
    $obj2 = new labs();

//array of dates for the week
    $dates = $obj->getDates();
    
    //creation of JSON object
    echo "{\"AllBookings\":";
    
     //        creation of JSON array of dates
    $datesLength = count($dates); //get the length of the times array
    $count = 0; //this determines whether to place ',' in json object

    echo "{\"outcome\": [{\"result\": 2}],";
    echo "
	\"dates\": [";
    foreach ($dates as $value) {
        echo "{
		\"Date\": \"$value\"
                }";
            if($count<$datesLength-1){
                echo ",";
            }
            $count++;
    }
    echo "],";
    /*
     * get first and last days of the week in year-month-day format
     * One week is from one Monday to the next
     */
    $startDate = date("Y-m-d", strtotime($dates[0]));
    $endDate = date("Y-m-d", strtotime($dates[7]));
//
//array of booking times
    $times = array("8:00-9:00 am", "9:00-10:00 am", "10:00-11:00 am",
        "11:00-12:00 pm", "12:00-1:00 pm", "1:00-2:00 pm", "2:00-3:00 pm",
        "3:00-4:00 pm", "4:00-5:00 pm", "5:00-6:00 pm");

    //        creation of JSON array of times
$timesLength = count($times); //get the length of the times array
    $count = 0; //this determines whether to place ',' in json object

    echo "
	\"times\": [";
    foreach ($times as $value) {
        echo "{
		\"Time\": \"$value\"
                }";
            if($count<$timesLength-1){
                echo ",";
            }
            $count++;
    }
    echo "],";
    
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
    
    $labsLength = count($labs); //get the length of the labs array
    $count = 0; //this determines whether to place ',' in json object
    //creation of JSON array of times
    echo "\"labs\": [";
    foreach ($labs as $value) {
        echo "{
		\"LabName\": \"{$value['labname']}\"
                }";
            if($count<$labsLength-1){
                echo ",";
            }
            $count++;
    }
    echo "],";

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
//
////Table heading
////echo "<table cellspacing=1 border=1 cellpadding=3>   
////           <tr>
////           <th colspan=2></th>
////           <th colspan=10>Time</th>            
////            </tr>";
////echo "<tr>
//////            <th>Date</th>
//////            <th>LAB</th>";
////foreach ($times as $value) {
////    echo "<td>$value</td>";
////}
////echo "</tr>";
////echo "</table>";
////print_r($weekBookings);
////$t = date("Y-m-d", strtotime($dates[0]));
////echo "j $t";
//
    $weekBookingsLength = count($times);
    $datesLength = count($dates) * count($labs);
//echo $weekBookingsLength . " ";
//    echo $datesLength;
    $outerCount = 0;
    echo "\"bookings\": [";
    //creation of JSON array of bookings
    foreach ($dates as $valOne) {
//        echo "<table cellspacing=1 border=1 cellpadding=3>   
//           <tr>
//           <th colspan=2></th>
//           <th colspan=10>Time</th>            
//            </tr>";
//        echo "<tr>
//            <th>Date</th>
//            <th>LAB</th>";
        //print out time values from array
//        foreach ($times as $value) {
//            echo "<td>$value</td>";
//        }
//        echo "</tr>";
        
        foreach ($labs as $valTwo) {
            
            $innerCount = 0; //this determines whether to place ',' in json object
             echo "{\"Date\":\"$valOne\",";
//            echo "<tr><td rowspan=0>$valOne</td>"; //print out the date
              echo "\"LabName\":\"{$valTwo['labname']}\",";
//            echo "<td>{$valTwo['labname']}</td>"; //print out the lab name
            foreach ($times as $valThree) {
                if (in_array(array('bookingdate' =>
                            date("Y-m-d", strtotime($valOne)),
                            'labname' => $valTwo['labname'],
                            'bookingtime' => $valThree), $weekBookings)) {
                    echo "
		\"status{$innerCount}\": \"booked\"
                ";
            } else {
               echo "
		\"status{$innerCount}\": \"\"
                ";
            }
//            echo "}";
            if($innerCount<$weekBookingsLength-1){
                echo ",";
            }
            $innerCount++;
        }
        echo "}";
        if($outerCount<$datesLength-1){
                echo ",";
            }
            $outerCount++;
//            echo $outerCount;
//        echo "]";
    }
//    echo "},";
    }
    echo "]}";
        echo "}";
}
