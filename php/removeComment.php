<?php
	include('connections.php');

	$id = $_POST['id'];

	$sql = "UPDATE feedback SET status = 'Removed' WHERE id='$id' ";

	if ($conn->query($sql) == true) {
		echo json_encode("Removed.");
	}
		
?>