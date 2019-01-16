<?php
  include('database_connection.php');

                        $pdoQuery = "SELECT * FROM tblconcern WHERE status = 'Pending' "; 

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        echo "$pdoRowCount"; 
                        ?>