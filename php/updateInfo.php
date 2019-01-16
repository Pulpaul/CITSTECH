<?php 
include ('connections.php');

$register_user_id = $_GET["register_user_id"];

$f_name = $_POST["f_name"];
$m_name = $_POST["m_name"];
$l_name = $_POST["l_name"];
$user_name = $_POST["user_name"];
$user_email = $_POST["user_email"];
$contact_number = $_POST["contact_number"];

$sql = "UPDATE register_user SET f_name='$f_name',m_name='$m_name',l_name='$l_name',user_name='$user_name',user_email='$user_email',contact_number='$contact_number' WHERE register_user_id = '$register_user_id' ";

if ($conn->query($sql) == true) {
		echo json_encode("Information successfully updated.");
	} else {
		echo json_encode("Something went wrong.");
	}
?>