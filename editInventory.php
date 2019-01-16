<?php 
  include('php/database_connection.php');
  include('php/functions.php');


if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
}  
 include('php/connection.php');
  $ids=$_GET['id'];
  $querys=mysqli_query($conn,"select * from `inventory` where id='$ids' ");
  $rows=mysqli_fetch_array($querys);
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
          <li class="nav-item">
            <a class="nav-link" href="concernManager.php">
              <i class="fa fa-envelope"></i>
              <p>Concern</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ticketing.php">
              <i class="fa fa-ticket"></i>
              <p>Tickets</p>
            </a>
          </li>
          <li class="nav-item active">
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
              <div class="card">
                <div class="card-header card-header-danger text-center">
                  <div class="card-title "><i class="fa fa-cubes"></i> INVENTORY </div>
                </div>
                <div class="card-body">
                  <div class="row">                  
                    <div class="table-responsive">
                    <br>
                    <table id="myTable" class="table table-hover">
                        <thead>  
                          <th>ID</th>
                          <th>Department</th>
                          <th>PC</th>
                          <th>System Unit</th> 
                          <th>Monitor</th> 
                          <th>Mouse</th> 
                          <th>Keyboard</th> 
                          <th>Printer</th>  
                          <th class="text-center">Option</th>
                        </thead>  
                        <tbody>
                          <form method="POST" action="php/updateInventory.php?id=<?php echo $rows['id']; ?>">
                          <tr>
                            <td><?php echo $rows['id']; ?></td>  
                            <td><input type="text" class="form-control"  value="<?php echo $rows['department']; ?>" name="department" required></td> 
                            <td><input type="text" class="form-control"  value="<?php echo $rows['pc_name']; ?>" name="pc_name" required></td>
                            <td><input type="text" class="form-control"  value="<?php echo $rows['system_unit']; ?>" name="system_unit" required></td>
                            <td><input type="text" class="form-control"  value="<?php echo $rows['monitor']; ?>" name="monitor" required></td> 
                            <td><input type="text" class="form-control"  value="<?php echo $rows['mouse']; ?>" name="mouse" required></td>
                            <td><input type="text" class="form-control"  value="<?php echo $rows['keyboard']; ?>" name="keyboard" required></td>
                            <td><input type="text" class="form-control"  value="<?php echo $rows['printer_name']; ?>" name="printer_name" required></td>
                            <td class="text-center">
                              <button type="submit" class="btn btn-success btn-round btn-fab btn-sm" rel="tooltip" title="Send"><i class="fa fa-send"></i></button>
                              <a href="inventory.php" class="btn btn-danger btn-fab btn-round btn-sm" rel="tooltip" title="Back"><i class="fa fa-mail-reply"></i></a>  
                            </td>  
                          </tr>
                          </form>
                        </tbody>   
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
          <div class="copyright">
            Competitive I.T Solutions Inc.
          </div> 
        </div>
      </footer>
    </div>
  

  <script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>   
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>   
  <script src="assets/js/plugins/bootstrap-notify.js"></script> 
  <script type="text/javascript" src="plugins/sweetalert/sweetalert.min.js"></script>
  <script type="text/javascript" src="plugins/sweetalert/dialogs.js"></script>  
  <script src="js/function.js" type="text/javascript"></script>
  <script src="js/script.js" type="text/javascript"></script>

</body> 
</html>