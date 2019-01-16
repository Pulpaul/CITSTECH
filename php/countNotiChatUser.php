    <?php
 include('database_connection.php');  
 $id = $_SESSION['user_id']['register_user_id'];

    $pdoQuery = "SELECT * FROM chat WHERE to_id = '$id' AND status = 'Unseen' ";
    $pdoResult = $connect->query($pdoQuery);
    $pdoRowCount = $pdoResult->rowCount(); 

    if ($pdoRowCount  <= 0) {
        echo " ";
    } 
    else { 
            echo "<div class='notification'>";
            echo $pdoRowCount; 
            echo "</div>"; 
    } 

?>