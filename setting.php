<?php 
  include('php/database_connection.php');
  include('php/functions.php'); 

  if(!isset($_SESSION["user_id"]))
  {
      header("location: php/logout.php");
  }

  include 'php/connection.php';

  $sql = mysqli_query($conn,"SELECT * FROM register_user");
  $row = mysqli_fetch_assoc($sql);
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
      </form> 
    </section>
  </aside>

  <div class="content-wrapper js-sweetalert">
    <div class="content">
      <div class="card text-center"> <br>
        <div class="card-header" style="font-size: 25px;"><i class="fa fa-cog"></i> SETTINGS</div> <br> 
          <button class="btn btn-danger btn-lg" id="resetOtp">
            Personal Information   <i class="fa fa-angle-right"></i>
            <br>
            <label class="text-sm"> Manage your Personal Information </label>
          </button> 
          <br>
          <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#formOTP">
            Reset One Time Password   <i class="fa fa-angle-right"></i> 
            <br>
            <label class="text-sm"> resets current otp </label>
          </button>
          <br>
          <br>
          <br>
          <div class="card-footer pull-right">
        <a href="webMaster.php" class="btn btn-danger bg-red"><i class="fa fa-mail-reply"></i> Back</a>
      </div>
    </div> 
    </div> 
  </div>

    <div class="modal fade js-sweetalert" id="formOTP">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> RESET OTP </h4>
              </div>
              <div class="modal-body"> 
                <span id="availability" style="margin-left: 40%;"></span> 
                <div class="form-group">
                  To Reset OTP, Enter your current OTP:
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span> 
                    <input type="password" name="user_password" id="user_password" class="form-control" data-id="<?php echo $_SESSION['user_id']['register_user_id']; ?>"> 
                  </div> 
                </div>
              </div>
              <div class="modal-footer"> 
                <button  type="button" name="resetOTP" class="btn btn-info bg-blue" id="resetOTP" data-id="<?php echo $_SESSION['user_id']['register_user_id']; ?>" disabled><i class="fa fa-exclamation-triangle"></i> Reset</button>
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

<script>  
 $(document).ready(function(){  
  // check if OTP exist
   $('#user_password').blur(function(){

     var user_password = $(this).val();

     $.ajax({
      url:'php/checkOTP.php',
      method:"POST",
      data:{user_password:user_password},
      success:function(data)
      {
       if(data == 0)
       {
        $('#availability').html('<span class="alert alert-danger"> Wrong Password </span>');
        $('#resetOTP').attr("disabled", true);
       }
       else
       {
        $('#availability').html('<span class="alert alert-success"> Password Correct</span>');
        $('#resetOTP').attr("disabled", false);
       }
      }
     }) 
  }); 

   // reset the otp
   $(document).on( "click", "#resetOTP", function(){
      var register_user_id = $(this).attr("data-id"); 

        swal({
            title: "Reset your One Time Password?",
            text: "Note: You cannot undo this process",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            setTimeout(function () {
                swal("Reseting OTP Successful","","success"); 
                window.location = "resetOTP.php";
                $.ajax({
                url: "php/removeOTP.php",
                type: "POST",
                data: { register_user_id: register_user_id },
                dataType: "json",
                success: function(data)
                {
                   
                }
          });
            }, 2000);  
        });
    });


 });  
</script>





</body>
</html>