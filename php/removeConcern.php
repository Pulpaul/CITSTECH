<?php
	include('connections.php');

	$id = $_POST['id'];

	$sql = "UPDATE tblconcern SET status = 'Trashed' WHERE id='$id' ";

	if ($conn->query($sql) == true) {
		echo json_encode("Removed.");
	}
		
?>