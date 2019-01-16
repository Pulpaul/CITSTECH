<?php
	include('connections.php');

	$rep_id = $_POST['rep_id'];

	$sql = "UPDATE tblreply SET status = 'Deleted' WHERE rep_id='$rep_id' ";

	if ($conn->query($sql) == true) {
		echo json_encode("Removed.");
	}
		
?>