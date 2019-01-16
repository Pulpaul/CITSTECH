<?php
	include('connections.php');

	$id = $_POST['id'];

	$sql = "UPDATE tblconcern SET status = 'Replied' WHERE id='$id' ";

	if ($conn->query($sql) == true) {
		echo json_encode("Removed.");
	}
		
?>