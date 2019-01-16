<?php
include 'database_connection.php'; 

	$s_id = $_SESSION['user_id']['register_user_id'];
	$output = array();
	$statement = $connect->prepare(
		"SELECT * FROM  chat WHERE to_id = '$s_id' AND status = 'Unseen' LIMIT 1 ");
	$statement->execute();
	$result = $statement->fetchAll(); 
	foreach($result as $row)
	{ 	   
				echo "<span class='text-danger' style='font-size: 30px;'><b>•</b></span>";  
	}


?> 