<?php
 include('database_connection.php');
 include('connection.php'); 

$id = $_SESSION['user_id']["register_user_id"];

	$sql = "UPDATE register_user SET user_status = 'Inactive' WHERE register_user_id = '$id' ";
	mysqli_query($conn,$sql);

session_destroy();

header("location: ../index.php");

?>