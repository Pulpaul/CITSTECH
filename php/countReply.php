<?php
 include('database_connection.php'); 

    $id = $_SESSION['user_id']['register_user_id'];

    $pdoQuery = "SELECT * FROM tblreply WHERE users_id = '$id'   AND status = 'Sent' ";
    $pdoResult = $connect->query($pdoQuery);
    $pdoRowCount = $pdoResult->rowCount();
    echo "$pdoRowCount"; 

?>