<?php
include 'connection.php';  

$register_user_id = $_POST['register_user_id'];

$sql = "UPDATE register_user SET user_password = 'Reset' WHERE register_user_id = '$register_user_id' ";


if ($conn->query($sql) == true) {
	echo json_encode("Success");
	}
	else {
		echo json_encode("Error");
}
?>