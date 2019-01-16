<?php
include 'connection.php';
include('database_connection.php');    
 
$users_id = $_SESSION['user_id']['register_user_id'];
$SeenEach = 'SeenEach';

$sql = "SELECT * FROM tblreply WHERE users_id = '$users_id' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
	echo "<div class='dropdown-item' style='background: #EEE;'> No Notification  </div>";
}
elseif ( $SeenEach == 'SeenEach' ) {
	$sql = "SELECT * FROM tblreply INNER JOIN register_user ON sup_id = register_user_id WHERE users_id = '$users_id' AND status = 'Sent' AND state = 'Seen'";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_array($result)) {
	echo '<tr style="background: #EEE;"> <td>' ."<a href='viewReply.php?rep_id=".$row['rep_id']."' class='dropdown-item' id='seenReplyEach' data-id='$row[rep_id]'> <button class='btn btn-info btn-fab btn-round'><i class='fa fa-envelope'></i></button>" . $row['user_email'] . ' replied to your concern. </a> </td> </tr>';
	}

	$sql = "SELECT * FROM tblreply INNER JOIN register_user ON sup_id = register_user_id WHERE users_id = '$users_id' AND status = 'Sent' AND state = 'SeenEach'";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_array($result)) {
	echo '<tr> <td>' ."<a href='viewReply.php?rep_id=".$row['rep_id']."' class='dropdown-item' id='seenReplyEach' data-id='$row[rep_id]'> <button class='btn btn-info btn-fab btn-round'><i class='fa fa-envelope'></i></button>" . $row['user_email'] . ' replied to your concern. </a> </td> </tr>';
	}
}
  

$query = "SELECT * FROM thread LEFT JOIN register_user ON id_user = register_user_id WHERE id_user != '$users_id' AND state = 'Unseen'  OR  state = 'Unseen' AND status = 'Thread' ";
	$results = mysqli_query($conn, $query);

	while ( $row = mysqli_fetch_assoc($results)) {
	echo '<tr style="background: #EEE;"> <td>'. "<a href='forum.php?id=".$row['id_con']."' class='dropdown-item' id='seenThreadEach' data-id='$row[id_con]'> <button class='btn btn-success btn-fab btn-round'> <i class='fa fa-comments'> </i> </button> " .$row['user_email'].'  replied on the forum. </a> </td> </tr>';
	}

	$query = "SELECT * FROM thread LEFT JOIN register_user ON id_user = register_user_id WHERE id_user != '$users_id' AND state = 'SeenEach' AND status = 'Thread'   ";
	$results = mysqli_query($conn, $query);

	while ( $row = mysqli_fetch_assoc($results)) {
	echo '<tr> <td>'. "<a href='forum.php?id=".$row['id_con']."' class='dropdown-item' id='seenThreadEach' data-id='$row[id_con]'> <button class='btn btn-success btn-fab btn-round'> <i class='fa fa-comments'> </i> </button> " .$row['user_email'].'  replied on the forum. </a> </td> </tr>';
	}

?>