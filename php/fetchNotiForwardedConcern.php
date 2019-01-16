<?php
include 'connection.php';

$SeenEach = 'SeenEach';

$sql = "SELECT * FROM tblconcern WHERE status = 'Forwarded' OR status = 'Pending' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
	echo '<div class="dropdown-item" style="background: #EEE;"> No Notification </div>';
}
elseif ( $SeenEach == 'SeenEach') {
	$query = "SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE  state = 'Seen'  AND status = 'Forwarded' LIMIT 10";
	$results = mysqli_query($conn, $query);

	while ( $row = mysqli_fetch_assoc($results)) {
	echo '<tr style="background: #EEE;"> <td>'. "<a href='concernManager.php' class='dropdown-item' id='seenConcernEach' data-id='$row[id]'> <button class='btn btn-info btn-fab btn-round'> <i class='fa fa-envelope'> </i> </button> " .$row['user_email'].' sent a concern. </a> </td> </tr>';
	}

	$query = "SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE state = 'SeenEach' AND status = 'Forwarded' LIMIT 10";
	$results = mysqli_query($conn, $query);

	while ( $row = mysqli_fetch_assoc($results)) {
	echo '<tr> <td>'. "<a href='concernManager.php' class='dropdown-item' id='seenConcernEach' data-id='$row[id]'> <button class='btn btn-info btn-fab btn-round'> <i class='fa fa-envelope'> </i> </button> " .$row['user_email'].'  sent a concern. </a> </td> </tr>';
	}

	$querya = "SELECT * FROM tblconcern WHERE  status = 'Pending' LIMIT 10";
	$resulta = mysqli_query($conn, $querya);

	while ( $row = mysqli_fetch_assoc($resulta)) {
		echo '<tr> <td>'. "<a href='pendingConcern.php' class='dropdown-item' id='seenConcernEach' data-id='$row[id]'> <button class='btn btn-info btn-fab btn-round'> <i class='fa fa-retweet'> </i> </button> " .count($resulta).'  concerns are pending, Click here to view. </a> </td> </tr>';
	}
}




?>