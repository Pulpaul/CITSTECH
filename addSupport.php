<?php  
include('php/database_connection.php');

if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
}

$f_name = '';
$m_name = '';
$l_name = '';
$contact_number = '';
$user_name = '';
$email = '';
$success = '';

if(isset($_POST["register"]))
{
    $query = "
    SELECT * FROM register_user 
    WHERE user_email = :user_email
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':user_email'   =>  $_POST['user_email']
        )
    );
    $no_of_row = $statement->rowCount();
    if($no_of_row > 0)
    {
        $email = '<label class="alert alert-danger pull-center">Email Already Exist</label>';
    }
    else
    {
        $user_password = rand(100000,999999);
        $user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
        $user_activation_code = md5(rand());
        $insert_query = "INSERT INTO register_user 
        (user_type,f_name,m_name,l_name,contact_number,user_name, user_email, user_password, user_activation_code, user_email_status) 
        VALUES (:user_type, :f_name, :m_name, :l_name,:contact_number,  :user_name, :user_email, :user_password, :user_activation_code, :user_email_status)";
        $statement = $connect->prepare($insert_query);
        $statement->execute(
            array(
                ':user_type'            =>  'SUPPORT',
                ':f_name'           =>  $_POST['f_name'],
                ':m_name'           =>  $_POST['m_name'],
                ':l_name'           =>  $_POST['l_name'],
                ':contact_number'           =>  $_POST['contact_number'],
                ':user_name'            =>  $_POST['user_name'],
                ':user_email'           =>  $_POST['user_email'],
                ':user_password'        =>  $user_encrypted_password,
                ':user_activation_code' =>  $user_activation_code,
                ':user_email_status'    =>  'not verified'
            )
        );
        $result = $statement->fetchAll();
        if(isset($result))
        {
            $base_url = "http://localhost/Thesis/";   
            $mail_body = "
            <p>Hi ".$_POST['user_name'].",</p>
            <p>Thanks for Registration. Your password is ".$user_password.", You can change your password later.</p>
            <p>Please Open this link to verified your email address - ".$base_url."email_verification.php?activation_code=".$user_activation_code."
            <p>Best Regards,<br />Competitive I.T Solutions Inc. Technical Support System</p>
            ";
            require 'phpmailer/PHPMailerAutoload.php';
            $mail = new PHPMailer(true);

            $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true));
            $mail->IsSMTP();                                 
            $mail->Host = 'smtp.gmail.com';      
            $mail->Port = '587';                                 
            $mail->SMTPAuth = true;
            $mail->Username = 'delapenapaulandrei12@gmail.com';      
            $mail->Password = 'luapyerd';                    
            $mail->SMTPSecure = 'tls';                    
            $mail->From = 'delapenapaulandrei12@gmail.com';       
            $mail->FromName = 'CITS Email Verification';          
            $mail->AddAddress($_POST['user_email'], $_POST['user_name']);   
            $mail->WordWrap = 50;                      
            $mail->IsHTML(true);                         
            $mail->Subject = 'Email Verification';         
            $mail->Body = $mail_body;                        
            if($mail->Send())                              
            {
                $success = '<label class="alert alert-success pull-center">Register Done! Please check your G-mail to confirm your account.</label>';
            }
        }
    }
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
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="fa fa-area-chart"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="fa fa-envelope"></i>
              <p>Concern</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="fa fa-ticket"></i>
              <p>Tickets</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="fa fa-cubes"></i>
              <p>Inventory</p>
            </a>
          </li>
          <li class="nav-item active  ">
            <a class="nav-link" href="supportAccount.php">
              <i class="fa fa-users"></i>
              <p>Support</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
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
                  <i class="fa fa-bell btn btn-danger btn-round btn-fab"></i>
                  <span class="notification">2</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <div class="dropdown-header">
                        <label>You have 2 Notification</label>
                      </div>
                      <a href="#" class="dropdown-item"> <button class="btn btn-info btn-fab btn-round"> <i class="fa fa-envelope"></i></button>  A support has replied to your concern.
                      </a> 
                      <a href="#" class="dropdown-item"> <button class="btn btn-warning btn-fab btn-round"> <i class="fa fa-android"></i></button>  CITS Bot Message you.
                      </a> 
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
          <div class="card">
            <div class="card-header card-header-danger text-center">
              <div class="card-title "><i class="fa fa-user-plus"></i> ADD SUPPORT</div>
            </div>
            <div class="card-body">
              <form action="" method="post"> 
                                          <?php echo $success; ?>
                                          <br>
                                          <form method="post" action="addaccounts.php" onsubmit="return validation()">
                                          
                                        <div class="form-group">
                                        <label>First name</label> <?php echo $f_name; ?>
                                        <input type="text" name="f_name" pattern="[a-zA-Z ]+" class="form-control" minlength="2" maxlength="20" required autofocus>
                                        </div>
                                        <div class="form-group">
                                        <label>Middle name</label> <?php echo $m_name; ?>
                                        <input type="text" name="m_name" pattern="[a-zA-Z ]+" class="form-control" minlength="2" maxlength="20"  required>
                                        </div>
                                        <div class="form-group">
                                        <label>Last name</label> <?php echo $l_name; ?>
                                        <input type="text" name="l_name" pattern="[a-zA-Z ]+" class="form-control" minlength="2" maxlength="20" required>
                                        </div>
                                        <div class="form-group">
                                        <label>Contact Number</label> <?php echo $contact_number; ?>
                                        <input type="number" name="contact_number" maxlength="12" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                        <label>Username</label> <?php echo $user_name; ?>
                                        <input type="text" name="user_name" pattern="[a-zA-Z ]+" minlength="6" maxlength="20" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                        <label>Email Address</label> <?php echo $email; ?>
                                        <input type="email" name="user_email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                        <div class="alert alert-danger">
                                          <strong>Note!</strong> Your password will be send through email, You can change your password later.  
                                        </div> 
                                      <br> 
                                      <a href="supportAccount.php" class="btn btn-danger bg-red btn-round"><i class="fa fa-times-circle"></i> Cancel </a> 
                                       <button type="submit" name="register" id="register" class="btn btn-success bg-green btn-round" style="float: right"  ><i class="fa fa-registered"></i> Register</button>
                                      <br>
                                      </form>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer">
        <div class="container-fluid"> 
          <div class="copyright">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, Competitive I.T Solutions Inc.
          </div> 
        </div>
      </footer>
    </div>
  </div>
  
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>   
  <script src="assets/js/plugins/bootstrap-notify.js"></script> 
  <script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>  
  <script src="js/script.js" type="text/javascript"></script>
</body> 
</html>