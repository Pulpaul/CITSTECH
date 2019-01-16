<?php
include 'connection.php';  

$department = $_POST['department'];
$pc_name = $_POST['pc_name'];
$printer_name = $_POST['printer_name'];
$system_unit = $_POST['system_unit'];
$mouse = $_POST['mouse'];
$monitor = $_POST['monitor'];
$keyboard = $_POST['keyboard'];

$sql = "INSERT INTO inventory (department,pc_name,printer_name,status,system_unit,mouse,monitor,keyboard) VALUES ('$department','$pc_name','$printer_name','Available','$system_unit','$mouse','$monitor','$keyboard') ";

if ($conn->query($sql) == true) {
	echo json_encode("Success");
	}
	else {
		echo json_encode("Error");
}
?>