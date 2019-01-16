<?php
include ('connections.php'); 
$id_con = $_POST['id_con'];
$sql = "UPDATE thread SET state = 'SeenEach' WHERE id_con = '$id_con' ";

if ($conn->query($sql) == true) {
		echo json_encode("Job order successfully updated.");
	} else {
		echo json_encode("Something went wrong.");
	}
	
?>