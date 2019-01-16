<?php

include('connection.php');
$register_user_id = $_SESSION['user_id']['register_user_id'];
$query = "SELECT * FROM register_user WHERE register_user_id= '$register_user_id' ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

?>