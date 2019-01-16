<?php
	include "connections.php";

	$query = $conn->query("SELECT * FROM register_user WHERE user_type = 'SUPPORT' ");

	$data = array();
	while ($row = $query->fetch_assoc()) {
		array_push($data, $row);
	}

	echo json_encode($data);
?>
