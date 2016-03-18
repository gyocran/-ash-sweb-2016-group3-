<html>
	<head>
		<title>Add New Booking</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
			<!--add validation js script here
		</script>
	</head>
	<body>
		<table>
			<tr>
				<td colspan="2" id="pageheader">
					Application Header
				</td>
			</tr>
			<tr>
				<td id="mainnav">
					<div class="menuitem">menu 1</div>
					<div class="menuitem">menu 2</div>
					<div class="menuitem">menu 3</div>
					<div class="menuitem">menu 4</div>
				</td>
				<td id="content">
					<div id="divPageMenu">
						<span class="menuitem" >page menu 1</span>
						<span class="menuitem" >page menu 2</span>
						<span class="menuitem" >page menu 3</span>
						<input type="text" id="txtSearch" />
						<span class="menuitem">search</span>		
					</div>


<div id="divStatus" class="status">
	<?php $strStatusMessage='Add new booking'; echo  $strStatusMessage ?>
</div>

<div id="divContent">
	Content space
	<form action="" method="GET">
	<div>User ID:  <input type="text" name="user_id"></div>
	<div>Name/Org:  <input type="text" name="org_name"></div>
	<div>Event Name:<input type="text" name="event_name"></div>
	<div>Event Description:<input type="text" name="event_description"></div>
	<div>Lab Name: <select name="labname">
			<?php
				//a call to the class
				include_once("labs.php");
				$labs= new labs();
				$result=$labs->getAllLabs();
				//echo $strQuery;
				if($result==false){
					//
					echo "result is false";
				}else{
					while($row=$labs->fetch()){
						echo "<option value='{$row['labname']}'>{$row['labname']}</option>";
					}
				}//display in loop
			?>	
 </select>
 </div>
	<div>Date: <input type=date name="bookingdate"/></div>		
	<div>Time : <select name = "bookingtime">
	<div>
	<option value="8:00-9:00 am">8:00-9:00 am</option>
	<option value="9:00-10:00 am">9:00-10:00 am</option>
	<option value="10:00-11:00 am">10:00-11:00 am</option>
	<option value="11:00-12:00 am">11:00-12:00 am</option>
	<option value="12:00-1:00 pm">12:00-1:00 pm</option>
	<option value="1:00-2:00 pm">1:00-2:00 pm</option>
	<option value="2:00-3:00 pm">2:00-3:00 pm</option>
	<option value="3:00-4:00 pm">3:00-4:00 pm</option>
	<option value="4:00-5:00 pm">4:00-5:00 pm</option>
	<option value="5:00-6:00 pm">5:00-6:00 pm</option>
	</select>
	</div>

	<input type="submit" value="Add">
		</form>							


<?php
			//initialize
			$strStatusMessage ="Add new booking";
			$user_id="";
			$org_name="";
			$event_name="";
			$event_description="";
			$labname="";
			$bookingdate='';
			$bookingtime='';	

			if(isset($_REQUEST['user_id'])){
				$userid=$_REQUEST['user_id'];
				$org_name=$_REQUEST['org_name'];
				$event_name=$_REQUEST['event_name'];
				$event_description=$_REQUEST['event_description'];
				$labname=$_REQUEST['labname'];
				$bookingdate=$_REQUEST['bookingdate'];
				$bookingtime=$_REQUEST['bookingtime'];



				include_once("bookings.php");
				$obj=new bookings();

				/*$r=$obj->checkAvailability($labname, $bookingdate, $bookingtime);
				
				if($r==true){
					$strStatusMessage="This timeslot has already been booked.";
					echo $strStatusMessage;
				}

				else{*/

					$s=$obj->addBookings($userid, $org_name,$event_name,$event_description,$labname,$bookingdate,$bookingtime);
					//echo $s;
					if($s==false){
					$strStatusMessage="Error while adding booking.";
					echo $strStatusMessage;
					}else{
						$strStatusMessage="$event_name has been booked on $bookingdate from $bookingtime at $labname";
						echo $strStatusMessage;
						}
				}
			
?>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>	
