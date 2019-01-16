<?php 
 include('database_connection.php');   
 include('connection.php'); 
 
$id = $_SESSION['user_id']['register_user_id'];
$SeenEach = 'SeenEach';

$query = mysqli_query($conn,"SELECT * FROM tblreply WHERE users_id = '$id'  AND status = 'Sent' ");
$row = mysqli_fetch_array($query);
if (count($row) == 0) {
	echo "<tr style='background: #EEE;'> <td> </td> <td class='text-right'> <label> Your Inbox is Empty </label> </td> <td> </td> <td> </td> </tr>";
}
elseif ( $SeenEach == 'SeenEach' ){
	$query = "SELECT * FROM tblreply INNER JOIN register_user ON sup_id = register_user_id WHERE users_id = '$id'  AND status = 'Sent' AND state = 'Seen' OR state = 'Unseen' ORDER BY time_reply DESC ";
	$result = mysqli_query($conn,$query);
	while ($row = mysqli_fetch_array($result)) {
	echo '<tr style="background: #EEE;"> <td>'.$row['user_email']. '</td>'; 
	echo '<td>'.$row['rep_concern']. '</td>';
	echo '<td>'.$row['date_reply']. '</td>'; 
	echo '<td  class="text-center">'."<a href='viewReply.php?rep_id=".$row['rep_id']." ' class='btn btn-info btn-round btn-fab btn-sm' data-toggle='tooltip' data-placement='top' title='View' data-container='body' id='seenReplyEach' data-id='$row[rep_id]'><i class='fa fa-info-circle'></i></a> ";
	echo "<button class='btn btn-danger btn-round btn-fab btn-sm' data-toggle='tooltip' title='Remove' id='removeReply' data-id='$row[rep_id]'><i class='fa fa-archive'></i></button> </td> </tr>";
	}

	$query = "SELECT * FROM tblreply INNER JOIN register_user ON sup_id = register_user_id WHERE users_id = '$id'  AND status = 'Sent' AND state = 'SeenEach' ORDER BY time_reply DESC ";
	$result = mysqli_query($conn,$query);
	while ($row = mysqli_fetch_array($result)) {
	echo '<tr> <td>'.$row['user_email']. '</td>'; 
	echo '<td>'.$row['rep_concern']. '</td>';
	echo '<td>'.$row['date_reply']. '</td>'; 
	echo '<td  class="text-center">'."<a href='viewReply.php?rep_id=".$row['rep_id']." ' class='btn btn-info btn-round btn-fab btn-sm' data-toggle='tooltip' data-placement='top' title='View' data-container='body' id='seenReplyEach' data-id='$row[rep_id]'><i class='fa fa-info-circle'></i></a> ";
	echo "<button class='btn btn-danger btn-round btn-fab btn-sm' data-toggle='tooltip' title='Remove' id='removeReply' data-id='$row[rep_id]'><i class='fa fa-archive'></i></button> </td> </tr>";
	} 
}

?>