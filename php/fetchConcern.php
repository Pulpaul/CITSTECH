<?php 
include('connection.php');

$SeenEach = 'SeenEach';

$query1 = mysqli_query($conn,"SELECT * FROM tblconcern WHERE status = 'Unreplied' OR status = 'Pending'  ");
$rows = mysqli_fetch_array($query1);

if ($rows == 0) {
	echo "<tr style='background: #EEE;'> <td> </td> <td> </td> <td class='text-center'> <label> Your Inbox is Empty </label> </td> <td> </td> <td> </td> </tr>";
}
elseif ($SeenEach == 'SeenEach') {
	$query = mysqli_query($conn,"SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE state = 'Unseen' OR state = 'Seen' AND  status = 'Unreplied' ORDER BY time_sent DESC "); 
	while($row = mysqli_fetch_array($query)){   
	echo '<tr style="background: #EEE;"> <td>'.$row['user_email']. '</td>';
	echo '<td>'.$row['type']. '</td>';
	echo '<td>'.$row['date_sent']. '</td>'; 
	echo '<td>'.$row['status']. '</td>'; 
	echo '<td>'." <a href='viewConcern.php?id=".$row['id']."' class='btn btn-info btn-fab btn-sm btn-round' data-toggle='tooltip' title='View' id='seenConcernEach' data-id='$row[id]'><i class='fa fa-info-circle'></i></a> ";
	echo "<button class='btn btn-warning btn-fab  btn-sm btn-round' data-toggle='tooltip' title='Remove' id='removeConcern' data-id='$row[id]'><i class='fa fa-archive'></i></button>". '</td> </tr> </button>'; 
	}

	$query = mysqli_query($conn,"SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE status = 'Unreplied'  AND state = 'SeenEach'   ORDER BY time_sent DESC "); 
	while($row = mysqli_fetch_array($query)){   
	echo '<tr> <td>'.$row['user_email']. '</td>';
	echo '<td>'.$row['type']. '</td>';
	echo '<td>'.$row['date_sent']. '</td>'; 
	echo '<td>'.$row['status']. '</td>'; 
	echo '<td>'." <a href='viewConcern.php?id=".$row['id']."' class='btn btn-info btn-fab btn-sm btn-round' data-toggle='tooltip' title='View' id='seenConcernEach' data-id='$row[id]'><i class='fa fa-info-circle'></i></a> ";
	echo "<button class='btn btn-warning btn-fab  btn-sm btn-round' data-toggle='tooltip' title='Remove' id='removeConcern' data-id='$row[id]'><i class='fa fa-archive'></i></button>". '</td> </tr> </button>'; 
	}
	$query = mysqli_query($conn,"SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE status = 'Pending'  AND state = 'SeenEach' ORDER BY time_sent DESC "); 
	while($row123 = mysqli_fetch_array($query)){   
	echo '<tr> <td>'.$row123['user_email']. '</td>';
	echo '<td>'.$row123['type']. '</td>';
	echo '<td>'.$row123['date_sent']. '</td>'; 
	echo '<td>'.$row123['status']. '</td>'; 
	echo '<td>'." <a href='viewConcern.php?id=".$row123['id']."' class='btn btn-info btn-fab btn-sm btn-round' data-toggle='tooltip' title='View' id='seenConcernEach' data-id='$row123[id]'><i class='fa fa-info-circle'></i></a> ";
	echo "<button class='btn btn-warning btn-fab  btn-sm btn-round' data-toggle='tooltip' title='Remove' id='removeConcern' data-id='$row123[id]'><i class='fa fa-archive'></i></button>". '</td> </tr> </button>'; 
	}
} 
 
?>