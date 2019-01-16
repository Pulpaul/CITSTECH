<?php
  include('database_connection.php');

                        $pdoQuery = "SELECT * FROM tblconcern  WHERE status = 'Unreplied' AND state = 'Unseen' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        if ($pdoRowCount <= 0) {
                            echo " ";
                          } else {
                          echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
                          } 
                        ?>