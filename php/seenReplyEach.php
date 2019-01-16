<?php
include ('connections.php');
 
 $rep_id = $_POST['rep_id'];

$sql = "UPDATE tblreply SET state = 'SeenEach' WHERE rep_id = '$rep_id' ";

if ($conn->query($sql) == true) {
		echo json_encode("Job order successfully updated.");
	} else {
		echo json_encode("Something went wrong.");
	}
?>