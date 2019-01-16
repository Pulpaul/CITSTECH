<?php

include('connection.php');
$register_user_id = $_SESSION['user_id']['register_user_id'];
$queryies = "SELECT * FROM register_user WHERE register_user_id='$register_user_id'";
$resultus = mysqli_query($conn, $queryies);
$rowwd = mysqli_fetch_array($resultus);

?>