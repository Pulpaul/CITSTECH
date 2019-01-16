<?php
	
	include "connections.php";

	$from_id = $_POST['from_id'];
	$to_id = $_POST['to_id']; 
	$message = $_POST['message'];
	$date_sent = date('Y/m/d');
	$time_sent = date('h:i a');

	$sql = "INSERT INTO chat (from_id,to_id,message,date_sent,time_sent,status) VALUES ('$from_id','$to_id','$message','$date_sent','$time_sent','Unseen')";
	
	if ($conn->query($sql) == true) {
		echo json_encode("Added.");
	} else {
		echo json_encode("Something went wrong.");
	}

?>