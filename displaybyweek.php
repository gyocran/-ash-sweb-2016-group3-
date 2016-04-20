<?php
//include booking class
	include_once("booking.php");
	include_once("labs.php");

	// create object from booking class
	$obj = new booking();
	$obj2 = new labs();
        
//today's date
$date = date("Y-m-d");
$result = getDates();
print_r($result);

function getDates(){
    $dates = array();
    $startDate= date("F j, Y", strtotime( "monday" ));
    $endDate = date ("F j, Y", strtotime("+7 day", strtotime($startDate)));
    
    while (strtotime($startDate) <= strtotime($endDate)) {
        array_push($dates,$startDate);
        $startDate = date("F j, Y", strtotime("+1 day", strtotime($startDate)));   
    }
    return $dates;
}

$times = array("8:00-9:00 am","9:00-10:00 am","10:00-11:00 am","11:00-12:00 pm","12:00-1:00 pm","1:00-2:00 pm","2:00-3:00 pm","3:00-4:00 pm","4:00-5:00 pm","5:00-6:00 pm");
$rowcolor1 = "style='background-color:darkblue;color:white'";
	$rowcolor2 = "style='background-color:blue;color:white'";
	
             echo "<table cellspacing= 1 border=1 cellpadding=3>
                             
                        <tr>
                        <th></th>
			<th colspan = 11 $rowcolor1>Time</th>
                        
			</tr>";
                        echo "<tr>
                        <th $rowcolor1>Date</th>
			<th $rowcolor1>LABS</th>";
			foreach($times as $value){
				echo "<td $rowcolor1>$value</td>";
			}
	echo "</tr>";

if(!$obj2->getLabNames()){
            echo "Retrieval of lab names failed";
	}
        $labs=$obj2->fetch();
        
        foreach($result as $week){
            if(!$obj->viewBookingByDate($week)){
                echo "Retrieving bookings Failed";
              }
            else{
                $allbookings = array();
                $row=$obj->fetch();
            
//                print_r($bookingtimes);
                while($row){
                    array_push($allbookings, $row);
                    $row=$obj->fetch();
                }
                print_r($allbookings);
//               echo "<tr><td>$temp</td>";
//                foreach($bookingtimes as $it){
//		while($row){
                while ($labs){
                echo "<tr><td></td>";
                echo "<td>{$labs['labname']}</td>";
                       foreach($times as $value){
                            if (in_array(array('labname'=>$labs['labname'],'bookingtime'=>$value), $allbookings)){
//                                    if($it['bookingtime']==$value){
					echo "<td>Booked</td>";
                                    }
                                    else{
					echo "<td></td>";
                                    }
                        }
                                   $labs=$obj2->fetch();
            }
            }
        }
		echo "</table>";
	
        
//    $lastMonday = $date("F j, Y", strtotime( "previous monday" ));
//    while ($date<$k){
//        echo $date;
//    }
    
//    strtotime( "tomorrow" ) > strtotime( "today" ))
//        echo "true";
//    else
//        echo "false";

//$day = " +1 day";

//echo $m . "\r\n";
//$i = date("F j, Y", strtotime("+1 day"));
//echo $i . "\r\n";
//$t = date("F j, Y", strtotime("now"));
//echo $t . "\r\n";
//
//echo $f;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
