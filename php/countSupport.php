<?php
  include('database_connection.php');

                        $pdoQuery = "SELECT * FROM register_user  WHERE user_type = 'SUPPORT' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        echo "$pdoRowCount"; 
                        ?>