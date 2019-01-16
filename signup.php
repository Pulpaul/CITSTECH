<?php 
include('php/register.php'); 
?> 
<html>
<head>
    <title></title>
      <link rel="stylesheet" href="css/font-awesome.css">
      <link rel="icon" href="img/logo.png" type="image/x-icon"> 
      <link type="text/css" rel="stylesheet" href="css/material-kit.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
</head>
<body>
<div class="page-header header-filter" style="background-image: url('img/citsbg2.jpg'); background-size: cover; background-position: top center; height: 170vh;">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 ml-auto mr-auto">  <br> <br>
          <div class="card card-login">
            <form class="form" method="post" id="register_form" onsubmit="return passReq()" enctype="multipart/form-data">
              <div class="card-header card-header-danger text-center">
                <img src="img/logocits.png">
              </div>
              <h3 class="description text-center text-dark">SIGN UP <i class="fa fa-user-plus"></i></h3>
              <?php echo $success; ?>
              <div class="card-body">
                <div class="col-lg-12 col-sm-4">
                  <div class="form-group">
                    <div class="form-group">
                      <label>Select your Profile Picture</label>
                      <div id="profile-container">
                      <img id="profileImage" src="img/avatar.jpg" alt="Circle Image" class="rounded-circle img-fluid" width="100" />
                      </div>
                      <input type="file" name="image" id="imageUpload" placeholder="Photo" required="" capture>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 col-sm-4">
                  <div class="form-group">
                    <?php echo $f_name; ?>
                    <label class="bmd-label-floating">First Name</label>
                    <input type="text" name="f_name" pattern="[a-zA-Z ]+" class="form-control" maxlength="20" required>
                    <span class="form-control-feedback">
                  
                    </span>
                  </div>
                </div>
                <div class="col-lg-12 col-sm-4">
                  <div class="form-group">
                    <?php echo $m_name; ?>
                    <label class="bmd-label-floating">Middle Name</label>
                    <input type="text" name="l_name" pattern="[a-zA-Z ]+" class="form-control" maxlength="20" >
                    <span class="bmd-help">Note: Middle Name is optional.</span>
                  </div>
                </div>
                <div class="col-lg-12 col-sm-4">
                  <div class="form-group">
                    <?php echo $l_name; ?>
                    <label class="bmd-label-floating">Last Name</label>
                    <input type="text" name="m_name" pattern="[a-zA-Z ]+" class="form-control" maxlength="20" required>
                    <span class="form-control-feedback">
                  
                    </span>
                  </div>
                </div>
                <div class="col-lg-12 col-sm-4">
                  <div class="form-group">
                    <?php echo $contact_number; ?>
                    <label class="bmd-label-floating">Contact Number</label>
                    <input type="text" name="contact_number" minlength="3" maxlength="12" class="form-control" pattern="[0-9 ]+" required>
                    <span class="form-control-feedback">
                     
                    </span>
                  </div>
                </div>
                <div class="col-lg-12 col-sm-4">
                  <div class="form-group">
                    <?php echo $user_name; ?>
                    <label class="bmd-label-floating">Username</label>
                    <input type="text" name="user_name" pattern="[a-zA-Z ]+" maxlength="12" class="form-control" required>
                    <span class="form-control-feedback">
                      
                    </span>
                  </div>
                </div>
                <div class="col-lg-12 col-sm-4">
                  <div class="form-group">
                    <?php echo $email; ?>
                    <label class="bmd-label-floating">Email Address</label>
                    <input type="email" name="user_email" class="form-control" required>
                    <span class="form-control-feedback">
                      
                    </span>
                  </div>
                </div>
                <div class="col-md-12">
                  <label class="alert alert-danger"><strong> Note! </strong> Your password will be sent through email. You can change your password later. </label>
                </div>
                <div class="col-md-12">
                  <p>By creating an account you agree to our <a href="#" class="text text-warning">Terms & Privacy</a>.</p>
                </div>
              <div class="footer text-center">
                <div class="row">
                  <div class="col-md-6">
                    <a href="index.php" class="btn btn-danger btn-round"> <i class="fa fa-mail-reply"> </i> back</a>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" name="register" id="register" class="btn btn-success btn-round"> <i class="fa fa-check"> </i>   SIGN UP</button>
                  </div>
                  
                </div>
              </div>
              <br>
            </form>
          </div>
        </div>
      </div>
    </div>

      <script src="js/main/jquery.min.js" type="text/javascript"></script>
      <script src="js/main/popper.min.js" type="text/javascript"></script>
      <script src="js/main/bootstrap-material-design.min.js" type="text/javascript"></script>
      <script src="js/item/moment.min.js" type="text/javascript"></script>
      <script src="js/item/bootstrap-datetimepicker.js" type="text/javascript"></script>
      <script src="js/item/nouislider.min.js" type="text/javascript"></script>
      <script src="js/item/easing.min.js" type="text/javascript"></script>
      <script src="js/item/smoothscroll.js" type="text/javascript"></script>
      <script src="js/item/jquery.sharrre.js" type="text/javascript"></script>
      <script src="js/material-kit.js?v=2.0.4" type="text/javascript"></script>
      <script type="text/javascript">
        $("#profileImage").click(function(e) {
        $("#imageUpload").click();
        });

        function fasterPreview( uploader ) {
            if ( uploader.files && uploader.files[0] ){
                  $('#profileImage').attr('src', 
                     window.URL.createObjectURL(uploader.files[0]) ); 
            }
        }

        $("#imageUpload").change(function(){
            fasterPreview( this );
        });
      </script>
</body>
</html>