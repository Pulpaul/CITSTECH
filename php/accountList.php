<?php
	include "connections.php";

	$result = $conn->query("SELECT * FROM register_user WHERE user_type != 'WEB MASTER'");

	$data = array();
	while ($row = $result->fetch_assoc()) {
		array_push($data, $row);
	}

	echo json_encode($data);
?>