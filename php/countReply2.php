<?php
 include('database_connection.php');

if(!isset($_SESSION["user_id"]))
{
    header("location: logout.php");
}

include('connection.php');

$id = $_SESSION['user_id']['register_user_id']; 

                        $pdoQuery = "SELECT * FROM tblreply WHERE users_id = '$id'   AND status = 'Sent' AND state = 'Unseen' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        if ($pdoRowCount <= 0) {
                          echo " ";
                        } else {
                        echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
                        } 

              ?>