<?php
	include "connections.php";

	$id = $_POST['id'];

	$result = $conn->query("SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE id = '$id' ");

	$data = array();
	while ($row = $result->fetch_assoc()) {
		array_push($data, $row);
	}

	echo json_encode($data);	
?>