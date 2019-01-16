<?php
	include('connection.php');

	$id=$_GET['id'];
 
	$department=$_POST['department'];	
	$pc_name=$_POST['pc_name'];
	$printer_name=$_POST['printer_name']; 
 
	mysqli_query($conn,"UPDATE inventory SET department='$department', pc_name='$pc_name', printer_name='$printer_name' WHERE id='$id'");

	
	header('location:../inventory.php');
?>