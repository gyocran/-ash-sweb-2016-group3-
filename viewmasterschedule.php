<?php

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
<<<<<<< HEAD
echo "<tr>
			<th>LABS</th>";
foreach ($times as $value) {
    echo "<td>$value</td>";
}
echo "</tr>";
=======
	echo "<tr>
			<td $rowcolor1>LABS</td>";
			foreach($times as $value){
				echo "<td $rowcolor1>$value</td>";
			}
	echo "</tr>";

		while($row){
			echo "<tr>
				<td>{$row['labname']}</td>";
				foreach($times as $value){
					if($row['bookingtime']==$value){
						echo "<td>Booked</td>";
					}
					else{
						echo "<td></td>";
					}
				}
			$row=$obj->fetch();
		}
		echo "</table>";
	}
<<<<<<< HEAD
	
=======
	// $dates = new booking();
	// $objgetBookedDates();
	// if(!$obj->getUserID()){
		// echo "false";
	// }
	// $row = $obj->fetch();
	// echo "<option value='{$row['']}'>help</option>";
	// echo "<option value='2'>helpme</option>";
	// if($dates==false){
		// echo "result is false";
	// }else{
		// $row = $dates->fetch();
		// print_r($row);
		// while($row){
			// echo "<option value='1'>help</option>";
			// echo "<option value='{$row['bookingdate']}'>{$row['bookingdate']}</option>";
			// $row=$obj->fetch();
		// }
	// }
					// </select>
>>>>>>> viewmaster
?>
>>>>>>> version2

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

<<<<<<< HEAD
echo "</table>";
=======
<?php
<<<<<<< HEAD
	
=======
	// $color = 1;
	
	// if(isset($_REQUEST['date'])){
		// $temp = $_REQUEST['date'];
		// $date = "\"$temp\"";
	
	// $t = $obj->viewBookingByDate($date);
	
		// if(!$t)
			// echo "Unable to retrieve bookings";
	
	// $row = $obj->fetch();
	
	// print_r($e);
	
	// echo "<table cellspacing= 1 border=1 cellpadding=3>
			// <tr style='background-color:#C47451;text-align:left'>
			// <td>Lab Name</td>
			// <td>Starting Time</td>
			// <td>Ending Time</td>
			// </tr>";
	
		// if($color==1){
			// echo	
				// "<tr style='background-color:#FFF380;text-align:left'>
				// <td>{$row['labname']}</td>
				// <td><strong>{$row['start_time']}</strong></td>
				// <td><strong>{$row['end_time']}</strong></td>
				// </tr>";
			// $color=2;
		// }
	
		// else{
			// echo 
				// "<tr style='background-color:#FFA62F;text-align:left'>
				// <td>{$row['labname']}</td>
				// <td><strong>{$row['start_time']}</strong></td>
				// <td><strong>{$row['end_time']}</strong></td>
				// </tr>";
			// $color=1;
		// }
	// echo "</table>";
	// }
	// else{
		// echo "Please enter a date";
	// }
>>>>>>> viewmaster
>>>>>>> version2
?>