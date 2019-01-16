<?php 
include('connection.php');
$query = mysqli_query($conn,"SELECT * FROM register_user WHERE user_type = 'SUPPORT' LIMIT 5 ");
while($row = mysqli_fetch_array($query)){ 
echo '<tr> <td>'.$row['f_name']. '</td>';
echo '<td>'.$row['m_name']. '</td>';
echo '<td>'.$row['l_name']. '</td>'; 
echo '<td>'.$row['user_name']. '</td>'; 
echo '<td>'.$row['user_email']. '</td>'; 
echo '<td>'.$row['contact_number']. '</td> </tr>'; 
} 
?>