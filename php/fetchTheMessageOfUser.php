<?php
include 'database_connection.php';
include 'connection.php';

$id = $_GET['id'];
 $ids = $_SESSION['user_id']['register_user_id'];

$sql = "SELECT * FROM chat WHERE from_id = '$id' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if ($row == 0) {
	echo "<div class='alert alert-default' style='background-color: #EEE;'> Do you have some concern or questions? Message us and let us know. </div>";
}
else {
	$sql = "SELECT * FROM chat WHERE from_id = '$id' OR to_id = '$id' ORDER BY time_sent ASC";
	$result = mysqli_query($conn,$sql);  
	while ($rows = mysqli_fetch_array($result)) { 
		if ($rows['from_id'] == $ids) {
			echo "<div class='text-right'><label class='form-group text-left' style='background-color: indianred; border-radius: 10px 20px; padding: 10px; color: white;' data-toggle='tooltip' title='$rows[time_sent]'> 
	        $rows[message] 
	    	</label> </div>"; 
		}
		if ($rows['to_id'] == $ids) {
			echo "<div class='text-left'> <label class='form-group' style='background-color: #EEE; border-radius: 10px 20px; padding: 10px; color: black;' data-toggle='tooltip' title='$rows[time_sent]'> 
	        $rows[message] 
	    	</label> </div>"; 
		} 
	}
} 



?>