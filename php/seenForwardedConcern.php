<?php
include ('connections.php');
 
$sql = "UPDATE tblconcern SET state = 'Seen' WHERE state = 'Unseen' AND status = 'Forwarded' ";

if ($conn->query($sql) == true) {
		echo json_encode("Job order successfully updated.");
	} else {
		echo json_encode("Something went wrong.");
	}
	
?>