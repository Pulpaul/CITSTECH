<?php
	include('connection.php');

	$id=$_GET['id'];
 
	$department= $_POST['department'];	
	$pc_name= $_POST['pc_name'];
	$printer_name= $_POST['printer_name'];
	$system_unit= $_POST['system_unit'];
	$mouse= $_POST['mouse'];
	$monitor= $_POST['monitor'];
	$keyboard= $_POST['keyboard'];
 
	mysqli_query($conn,"UPDATE inventory SET department = '$department', pc_name = '$pc_name', printer_name='$printer_name', system_unit='$system_unit', mouse='$mouse', monitor='$monitor', keyboard='$keyboard' WHERE id= '$id' ");

		
		header('location: ../inventory.php');
?>