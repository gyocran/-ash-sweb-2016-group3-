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
        echo '{"result":0,"message":"wrong cmd provided"}';
        break;
}

function displayByDay() {

//include classes
    include_once("booking.php");
    include_once("labs.php");

// create objects from classes class
    $obj = new booking();
    $obj2 = new labs();

// fetch today's date
    $date = date("Y-m-d", strtotime("today"));

    // name of JSON object containing arrays of various elements
    echo "{\"AllBookings\":";

    /*
     * 'result' variable used to tell javascript page to print by day or by week
     * if 'result'==1, print bookings for today
     */
    echo "{\"outcome\":[{\"result\": 1}],";

//array of all the possible booking times
    $times = array("8:00-9:00 am", "9:00-10:00 am", "10:00-11:00 am",
        "11:00-12:00 pm", "12:00-1:00 pm", "1:00-2:00 pm", "2:00-3:00 pm",
        "3:00-4:00 pm", "4:00-5:00 pm", "5:00-6:00 pm");

// loop to create of JSON array of times
    $timesLength = count($times); //get the length of the times array
// this determines whether to place ',' in json object
    $count = 0;
    echo "
	\"times\": [";
    foreach ($times as $value) {
        echo "{
		\"Time\": \"$value\"
                }";
        //if (count!=length of array) print ","
        if ($count < $timesLength - 1) { //
            echo ",";
        }
        $count++;
    }
    echo "],";

//array of all the lab names retrieved from database
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

    /*
     * loop to create of JSON array of times
     * logic is same as creation of times JSON array
     */
    $labsLength = count($labs); //get the length of the labs array
    $count = 0;

    echo "\"labs\": [";
    foreach ($labs as $value) {
        echo "{
		\"LabName\": \"{$value['labname']}\"
                }";
        if ($count < $labsLength - 1) {
            echo ",";
        }
        $count++;
    }
    echo "],";

//array of all the bookings for today retrieved from database
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

    /*
     * Next batch of code creates JSON array of all the bookings
     * Uses the labs, times and allbookings arrays created earlier
     * Logic is to check all bookings array if it contains an array of current labname and current time
     * current labname and current time obtained using two loops 
     */
    $bookingsLength = count($times); //get the length of the allbookings array
    $labsLength = count($labs);

    echo "\"bookings\": ["; // name of object
    $outerCount = 0; // count used to determine whether to print ',' between each element of array
    foreach ($labs as $valOne) {
        $innerCount = 0; //this determines whether to place ',' between elements in each object in array
        echo "{\"LabName\":\"{$valOne['labname']}\",";
        foreach ($times as $valTwo) {
            // if allbookings array contains an array that contains current labname and current time, print 'booked'
            if (in_array(array('labname' => $valOne['labname'],
                        'bookingtime' => $valTwo), $allbookings)) {
                echo "
		\"status{$innerCount}\": \"booked\" 
                "; // print out innercount as well to differentiate elements within the array
            } else {
                echo "
		\"status{$innerCount}\": \"\"
                ";
            }
            if ($innerCount < $bookingsLength - 1) {
                echo ",";
            }
            $innerCount++;
        }
        echo "}";
        if ($outerCount < $labsLength - 1) {
            echo ",";
        }
        $outerCount++;
    }
    echo "]}";
    echo "}";
}

function displayByWeek() {

// include booking class
    include_once("labs.php");
    include_once("booking.php");

// create object from booking class
    $obj = new booking();
    $obj2 = new labs();

// array of dates for the week from database
    $dates = $obj->getDates();

    //name of JSON object
    echo "{\"AllBookings\":";

    /*
     * 'result' variable used to tell javascript page to print by day or by week
     * if 'result'==1, print bookings for today
     */
    echo "{\"outcome\": [{\"result\": 2}],";

    // creation of JSON array of dates
    $datesLength = count($dates); //get the length of the times array
    $count = 0; //this determines whether to place ',' in json object

    echo "
	\"dates\": [";
    foreach ($dates as $value) {
        echo "{
		\"Date\": \"$value\"
                }";
        if ($count < $datesLength - 1) {
            echo ",";
        }
        $count++;
    }
    echo "],";

    /*
     * get first and last days of the week in year-month-day format
     * a week is from one Monday to the next
     */
    $startDate = date("Y-m-d", strtotime($dates[0]));
    $endDate = date("Y-m-d", strtotime($dates[7]));

//array of all the possible booking times
    $times = array("8:00-9:00 am", "9:00-10:00 am", "10:00-11:00 am",
        "11:00-12:00 pm", "12:00-1:00 pm", "1:00-2:00 pm", "2:00-3:00 pm",
        "3:00-4:00 pm", "4:00-5:00 pm", "5:00-6:00 pm");

    // loop to create of JSON array of times
    $timesLength = count($times); //get the length of the times array
    $count = 0; //this determines whether to place ',' in json object

    echo "
	\"times\": [";
    foreach ($times as $value) {
        echo "{
		\"Time\": \"$value\"
                }";
        if ($count < $timesLength - 1) {
            echo ",";
        }
        $count++;
    }
    echo "],";

//get array of all lab names from database
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

    //loop to create of JSON array of times
    $labsLength = count($labs);
    $count = 0;
    //creation of JSON array of times
    echo "\"labs\": [";
    foreach ($labs as $value) {
        echo "{
		\"LabName\": \"{$value['labname']}\"
                }";
        if ($count < $labsLength - 1) {
            echo ",";
        }
        $count++;
    }
    echo "],";

//get all bookings for the week using start and end dates retrieved from database
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

    /*
     * Next batch of code creates JSON array of all the bookings
     * Uses the labs, times and allbookings arrays created earlier
     * Logic is same as retrieving bookings by day
     * except that the date is added to the current items that need to be checked 
     * in the weekbookings array
     */
    $weekBookingsLength = count($times);
    $datesLength = count($dates) * count($labs);
    $outerCount = 0;

    //name of object
    echo "\"bookings\": [";
    //creation of JSON array of bookings
    foreach ($dates as $valOne) {
        foreach ($labs as $valTwo) {

            $innerCount = 0; //this determines whether to place ',' in json object
            echo "{\"Date\":\"$valOne\",";
            echo "\"LabName\":\"{$valTwo['labname']}\",";
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
                if ($innerCount < $weekBookingsLength - 1) {
                    echo ",";
                }
                $innerCount++;
            }
            echo "}";
            if ($outerCount < $datesLength - 1) {
                echo ",";
            }
            $outerCount++;
        }
    }
    echo "]}";
    echo "}";
}
