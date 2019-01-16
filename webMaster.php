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
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Web Master</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="css/font-awesome.css"> 
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">  
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="dist/css/ripples.min.css">
  <link rel="stylesheet" href="dist/css/MaterialAdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/all-md-skins.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="webMaster.php" class="logo">
      <span class="logo-mini">C<b>I</b>TS</span>
      <span class="logo-lg"><b><?php echo $_SESSION['user_id']['user_type']; ?></b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="img/logo.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['user_id']['user_name']; ?></span>
            </a>
            <ul class="dropdown-menu"> 
              <li class="user-header">
                <img src="img/logo.png" class="img-circle" alt="User Image"> 
                <p>
                  <?php echo $_SESSION['user_id']['user_name']; ?>
                </p>
                <?php echo $_SESSION['user_id']['user_email']; ?>
              </li>  
              <li class="user-footer">
                <div class="col-md-6">
                  <a href="setting.php" class="btn btn-default btn-flat">Account <i class="fa fa-cog"></i></a>
                </div>
                <div class="col-md-6">
                  <a href="php/logout.php" class="btn btn-default btn-flat">Sign out <i class="fa fa-sign-out"></i></a>
                </div>
              </li>
            </ul>
          </li> 
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/logo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['user_id']['user_name']; ?></p> 
          <?php echo $_SESSION['user_id']['user_email']; ?>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <ul class="sidebar-menu" data-widget="tree">  
        <li class="active">
          <a href="webMaster.php">
            <i class="fa fa-address-book" style="font-size: 20px"></i> <span>Accounts</span> 
          </a>
        </li> 
        <li>
          <a href="backupDatabase.php">
            <i class="fa fa-database" style="font-size: 20px"></i> <span>Database</span> 
          </a>
        </li> 
      </ul>
    </section>
  </aside>

<div class="content-wrapper"> 
 
    <section class="content">
        <div class="card"> 
          <div class="card-header text-center"  style="font-size: 25px;">
            <br>
              <i class="fa fa-user-circle-o"></i> ACCOUNTS
          </div>
            <div class="card-body">
              <div class="pull-right">
                <a href="addManager.php" class="btn btn-danger bg-maroon"><i class="fa fa-user-plus"></i> Add Manager</a>
              </div>
              <table id="concern" class="table table-hover">
                <thead>
                <tr>
                	<th>ID</th>
                	<th>First Name</th>
                	<th>Middle Name</th>
                	<th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact #</th>
                    <th>Account Type</th> 
                    <th>Option</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                include('php/connection.php');
                $query = mysqli_query($conn,"SELECT * FROM register_user WHERE user_type != 'WEB MASTER'");
                while($row = mysqli_fetch_array($query)){
                ?>
                <tr>
                  <td><?php echo $row['register_user_id']; ?></td>
                  <td><?php echo $row['f_name']; ?></td>
                  <td><?php echo $row['m_name']; ?></td>
                  <td><?php echo $row['l_name']; ?></td>
                  <td><?php echo $row['user_name']; ?></td>
                  <td><?php echo $row['user_email']; ?></td>
                  <td><?php echo $row['contact_number']; ?></td>
                  <td><?php echo $row['user_type']; ?></td> 
                  <td><a class="btn btn-social-icon btn-dropbox btn-sm" id="accDetails" data-id='"+data[i]['register_user_id']+"' data-toggle="modal" data-target="#accountDetails" data-toggle="tooltip" title="View"><i class="fa fa-info-circle"></i></a>
                    <button class="btn btn-social-icon btn-google btn-sm" data-toggle="tooltip" title="Disable Account"><i class="fa fa-user-times"></i></button></td>
                </tr>
                <?php } ?>
                </tbody> 
              </table>
            </div> 
          </div> 
    </section> 
   </div>

    <div class="modal modal-danger fade" id="accountDetails">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ACCOUNT DETAILS <i class="fa fa-info-circle"></i></h4>
              </div>
              <div class="modal-body">
                <b>User ID: </b> <span id="cen"></span>
                  <br/><br/>
                  <b>First Name: </b> <span id="pdg"></span>
                  <br/><br/>
                  <b>Middle Name: </b> <span id="pm"></span>
                  <br/><br/>
                  <b>Last Name: </b> <span id="mcr"></span>
                  <br/><br/>
                  <b>User Name: </b> <span id="cn"></span>
                  <br/><br/>
                  <b>G-mail Address: </b> <span id="pn"></span>
                  <br/><br/>
                  <b>Contact Number: </b> <span id="m"></span>
                  <br/><br/>
                  <b>Account Type: </b> <span id="s"></span>
              </div>
              <div class="modal-footer">
                <div class="container">
                  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> 
                </div> 
              </div>
            </div> 
          </div> 
        </div> 

  <footer class="main-footer>  
  <strong> <img src="img/logocits.png" style="width: 200px;"></strong>
  </footer>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/material.min.js"></script>
<script src="dist/js/ripples.min.js"></script>
<script src="dist/js/adminlte.min.js"></script> 
<script>
    $.material.init();
</script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>  
<script>
  $(function () {
    $('#concern').DataTable()
    $('#').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type="text/javascript" src="js/script.js"></script> 
</body>
</html>