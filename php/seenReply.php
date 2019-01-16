<?php
include ('connections.php');
  include('database_connection.php'); 
 include('fetch_data.php');
$id_user = $row['register_user_id'];

$sql = "UPDATE tblreply SET state = 'Seen' WHERE state = 'Unseen' ";

if ($conn->query($sql) == true) {
		echo json_encode("Job order successfully updated.");
	} else {
		echo json_encode("Something went wrong.");
	}
	
	$sql2 = "UPDATE thread SET state = 'Seen' WHERE state = 'Unseen' AND status = 'Thread' AND id_user != '$id_user' ";
	if ($conn->query($sql2) == true) {
		echo json_encode("Job order successfully updated.");
	} else {
		echo json_encode("Something went wrong.");
	}
?>