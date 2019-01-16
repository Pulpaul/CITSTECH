<?php
include ('connections.php');
 
 $id = $_POST['id'];

$sql = "UPDATE tblconcern SET state = 'SeenEach' WHERE id = '$id' ";

if ($conn->query($sql) == true) {
		echo json_encode("Job order successfully updated.");
	} else {
		echo json_encode("Something went wrong.");
	}
?>