<?php
	include('connections.php');

	$id = $_POST['id'];
	$inputValue = $_POST['inputValue'];

	$sql = "UPDATE tblconcern SET status = 'Pending', state = 'Unseen', reason = '$inputValue' WHERE id = '$id' ";
	
	if ($conn->query($sql) == true) {
		echo json_encode("Removed.");
	}

?>