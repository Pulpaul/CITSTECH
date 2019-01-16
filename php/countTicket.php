<?php
  include('database_connection.php');

                        $pdoQuery = "SELECT * FROM ticketing  WHERE status = 'Created'";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        echo "$pdoRowCount"; 
                        ?>