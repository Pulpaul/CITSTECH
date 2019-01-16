<?php 
  include('php/database_connection.php');

if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
} 

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title> 
    CITS TICKET
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' /> 

  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <link href="css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/manager.css">
  <link type="text/css" rel="stylesheet" href="plugins/sweetalert/sweetalert.css"> 
</head>  
<body>
  	<?php
  		include 'php/connection.php'; 
      $ticket_id = $_GET['ticket_id'];
  		$sql = mysqli_query($conn,"SELECT * FROM ticketing WHERE ticket_id = '$ticket_id' ");
  		$row = mysqli_fetch_array($sql);

      $cid = $row['con_id'];
      $query = mysqli_query($conn,"SELECT * FROM tblconcern WHERE id = '$cid' ");
      $fetch = mysqli_fetch_array($query);

      $rid = $row['rep_id'];
      $syntax = mysqli_query($conn,"SELECT * FROM tblreply WHERE rep_id = '$rid' ");
      $read = mysqli_fetch_array($syntax);
  	?>
  <div class="container">
  	<div class="card"> 
  		<div class="card-body">
  			<div class="container text-center">
  			<img src="img/logocits.png" width="250"> <br>
  			<i class="fa fa-ticket"></i> TICKETING SYSTEM
        <br>
        <label>Ticket ID:</label> <?php echo $row['ticket_id']; ?>
        <br>
        <label>Time Issued:</label><?php echo date("h:i: a"); ?> <br>
        <label>Date Issued:</label><?php echo date("Y/m/d"); ?>
  			</div> <br>
  			<table class="table table-bordered">
        <tr>
          <th>CONCERN DETAILS</th>
          <th>REPLY DETAILS</th>  
        </tr>
        <tr>
          <td><label>User ID:</label> <?php echo $row['u_id']; ?></td>
          <td><label>Support ID:</label> <?php echo $row['s_id']; ?></td>  
        </tr>
        <tr>
          <td><label>Concern ID:</label> <?php echo $row['con_id']; ?></td>
          <td><label>Reply ID:</label> <?php echo $row['rep_id']; ?></td>
        </tr>
        <tr>
          <td><label>Type:</label> <?php echo $fetch['type']; ?></td>
          <td><label>Message:</label> <?php echo $read['rep_concern']; ?></td>
        </tr>
        <tr>
          <td><label>Question:</label> <?php echo $fetch['question']; ?></td>
          <td><label>Image:</label> 
            <?php
            if ($read['rep_image'] == "") {
              echo "No Image Included";
            }
            else {
              echo "<img src='data: image/jpeg;base64,".base64_encode($read['rep_image'])."' class='img-raised rounded img-fluid' width='50'>";  
            } 
            ?> </td>
        </tr>
        <tr>
          <td><label>Concern:</label> <?php echo $fetch['concern']; ?></td>
          <td><label>Time Replied:</label> <?php echo $row['time_replied']; ?></td>
        </tr>
        <tr>
          <td><label>Image:</label> 
          <?php
            if ($fetch['image'] == "") {
              echo "No Image Include";
            }
            else {
              echo "<img src='data: image/jpeg;base64,".base64_encode($fetch['image'])."' class='img-raised rounded img-fluid' width='50'>";  
            } 
            ?> </td> 
          <td><label>Date Replied:</label> <?php echo $row['date_replied']; ?></td> 
        </tr>
        <tr>
          <td><label>Time Sent:</label> <?php echo $row['time_sent']; ?></td>
        </tr> 
        <tr>
          <td><label>Date Sent:</label> <?php echo $row['date_sent']; ?></td>
        </tr> 
      </table>
  		</div> 
  		<div class="card-footer">
  			<button onclick="printTicket()" class="btn btn-primary btn-round btn-fab btn-sm"><i class="fa fa-print"></i></button>
  		</div>
  	</div>
  </div>


  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>   
  <script src="assets/js/plugins/bootstrap-notify.js"></script> 
  <script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>  
  <script type="text/javascript" src="plugins/sweetalert/sweetalert.min.js"></script>
  <script type="text/javascript" src="plugins/sweetalert/dialogs.js"></script> 
  <script src="js/script.js" type="text/javascript"></script>
  <script src="js/function.js" type="text/javascript"></script> 

</body> 
</html>