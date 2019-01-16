    <?php
 include('database_connection.php'); 
include('fetch_data.php');
$id_user = $row['register_user_id'];
    $pdoQuery = "SELECT * FROM tblconcern WHERE state = 'Unseen' AND status = 'Unreplied' ";
    $pdoResult = $connect->query($pdoQuery);
    $pdoRowCount = $pdoResult->rowCount();

    $sql = "SELECT * FROM thread WHERE state = 'Unseen' AND status = 'Thread' AND id_user != '$id_user'  ";
    $result = $connect->query($sql);
    $count = $result->rowCount();

    if ($pdoRowCount Xor $count <= 0) {
        echo " ";
    } 
    else { 
        $yeah =  $pdoRowCount + $count; 
        if ($yeah <= 0) {
            echo " ";
        }
        else {
            echo "<div class='notification'>";
            echo $yeah; 
            echo "</div>";
        }
    } 

?>