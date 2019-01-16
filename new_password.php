<?php 
include 'php/connection.php';

$error = '';
$user_email = $_GET['email'];

if (isset($_POST['confirm'])) {
	$newPass = mysqli_escape_string($conn,$_POST['user_password']); 
	$conPass = mysqli_escape_string($conn,$_POST['con_user_password']); 

	if ( $conPass != $newPass) {
		$error = '<div class="alert alert-danger"> Password do not match </div>';
	}
	if ( empty($conPass) || empty($newPass)) {
		$error = '<div class="alert alert-danger"> All fields are required </div>';
	}
  if (strlen($newPass) <= 6) {
    $error = "<div class='alert alert-danger'> Password is too short </div>";
  }
	else{
		$user_encrypted_password = password_hash($conPass, PASSWORD_DEFAULT);

		$sql = "UPDATE register_user SET user_password = '$user_encrypted_password' WHERE user_email = '$user_email'  ";
		mysqli_query($conn,$sql);
		
		$error = '<div class="alert alert-success"> Successful! You can <a href="index.php">log in</a> now! </div>';
	}
}

?> 
<html>
<head>
    <title></title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="css/font-awesome.css">
       
      <link type="text/css" rel="stylesheet" href="css/material-kit.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
      <link rel="icon" href="img/logo.png" type="image/x-icon">

</head>
<body>

    <div class="page-header header-filter" style="background-image: url('img/citsbg2.jpg'); background-size: cover;" >
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 ml-auto mr-auto"> 
            <div class="card card-login"> 
              <div class="card-header card-header-danger text-center">
                <img src="img/logocits.png">
              </div>
              <h3 class="description text-center text-dark"> ENTER NEW PASSWORD</h3> 
              <div class="card-body">
                <form method="post" action="new_password.php?email=<?php echo $user_email ?>">
                  <div class="container">
                    <div class="text-center"><?php echo $error; ?></div>
                    <div class="input-group"> 
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-lock"></i>
                        </span>
                      </div>
                      <input type="password" class="form-control" placeholder="Enter new Password" name="user_password" > 
                    </div>
                    <div class="input-group"> 
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-lock"></i>
                        </span>
                      </div> 
                      <input type="password" class="form-control" placeholder="Confirm new Password" name="con_user_password" >
                    </div>
                    <br>
                    <div class="container"> 
                        <a href="index.php" class="btn btn-danger"><i class="fa fa-times"></i> Cancel </a> 
                        <button class="btn btn-success pull-right" name="confirm"><i class="fa fa-info"></i> Confirm </button>
                    </div>
                  </div>
                </form> 
              </div>
              <div class="card-footer"> 

              </div>
            </div>
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
</body>
</html>