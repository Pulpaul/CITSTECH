<?php
include 'database_connection.php'; 

	$s_id = $_SESSION['user_id']['register_user_id'];
	$output = array();
	$statement = $connect->prepare(
		"SELECT * FROM register_user INNER JOIN chat ON register_user_id = from_id  WHERE user_type = 'USER' GROUP BY register_user_id ORDER BY time_sent DESC ");
	$statement->execute();
	$result = $statement->fetchAll(); 
	foreach($result as $row)
	{ 	 
		if ($row["user_status"] == "Active") { 
			echo  "<tr><td><i class='fa fa-dot-circle-o text-success'></i> <a href='viewUserConversation.php?id=$row[register_user_id]' class='btn btn-link' id='seenUserMessage'> $row[user_name] </a>"; 
			if ($row['status'] == "Unseen") {
				echo "<span class='text-danger' style='font-size: 30px;'>•</span>"; 
			}
			echo "</td></tr>";
		}
		elseif ($row["user_status"] == "Inactive") {
			echo  "<tr><td><i class='fa fa-dot-circle-o'></i> <a href='viewUserConversation.php?id=$row[register_user_id]' class='btn btn-link' id='seenUserMessage'> $row[user_name] </a>";
			if ($row['status'] == "Unseen") {
				echo "<span class='text-danger' style='font-size: 30px;'><b>•</b></span>"; 
			} 
			echo "</td></tr>";
		}
	}


?> 