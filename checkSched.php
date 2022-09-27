<?php
if(isset($_REQUEST['start']) or isset($_REQUEST['end'])){
	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];
	$date =  $_REQUEST['date'];
	
	$new_time = DateTime::createFromFormat('h:i A', $start);
	$newStart = $new_time->format('H:i:s');
	$new_time = DateTime::createFromFormat('h:i A', $end);
	$newEnd = $new_time->format('H:i:s');

	
	include("connect.php");
	//$sql = "SELECT * FROM bandeventstb where event_date = '$date' and(e_start > '$newStart' and e_end< '$end'  ) ";
	//$sql = "SELECT * FROM bandeventstb where event_date = '2020-12-31' and (e_start >= '10:00:00' || e_start <= '11:00:00') and (e_end >= '10:00:00' and e_end <= '11:00:00')";
	$sql = "SELECT * FROM reservation where res_date = '$date' and (starttime >='$newStart' && starttime <='$newEnd') and (endtime >='$newStart' && endtime <='$newEnd')";

	$result = $conn->query($sql);

	if($result->rowCount() > 0){
		echo "unavailable";
	}else{
		echo "available";
	}
	
}
?>