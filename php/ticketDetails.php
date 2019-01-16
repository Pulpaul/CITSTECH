<?php
	include "connections.php";

	$ticket_id = $_POST['ticket_id'];

	$result = $conn->query("SELECT * FROM ticketing WHERE ticket_id = '$ticket_id' ");

	$data = array();
	while ($row = $result->fetch_assoc()) {
		array_push($data, $row);
	}

	echo json_encode($data);	
?>