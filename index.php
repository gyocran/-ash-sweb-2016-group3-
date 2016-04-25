<?php
		/**
		*Database connection helper
		*/
		include_once("setting.php");
		
		// error message variable
		$error_msg = "";
		
		// checking if username has been entered and connecting to the database
		if(isset($_REQUEST['username'])){
			$new = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
				
			if($new->connect_errno!=0){
				echo "error authenticating-connection {$db->connect_error}";
				exit();
			}
				
			$username=$_REQUEST['username'];
			$pword=$_REQUEST['pword'];
				
			$str_query="select user_id,username,password,firstname,lastname,usergroup,permission,status from sweb_user
				WHERE username='$username' and password=MD5('$pword')";
			$result=$new->query($str_query);
			if(!$result){
				echo "error authenticating";
				exit();
			}
				
			$row=$result->fetch_assoc();
			if(!$row){	
				//username or password must be wrong
				$error_msg = "username or password is wrong.";
			}
			
			else
			{
				
					session_start();
					$_SESSION['USER']=$row;
					echo $_SESSION['USER']['username'];
					header("location: viewmybookings.php");
					
			}
		}
?>

<html>
	<head>
		<title>Lab Time | Home</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body id="background">

	<div id="maindiv">
		<div id="homediv1">
			<center>
				<img src="css/images/logo.gif" style="width:230px;height:37%";>
				<p><h3>Make bookings for your events at the lab and view all bookings to know when and where events will be happening</h1></p>
			</center>	
		</div>

		<div id="homediv2">
			<form action="" method="POST">
					<center>
					
						<div class="login">
						<span style = "color:red"><?php echo $error_msg?> </span>
		    				<input type="login" class= "logininput"placeholder="Username" id="username" name="username">  
		 					 <input type="password" placeholder="password" id="password" name = "pword">  
		  					<a href="#" class="forgot">forgot password?</a>
		 			 		<input type="submit" id="loginbutton" value="Sign In">
						</div>
						<span style="color: black">or</span>
						<input type="submit" id="loginbutton" value="View All Bookings">
					</center>
			</form>
		</div>

	</div>
