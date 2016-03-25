<?php
	include_once("booking.php");
	
	$obj = new booking();
	$obj->getBookedDates();
	if(!$obj)
		echo "no result";
	$row = $obj->fetch();
	while ($row){
	print_r($row);
	$row = $obj->fetch();
	}
?>