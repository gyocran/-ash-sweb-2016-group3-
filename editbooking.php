<html>
	<head>
		<title>Lab Time | Edit Booking</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header  id="pageheader"> 
			<center><img src="images/pic.png" style="width:200px;height:90%";></center>
		</header> 
		<center><div><p1>This is the write up</p1></div></center>
		
		<table align="center">
		<!--This creates the menu bar-->
			<tr>
				<td class="item"><a class="a" href= "index.php?id=2"/>My Bookings</td>
				<td class="item"><a class="a" href= "viewmasterschedule.php"/>Master Schedule</td>
				<td class="item"><a class="a" href= "userslist.php"/>Manage Users</td>
				<td class="item" style="font-size:medium"><a class="a" href= "#"/>Logout</td>
			</tr>
		</table>
					<?php
					
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
					
			
					<div id="divContent">
							<table id="tableformat" align="center">
							<form action="" method="POST">
							
							
								<tr>
					<td color="white"><label align="center">User ID</label></td>
					<td><input type="text" name="user_id" value="<?php echo $user_id ?>"></td>
				</tr>
				<tr>
					<td><label>Name/Org:</label></td>
					<td><input type="text" name="org_name" value="<?php echo $org_name ?>"></td>
				</tr>
				<tr>
					<td><label>Event Name:</label></td>
					<td><input type="text" name="event_name" value="<?php echo $event_name ?>"></td>
				</tr>
				<tr>
					<td><label>Event Description:</label></td>
					<td><input type="text" name="event_description"value="<?php echo $event_description ?>"></td>
				</tr>
				<tr>
					<td><label>Lab Name:</label></td>
					<td><select name="labname" />
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
					</td>
				</tr>
				<tr>
					<td><label>Date:</label></td>
					<td><input type=date name="bookingdate" value="<?php echo $bookingdate ?>"/></td>
				</tr>
				<tr>
					<td><label>Time:</label></td>
					<td><select name = "bookingtime">
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
					</td>
				</tr>
				<tr><td></td>
					<td>
						<input type="submit" name="submit" value="Update Booking">
						<input type="submit" value="Cancel">
					</td>
				</tr>
			</form>
			</table>
				</td>
			</tr>
		</table>
	</body>
</html>	