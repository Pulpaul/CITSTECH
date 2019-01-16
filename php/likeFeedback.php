<?php
	include('connections.php');  

	$id = $_POST['id']; 
	$user_id = $_POST['user_id'];
	
	$sql = "INSERT INTO feedback (conc_id, rate,user_id,comment,status) VALUES ('$id',  +1,'$user_id',+0,'Rate') ";
	if ($conn->query($sql) == true) {
		echo json_encode("Liked!");
	}
		
?>