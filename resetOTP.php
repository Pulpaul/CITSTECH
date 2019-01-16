<?php 
  include('php/database_connection.php');
  include('php/functions.php'); 

  if(!isset($_SESSION["user_id"]))
  {
      header("location: php/logout.php");
  }
?>  
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Support</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">  
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css"> 
  <link rel="stylesheet" href="dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="dist/css/ripples.min.css">
  <link rel="stylesheet" href="dist/css/MaterialAdminLTE.min.css">  
  <link rel="stylesheet" href="dist/css/skins/all-md-skins.min.css">    
  <link type="text/css" rel="stylesheet" href="plugins/sweetalert/sweetalert.css">


 
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
      </form> 
    </section>
  </aside>

  <div class="content-wrapper js-sweetalert">
    <div class="content">
      <div class="box text-center"> <br>
        <div class="box-header">
          <h3><i class="fa fa-lock"></i>  ONE TIME PASSWORD</h3>
        </div>
        <div class="box-body">
          <form method="post" action="resetOTP.php">
          <?php echo $error ?>
          <div class="form-group">
            Enter a new One Time Password:
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
              <input type="password" class="form-control" name="user_password" maxlength="30"> 
            </div> 
          </div>
          <div class="form-group">
            Confirm One Time Password:
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
              <input type="password" class="form-control" name="con_user_password" maxlength="30"> 
            </div> 
          </div>
        </div>
        <div class="box-footer">
          <button class="btn btn-success bg-olive pull-right" name="resetOTP"><i class="fa fa-save"></i> SAVE</button>
          </form>
        </div>
      </div> 
    </div> 
  </div> 

<script src="bower_components/jquery/dist/jquery.min.js"></script> 
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script> 
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script> 
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script> 
<script src="dist/js/material.min.js"></script>
<script src="dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script> 
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script> 
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script> 
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> 
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script> 
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script> 
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> 
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> 
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> 
<script src="bower_components/fastclick/lib/fastclick.js"></script> 
<script src="dist/js/adminlte.min.js"></script> 
<script src="dist/js/pages/dashboard.js"></script> 
<script src="dist/js/demo.js"></script>
<script type="text/javascript" src="plugins/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="plugins/sweetalert/dialogs.js"></script> 
<script type="text/javascript" src="js/function.js"></script> 
<script type="text/javascript" src="js/script.js"></script> 





</body>
</html>