<?php 
  include('php/database_connection.php');
  include('php/functions.php');

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
    Concern
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' /> 
  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <link href="css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/manager.css"> 
  <link type="text/css" rel="stylesheet" href="plugins/sweetalert/sweetalert.css">
  <style type="text/css">
    .card-footer{
      display: none;
    }
  </style>
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
          <li class="nav-item">
            <a class="nav-link" href="manager.php">
              <i class="fa fa-area-chart"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item active">
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
            <div class="col-md-12">
              <div>
                <?php echo $oobb; ?>
              </div>
              <div class="card js-sweetalert">
                <div class="card-header card-header-danger text-center">
                  <div class="card-title "><i class="fa fa-envelope"></i> CONCERN</div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                    Total: <?php

                        $pdoQuery = "SELECT * FROM tblconcern WHERE status = 'Forwarded' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        echo "$pdoRowCount"; ?> Concern
                    </div>
                    <div class="col-md-4"> 
                      <div class="input-group has-danger">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <button class="btn btn-danger btn-fab btn-sm btn-round"><i class="fa fa-search"></i></button>
                          </span>
                        </div>
                        <input type="text" id="myInput" onkeyup="Search()" class="form-control" placeholder="Search">
                      </div> 
                    </div>
                    <div class="col-md-4 text-right">
                      Total: 
                      <?php
                      
                        $pdoQuery = "SELECT * FROM tblconcern WHERE status = 'Pending' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        echo "<span class='notification'>$pdoRowCount</span>"; ?>
                      <a href="pendingConcern.php" class="btn btn-danger btn-round">Pending Concerns</a>
                    </div>
                  </div> 
                  <div class="table-responsive">
                    <table id="myTable" class="table table-hover">
                        <thead>  
                          <th>ID</th> 
                          <th>Email</th>
                          <th>Type</th> 
                          <th>Date</th> 
                          <th>Option</th> 
                        </thead>
                        <?php 
                        include 'php/connection.php';

                        $sql = "SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE status = 'Forwarded' ";
                        $result = mysqli_query($conn,$sql);
                        while ($row = mysqli_fetch_array($result)) {
                          
                        ?>
                        <tbody id="fetchConcernManager">
                              <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['user_email']; ?></td>
                                <td><?php echo $row['type']; ?></td>
                                <td><?php echo $row['date_sent']; ?></td>
                                <td><a href="viewConcernManager.php?id=<?php echo $row['id']; ?>"viewConcernManager" data-id="<?php echo $row['id']; ?>" class="btn btn-info btn-fab btn-round btn-sm" rel="tooltip" title="View"><i class="fa fa-info-circle"></i></a>  <button id="removeConcernManager" data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-fab btn-round btn-sm" data-toggle="tooltip" title="Remove"><i class="fa fa-trash"></i></button> </td>
                              </tr>
                        </tbody>
                        <?php } ?>
                      </table>
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
  
  <div class="modal fade" id="viewConcern" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title"> <i class="fa fa-envelope-open"></i> <span id="usn"></span> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-7">
              <b>From:</b> <span id="em"></span> <br /> 
              <b>Type:</b> <span id="ty"></span> <br /> <br />
            </div>
            <div class="col-md-5 text-right">
              <span id="ds"></span>   
              <span id="ts"></span> 
            </div>
          </div> 
          <b>Concern:</b>
          <div class="card">
            <div class="container"  style="padding: 20px 20px; background-color: #EEE;">
              <span id="con"></span> <br /> <br />
              <img src="concernimage/bluescreenconcern.jpg" class="img-fluid rounded img-raised"> <br /> <br />
            </div> 
          </div>
          <div class="text-center"> 
            
            <button class="btn btn-primary btn-round" id="btnReply"><i class="fa fa-send"></i> Reply</button>
          </div>
        </div> 


        <div class="card-footer" id="replyConcern">   
          <h5 class="modal-title">Reply: </h5>
          <div class="card" style="padding: 10px 10px;">
            <div class="container">
              <form method="post" action="concernManager.php" enctype="multipart/form-data">
              <div class="form-group" hidden="">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                Concern ID:
                              </span>
                            </div>
                              <select class="form-control show-tick" name="concern_id"  id="concern_id" required="" readonly>
                                <option class="opt" id="cid"></option> 
                              </select>
                          </div>
                        </div>
                        <div class="form-group" hidden="">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                User ID:
                              </span>
                            </div>
                            <select class="form-control show-tick" name="users_id" id="users_id" required="" readonly>
                              <option class="opt" id="uid"></option> 
                            </select>
                          </div>
                        </div>
                        <div class="form-group" hidden="">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                Sup ID:
                                </span>
                              </div>
                              <select class="form-control show-tick" name="sup_id" id="sup_id" required="" readonly>
                                <option class="opt"><?php echo $_SESSION['user_id']['register_user_id']; ?> </option> 
                              </select>
                          </div>
                        </div>
              <div class="form-group">
                <label class="bmd-label-floating">Message</label>
                <textarea class="form-control" rows="5" name="rep_concern" id="rep_concern"  minlength="5" autofocus="" required=""></textarea>
              </div> 
              <div class="form">  
                <label class="bmd-label-floating">Image</label>
                <input type="file" name="rep_image" id="rep_image" required="" class="btn btn-default col-md-12">  
              </div> 
            </div> 
          </div>
          <button type="submit" name="reply" class="btn btn-success pull-right btn-round"><i class="fa fa-send"></i> Send</button>
          <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><i class="fa fa-times"></i> Close</button> 
        </form>
        </div>
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