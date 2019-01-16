<?php
	include('connections.php');

	$id = $_POST['id'];

	$sql = "UPDATE inventory SET status = 'Deleted' WHERE id='$id' ";

	if ($conn->query($sql) == true) {
		echo json_encode("Removed.");
	}
		
?>