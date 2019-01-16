<?php
	include('connections.php');

	$ticket_id = $_POST['ticket_id'];

	$sql = "UPDATE ticketing SET status = 'Created' WHERE ticket_id='$ticket_id' ";
	
	if ($conn->query($sql) == true) {
		echo json_encode("Removed.");
	}
		
?>