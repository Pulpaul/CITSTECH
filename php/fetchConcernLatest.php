<?php 
include('connection.php');
$query = mysqli_query($conn,"SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE status = 'Forwarded'  ORDER BY time_sent DESC LIMIT 5");
while($row = mysqli_fetch_array($query)){ 
echo '<tr> <td>'.$row['user_email']. '</td>';
echo '<td>'.$row['type']. '</td>';
echo '<td>'.$row['concern']. '</td>'; 
echo '<td>';
echo "<img src='data: image/jpeg;base64,".base64_encode($row['image'])."' class='img-raised rounded img-fluid' width='500'>";
echo '</td>'; 
echo '<td>'.$row['date_sent']. '</td>'; 
echo '<td> <span class="badge badge-pill badge-danger">'.$row['status']. '</span> </td> </tr>'; 
} 
?>