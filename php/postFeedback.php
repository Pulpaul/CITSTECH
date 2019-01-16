<?php
include 'connections.php';  

$comment = $_POST['comment'];
$conc_id = $_POST['conc_id']; 
$user_id = $_POST['user_id'];  

$sql = "INSERT INTO feedback (comment,conc_id,user_id,rate,status) VALUES ('$comment','$conc_id','$user_id',+0,'Comment') ";


if ($conn->query($sql) == true) {
	echo json_encode("Success");
	}
	else {
		echo json_encode("Error");
}
?>