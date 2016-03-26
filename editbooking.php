<!DOCTYPE html>
<html>
	<head>
		<title>Users List</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
			
		</script>
	</head>
	<body>
		<table>
			<tr>
				<td colspan="2" id="pageheader">
					MY BOOKINGS
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
						<span class="menuitem"><a href= "viewmasterschedule.php">View MasterSchedule</a></span>
						<span class="menuitem" ><a href= "index.php?id=2">My Bookings</a></span>
						<span class="menuitem" ><a href= "userslist.php">Manage Users</a></span>
						<input type="text" id="txtSearch" />
						<span class="menuitem">search</span>		
					</div>
					
					<?php
						$strStatusMessage ="Update Booking";
						$user_id = '';
						$org_name = '';
						$event_name = '';
						$event_description = '';
						$labname = '';
						$bookingdate = ''; 
						$bookingtime = '';
						
						if (isset($_GET['booking_id'])){
							$booking_id = $_GET['booking_id'];
							
							include_once("booking.php");
							$bookingObj=new booking();
							$bookingObj->getBooking("booking_id = '$booking_id' ");
							$row = $bookingObj->fetch();
							
							if(isset($_POST['submit'])){
								$user_id = $_REQUEST['user_id'];
								$org_name = $_REQUEST['org_name'];
								$event_name = $_REQUEST['event_name'];
								$event_description = $_REQUEST['event_description'];
								$labname = $_REQUEST['labname'];
								$bookingdate = $_REQUEST['bookingdate'];
								$bookingtime = $_REQUEST['bookingtime'];
								
								$r=$bookingObj->updateBooking($booking_id, $user_id, $org_name, $event_name, $event_description, $labname, $bookingdate, $bookingtime);
											
								if($r==false){
									$strStatusMessage="$event_name could not be updated";
								}else{
									$strStatusMessage="$event_name successfully updated";
									 echo "<script> location.replace(' index.php?id=$user_id '); </script>";
								}
									
								
							}
							
							$user_id = $row['user_id'];
							$org_name = $row['org_name'];
							$event_name = $row['event_name'];
							$event_description = $row['event_description'];
							$labname = $row['labname'];
							$bookingdate = $row['bookingdate'];
							$bookingtime = $row['bookingtime'];
						}
					?>
					
					<div id="divStatus" class="status">
						<?php echo $strStatusMessage; ?>
					</div>
					<div id="divContent">
						Content space
						<span class="clickspot">click here </span>
	
							<form action="" method="POST">
								<div>User ID: <input type="text" name="user_id" value="<?php echo $user_id ?>"/></div>
								<br>
								<div>Name of Org:  <input type="text" name="org_name" value="<?php echo $org_name ?>"/></div>
								<br>
								<div>Event Name:  <input type="text" name="event_name" value="<?php echo $event_name ?>"/></div>
								<br>
								<div>Event Description:  <input type="text" name="event_description" value="<?php echo $event_description ?>"/></div>
								<br>
								
								<div>Lab Name: <select name="labname" />
									<?php
									
									include_once("labs.php");
									$labs= new labs();
									$result=$labs->getAllLabs();
									
									echo "<option value = 'null'>-- select labname --</option>";
									while($row=$labs->fetch()){
										$selected = ($row["labname"] == $labname)? selected : "";  
										echo "<option value = {$row["labname"]} $selected >{$row["labname"]}</option>";
									}
									
									?>	
									</select>
								</div>
								<br>
								
								<div>Booking Date: <input type="date" name="bookingdate" value="<?php echo $bookingdate ?>"/></div>
								<br>
								<div>Booking Time: <select name = "bookingtime" />
									<?php $selected = ("8:00-9:00 am" == $bookingtime)? selected : "";  echo "<option value = '8:00-9:00 am'  $selected >8:00-9:00 am</option>";?>
									<?php $selected = ("9:00-10:00 am" == $bookingtime)? selected : "";  echo "<option value = '9:00-10:00 am'  $selected >9:00-10:00 am</option>";?>
									<?php $selected = ("10:00-11:00 am" == $bookingtime)? selected : "";  echo "<option value = '10:00-11:00 am'  $selected >10:00-11:00 am</option>";?>
									<?php $selected = ("11:00-12:00 am" == $bookingtime)? selected : "";  echo "<option value = '11:00-12:00 am'  $selected >11:00-12:00 am</option>";?>
									<?php $selected = ("12:00-1:00 pm" == $bookingtime)? selected : "";  echo "<option value = '12:00-1:00 pm'  $selected >12:00-1:00 pm</option>";?>
									<?php $selected = ("1:00-2:00 pm" == $bookingtime)? selected : "";  echo "<option value = '1:00-2:00 pm'  $selected >1:00-2:00 pm</option>";?>
									<?php $selected = ("2:00-3:00 pm" == $bookingtime)? selected : "";  echo "<option value = '2:00-3:00 pm'  $selected >2:00-3:00 pm</option>";?>
									<?php $selected = ("3:00-4:00 pm" == $bookingtime)? selected : "";  echo "<option value = '3:00-4:00 pm'  $selected >3:00-4:00 pm</option>";?>
									<?php $selected = ("4:00-5:00 pm" == $bookingtime)? selected : "";  echo "<option value = '4:00-5:00 pm'  $selected >4:00-5:00 pm</option>";?>
									<?php $selected = ("5:00-6:00 pm" == $bookingtime)? selected : "";  echo "<option value = '5:00-6:00 pm'  $selected >5:00-6:00 pm</option>";?>
									</select>
								</div>
								
								<input type="submit" name="submit" value="Update Booking">
							</form>							
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>	