<?php

	include('connection.php');
	
	$id= $_GET['id'];

	mysqli_query($conn,"DELETE FROM `register_user` WHERE register_user_id='$id'");

	header('location: ../accounts.php');
?>