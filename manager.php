<?php 
  include('php/database_connection.php');
 include('php/connection.php'); 
  

if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
} 
else {
  $id = $_SESSION['user_id']["register_user_id"];
  $sql = "UPDATE register_user SET user_status = 'Active' WHERE register_user_id = '$id' ";
  mysqli_query($conn,$sql);
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Manager
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' /> 

  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <link href="css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" /> 
  <link rel="stylesheet" type="text/css" href="css/manager.css">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="danger" data-background-color="white"> 
      <div class="logo">
        <div class="simple-text logo-normal">
          <img class="navbar-brand" width="200" height="70" src="img/logocits.png">
        </div>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="">
              <i class="fa fa-area-chart"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="concernManager.php">
              <i class="fa fa-envelope"></i>
              <p>Concern</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ticketing.php">
              <i class="fa fa-ticket"></i>
              <p>Ticketing</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inventory.php">
              <i class="fa fa-cubes"></i>
              <p>Inventory</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="supportAccount.php">
              <i class="fa fa-users"></i>
              <p>Support</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="trashManager.php">
              <i class="fa fa-trash"></i>
              <p>Trash</p>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="main-panel"> 
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
        <div class="container-fluid">
          <div class="navbar-wrapper"> 
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav"> 
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-bell btn btn-warning btn-round btn-fab" id="seenForwardedConcern"></i>
                  <span id="countNotiForwardedConcern"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <div class="dropdown-header">
                      </div>
                      <table>
                        <tbody id="fetchNotiForwardedConcern">
                          
                        </tbody>
                      </table>
                      <div class="dropdown-footer text-center">
                        <a href="#">
                          <button  class="btn btn-link"> See More <i class="fa fa-plus"></i></button>
                        </a>
                      </div>
                </div>
              </li>
              <li class="dropdown nav-item">
                  <a href="#" class="profile-photo dropdown-toggle nav-link" data-toggle="dropdown">
                    <div class="profile-photo-small">
                      <img src="img/avatar.jpg" alt="Circle Image" class="rounded-circle img-fluid">
                    </div> 
                  </a>
                  <div class="dropdown-menu dropdown-menu-right"> 
                    <div class="dropdown-header">
                      <div class="profile-photo-small">
                      <img src="img/avatar.jpg" alt="Circle Image" class="rounded-circle img-fluid">
                      </div>   
                      <div class="text-center"> 
                        <?php echo $_SESSION['user_id']['f_name']; ?> 
                        </div>
                    </div>
                    <a href="" class="dropdown-item"> <button class="btn btn-info btn-fab btn-round"><i class="fa fa-cog"></i></button>ACCOUNT</a> 
                    <a href="php/logout.php" class="dropdown-item">  <button class="btn btn-warning btn-fab btn-round"><i class="fa fa-sign-out"></i></button> LOG OUT</a>
                  </div>
                </li>
                <li>
                 <?php echo $_SESSION['user_id']['user_type']; ?>
                </li>
            </ul>
          </div>
        </div>
      </nav>
      
      <div class="content">
        <div class="container-fluid"> 
          <div class="row">
            <div class="col-md-3">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-envelope"></i>
                  </div>
                  <p class="card-category">All Concern</p>
                  <h3 class="card-title" id="countConcernManager"></h3>
                </div>
                <div class="card-footer">
                  <div class="stats"> 
                    <h4> <i class="fa fa-clock-o"> </i> </h4> Latest: 3 Minutes Ago
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-stats">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-user"></i>
                  </div>
                  <p class="card-category">Pending Concerns</p>
                  <h3 class="card-title" id="countPending"></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <h4> <i class="fa fa-user"> </i> </h4> New: 
                    <?php 
                    include 'php/connection.php';

                    $sql =  mysqli_query($conn,"SELECT * FROM register_user WHERE user_type = 'USER' ORDER BY register_user_id DESC LIMIT 1");
                    $row = mysqli_fetch_array($sql);

                    echo $row['user_email'];
                    ?>
                  </div>
                </div>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <p class="card-category">Support</p>
                  <h3 class="card-title"  id="countSupport"></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <h4> <i class="fa fa-user"> </i> </h4> New: 
                    <?php 
                    include 'php/connection.php';

                    $sql =  mysqli_query($conn,"SELECT * FROM register_user WHERE user_type = 'SUPPORT' ORDER BY register_user_id DESC LIMIT 1");
                    $row = mysqli_fetch_array($sql);

                    echo $row['user_email'];
                    ?>
                  </div>
                </div>
              </div>
            </div> 
            <div class="col-md-3">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-ticket"></i>
                  </div>
                  <p class="card-category">Tickets</p>
                  <h3 class="card-title" id="countTicket"></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <h4> <i class="fa fa-google-plus-circle"> </i> </h4> To: paulselle03@gmail.com
                  </div>
                </div>
              </div>
            </div> 
          </div>  
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-danger">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper"> 
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#concernTable" data-toggle="tab">
                            <i class="fa fa-envelope"></i> Concern
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#ticketTable" data-toggle="tab">
                            <i class="fa fa-ticket"></i> Ticket
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#inventoryTable" data-toggle="tab">
                            <i class="fa fa-cubes"></i> Inventory
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#supportTable" data-toggle="tab">
                            <i class="fa fa-users"></i> Support
                            <div class="ripple-container"></div>
                          </a>
                        </li> 
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="concernTable">
                      <table class="table table-hover">
                        <thead>  
                          <th>Email</th>
                          <th>Type</th>
                          <th>Concern</th>
                          <th>Image </th>
                          <th>Date</th>
                          <th>Status</th>
                        </thead>
                            <tbody id="fetchConcernLatest">
                              
                            </tbody>
                          </table>
                        </div>
                        <div class="tab-pane" id="ticketTable"> 
                          <table class="table table-hover">
                            <thead>
                            <th>Concern ID</th>
                            <th>Time Sent</th>
                            <th>Date Sent</th>
                            <th>Reply ID</th>
                            <th>Time Replied</th>
                            <th>Date Replied</th>  
                          </thead>
                          <?php
                          include 'php/connection.php';

                          $empty = "";

                          $sql = "SELECT * FROM ticketing WHERE status = 'Created' ";
                          $result = mysqli_query($conn,$sql);

                          if (count($result) == 0) {
                             $empty = "<div style='background: #EEE;' class='text-center'> Empty Transactions </div>";
                           } 
                          else {
                            while ($row = mysqli_fetch_array($result)) { 

                          ?>
                          <tbody> 
                              <tr>
                              <td><?php echo $row['con_id']; ?></td>
                              <td><?php echo $row['time_sent']; ?></td>
                              <td><?php echo $row['date_sent']; ?></td>
                              <td><?php echo $row['rep_id']; ?></td>
                              <td><?php echo $row['time_replied']; ?></td>
                              <td><?php echo $row['date_replied']; ?></td>
                              </tr> 
                          </tbody> 
                        <?php } } ?>
                      </table>
                    </div>
                    <div class="tab-pane" id="inventoryTable">
                      <table class="table table-hover">
                        <thead>  
                          <th>ID</th>
                          <th>Department</th>
                          <th>PC</th>
                          <th>Printer</th>  
                        </thead> 
                        <?php
                        include 'php/connection.php';

                        $empty = "";

                        $sql = mysqli_query($conn,"SELECT * FROM inventory WHERE status != 'Trashed' ");
                        $result = mysqli_fetch_array($sql);

                        if ($result == 0) {
                           $empty = "<div class='alert alert-default text-center' style='background: #EEE;'><label>Inventory is empty</label></div>";
                         } 
                        else {
                        $sql = "SELECT * FROM inventory WHERE status != 'Trashed' ";
                        $result = mysqli_query($conn,$sql);
                        while ($row = mysqli_fetch_array($result)) { 

                        ?> 
                        <tbody>
                          <tr>
                            <td><?php echo $row['id']; ?></td>  
                            <td><?php echo $row['department']; ?></td> 
                            <td><?php echo $row['pc_name']; ?></td>
                            <td><?php echo $row['printer_name']; ?></td> 
                          </tr>
                        </tbody>
                      <?php } } ?>
                      </table>
                    </div>
                    <div class="tab-pane" id="supportTable">
                      <table class="table table-hover">
                        <thead>  
                          <th>First Name</th>
                          <th>Middle Name</th>
                          <th>Last Name</th>
                          <th>Username</th>
                          <th>G-mail</th>
                          <th>Contact No.</th>
                        </thead>
                        <tbody id="fetchSupport">
                          
                        </tbody>
                      </table>
                    </div> 
                  </div>
                </div>
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="card card-chart">
                <div class="card-header card-header-info">
                  <div class="ct-chart" id="dailySalesChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Concern Chart</h4>
                  <p class="card-category">
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today concerns.</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <h4><i class="fa fa-calendar"></i> </h4> Day: Sunday
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card card-chart">
                <div class="card-header card-header-primary">
                  <div class="ct-chart" id="websiteViewsChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Tickets Release</h4>
                  <p class="card-category">Slightly Increase compared on last August</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <h4><i class="fa fa-calendar"></i> </h4> Month: September
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer">
        <div class="container-fluid"> 
          <div class="copyright"> Competitive I.T Solutions Inc.
          </div> 
        </div>
      </footer>
    </div>
  </div>
  
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>  
  <script src="assets/js/plugins/chartist.min.js"></script> 
  <script src="assets/js/plugins/bootstrap-notify.js"></script> 
  <script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script> 
  <script src="js/function.js" type="text/javascript"></script>
  <script src="js/script.js" type="text/javascript"></script>
</body> 
</html>