<?php
include 'connection.php';

$SeenEach = 'SeenEach';
$sql5 = "SELECT * FROM thread WHERE status = 'Thread' ";
$res = mysqli_query($conn, $sql5);
$cou = mysqli_num_rows($res);

$sql = "SELECT * FROM tblconcern WHERE status = 'Unreplied' OR status = 'Pending' ";
$result = mysqli_query($conn, $sql);
$nt = mysqli_num_rows($result);

if ($cou == 0 && $nt == 0) {
	echo '<div class="dropdown-item" style="background: #EEE;"> No Notification </div>';
}
elseif ( $SeenEach == 'SeenEach') {
	$query = "SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE  state = 'Unseen' OR state = 'Seen' AND  status = 'Unreplied' LIMIT 10";
	$results = mysqli_query($conn, $query);

	while ( $row = mysqli_fetch_assoc($results)) {
	echo '<tr style="background: #EEE;"> <td>'. "<a href='viewConcern.php?id=".$row['id']."' class='dropdown-item' id='seenConcernEach' data-id='$row[id]'> <button class='btn btn-info btn-fab btn-round'> <i class='fa fa-envelope'> </i> </button> " .$row['user_email'].' sent a concern. </a> </td> </tr>';
	}

	$query = "SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE status = 'Unreplied'  AND state = 'SeenEach'  LIMIT 10";
	$results = mysqli_query($conn, $query);

	while ( $row = mysqli_fetch_assoc($results)) {
	echo '<tr> <td>'. "<a href='viewConcern.php?id=".$row['id']."' class='dropdown-item' id='seenConcernEach' data-id='$row[id]'> <button class='btn btn-info btn-fab btn-round'> <i class='fa fa-envelope'> </i> </button> " .$row['user_email'].'  sent a concern. </a> </td> </tr>';
	}

	$query = "SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE status = 'Pending'  AND state = 'SeenEach'  LIMIT 10";
	$results = mysqli_query($conn, $query);

	while ( $row = mysqli_fetch_assoc($results)) {
	echo '<tr> <td>'. "<a href='viewConcern.php?id=".$row['id']."' class='dropdown-item' id='seenConcernEach' data-id='$row[id]'> <button class='btn btn-info btn-fab btn-round'> <i class='fa fa-envelope'> </i> </button> " .$row['user_email'].'  sent a concern. </a> </td> </tr>';
	}
}

 include('database_connection.php'); 
 include('fetch_data.php');
$id_user = $row['register_user_id'];

$query = "SELECT * FROM thread INNER JOIN register_user ON id_user = register_user_id WHERE status = 'Thread' AND id_user != '$id_user' AND state = 'Unseen' OR state = 'Seen'  ";
	$results = mysqli_query($conn, $query);

	while ( $row = mysqli_fetch_assoc($results)) {
	echo '<tr style="background: #EEE;"> <td>'. "<a href='viewForumSupport.php?id=".$row['id_con']."' class='dropdown-item' id='seenThreadEach' data-id='$row[id_con]'> <button class='btn btn-success btn-fab btn-round'> <i class='fa fa-comments'> </i> </button> " .$row['user_email'].'  replied on the forum. </a> </td> </tr>';
	}

	$query = "SELECT * FROM thread INNER JOIN register_user ON id_user = register_user_id WHERE status = 'Thread'  AND state = 'SeenEach' AND id_user != '$id_user'  ";
	$results = mysqli_query($conn, $query);

	while ( $row = mysqli_fetch_assoc($results)) {
	echo '<tr> <td>'. "<a href='viewForumSupport.php?id=".$row['id_con']."' class='dropdown-item' id='seenThreadEach' data-id='$row[id_con]'> <button class='btn btn-success btn-fab btn-round'> <i class='fa fa-comments'> </i> </button> " .$row['user_email'].'  replied on the forum. </a> </td> </tr>';
	}

?>