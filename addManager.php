<?php 
  include('php/database_connection.php');

if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
}

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
    SELECT * FROM register_user WHERE user_email = :user_email
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':user_email'   =>  $_POST['user_email'],
            ':f_name'   =>  $_POST['f_name']
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
                ':user_type'            =>  'MANAGER',
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
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Web Master</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="css/font-awesome.css"> 
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
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
        <div class="box"> 
          <div class="box-header text-center"  style="font-size: 25px;">
            <br>
              <i class="fa fa-user-circle-o"></i> ADD MANAGER
          </div>
            <div class="box-body">
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
                                      <a href="webMaster.php" class="btn btn-danger bg-red btn-round"><i class="fa fa-times-circle"></i> Cancel </a> 
                                       <button type="submit" name="register" id="register" class="btn btn-success bg-green btn-round" style="float: right"  ><i class="fa fa-registered"></i> Register</button>
                                      <br>
                                      </form>
            </div> 
            <div class="box-footer">
              <a href="webMaster.php" class="btn btn-danger "></a>
            </div>
          </div> 
    </section> 
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