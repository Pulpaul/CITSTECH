<?php
 include('database_connection.php'); 

    $pdoQuery = "SELECT * FROM tblconcern WHERE state = 'Unseen' AND status = 'Forwarded' ";
    $pdoResult = $connect->query($pdoQuery);
    $pdoRowCount = $pdoResult->rowCount();

    if ($pdoRowCount <= 0) {
    	echo " ";
    } 
    else {
    	echo "<div class='notification'>$pdoRowCount</div>";  
    } 
?>