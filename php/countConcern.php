<?php 
  include('database_connection.php');


                        $pdoQuery = "SELECT * FROM tblconcern  WHERE status = 'Unreplied' OR status = 'Pending'   ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        echo "$pdoRowCount"; 
                        ?>