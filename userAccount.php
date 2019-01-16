  <?php 
 include('php/database_connection.php');
  include('php/functions.php');

if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
}
 
include 'php/fetch_data.php';
?> 
  <html>
    <title> CITS </title>
    <head> 
       
      <link rel="stylesheet" href="css/font-awesome.css">
      <link rel="icon" href="img/logo.png" type="image/x-icon"> 
      <link type="text/css" rel="stylesheet" href="css/material-kit.min.css"  media="screen,projection"/>         
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
      <link rel="stylesheet" type="text/css" href="css/settings.css">
      <style type="text/css">
        #imageUpload
{
    display: none;
}

#profileImage
{
    cursor: pointer;
}

#profile-container {
    width: 150px;
    height: 150px;
    overflow: hidden;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
}

#profile-container img {
    width: 150px;
    height: 150px;
}
      </style>
    </head>
    <body>

          <nav class="navbar navbar-inverse navbar-expand-lg bg-white" role="navigation-demo">
            <div class="container-fluid"> 
              <div class="navbar-translate">
                <a class="navbar-brand" href="user.php"><img src="img/logocits.png" class="navbar-icon" style="width: 60%;"></img></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="navbar-toggler-icon"></span>
                  <span class="navbar-toggler-icon"></span>
                  <span class="navbar-toggler-icon"></span> 
                </button>
              </div> 
              <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                  <li class="dropdown nav-item">
                    <a href="#" data-toggle="dropdown">
                      <button class="btn btn-warning btn-fab btn-raised btn-round" id="seenReply"> <i class="fa fa-bell"></i></button>
                      <span id="countNotiReply"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right"> 
                      <table>
                        <tbody id="fetchNotiReply">
                          
                        </tbody>
                      </table>
                    </div>
                  </li>
                  <li class="dropdown nav-item">
                    <a href="#" class="profile-photo dropdown-toggle nav-link" data-toggle="dropdown">
                      <div class="profile-photo-small">
                        <?php
                              if ($row['user_image'] == "") {
                                echo "<img src='img/avatar.jpg'  class='rounded-circle img-fluid'>";
                              }
                              else {
                                  echo "<img src='data: image/jpeg;base64,".base64_encode($row['user_image'])."'  class='rounded-circle img-fluid'>";  
                                } 
                              ?>
                      </div> 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right"> 
                      <div class="dropdown-header">
                        <div class="profile-photo-small">
                          <?php
                              if ($row['user_image'] == "") {
                                echo "<img src='img/avatar.jpg'  class='rounded-circle img-fluid'>";
                              }
                              else {
                                  echo "<img src='data: image/jpeg;base64,".base64_encode($row['user_image'])."'  class='rounded-circle img-fluid'>";  
                                } 
                              ?>
                        
                        </div>
                        <div class="text-center"> 
                        <?php echo $_SESSION['user_id']['f_name']; ?> 
                        </div>
                      </div>
                      <a href="userAccount.php" class="dropdown-item"> <button class="btn btn-info btn-fab btn-round"><i class="fa fa-cog"></i></button>  ACCOUNT</a> 
                      <a href="php/logout.php" class="dropdown-item">  <button class="btn btn-warning btn-fab btn-round"><i class="fa fa-sign-out"></i></button> LOG OUT</a>
                    </div>
                  </li>
                       <li>
                         <?php echo $_SESSION['user_id']['user_name']; ?>
                       </li>
                </ul>
              </div> 
            </div> 
          </nav> 
          
            <div class="content" style="overflow-x: hidden;"> 
              <div class="container-fluid">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header card-header-danger text-center">
                       <i class="fa fa-cogs"></i> 
                      ACCOUNT SETTINGS
                    </div>
                    <br> 
                    <div class="card-body">  
                      <div class="row">
                        <div class="col-md-4">
                          <div class="card card-profile">
                            <div class="card-avatar">
                              <?php
                              if ($row['user_image'] == "") {
                                echo "<img src='img/avatar.jpg'  class='rounded-circle img-fluid'>";
                              }
                              else {
                                  echo "<img src='data: image/jpeg;base64,".base64_encode($row['user_image'])."'>";  
                                } 
                              ?>
                            </div>
                            <div class="card-body">   
                              <h4 class="card-title"><?php echo $row['user_email']; ?></h4>
                              <p class="card-description">
                                Account ID: <label class="text-dark"> <?php echo $row['register_user_id']; ?>  </label> <br>
                                First Name: <label class="text-dark"> <?php echo $row['f_name']; ?>  </label> <br>
                                Middle Name: <label class="text-dark"> <?php echo $row['m_name']; ?>  </label> <br>
                                Last Name: <label class="text-dark"> <?php echo $row['l_name']; ?>  </label> <br>
                                Username: <label class="text-dark"> <?php echo $row['user_name']; ?>  </label> <br> 
                                Contact No.: <label class="text-dark"> <?php echo $row['contact_number']; ?>  </label> <br>
                              </p> 
                            </div> 
                          </div> 
                        </div> 
                        <div class="col-md-8">
                          <div class="card"> 
                            <div class="card-body">
                              <div class="text-center">
                                <button class="btn btn-danger btn-link" data-toggle="modal" data-target="#updateInfoModal"> CHANGE  PERSONAL INFORMATION <br> <small> update your First Name, Usernam.....</small></button>
                                <br>
                                <button class="btn btn-danger btn-link"  data-toggle="modal" data-target="#changePassword"> CHANGE  PASSWORD <br> <small> update your password, secu.....</small></button>
                              </div>
                            </div>
                          </div> 
                          <a href="user.php" class="btn btn-danger pull-right btn-round" style="margin-top: 150px;"><i class="fa fa-mail-reply"></i>  Back</a>
                          <?php echo $prof; ?>
                          <?php echo $irror ?>
                        </div>
                      </div> 
                    </div> 
                  </div>
                </div>
              </div>
            </div>  


  <div class="modal fade" id="changePassword" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white"><i class="fa fa-lock"></i> Change Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="userAccount.php?id=<?php echo $_SESSION['user_id']['register_user_id']; ?>">
          <div class="text-center">
            <span id="availabilities"></span>
          </div>  
          <br> 
          <div class="form-group">
            <label for="exampleInput1" class="bmd-label-floating">Current Password</label>
            <input type="password" class="form-control" id="users_password" name="users_password" data-id="<?php echo $_SESSION['user_id']['register_user_id']; ?>" required> 
          </div>
          <div class="form-group">
            <label for="exampleInput1" class="bmd-label-floating">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" minlength="6" maxlength="20" required> 
          </div>
          <div class="form-group">
            <label for="exampleInput1" class="bmd-label-floating">Retype Password</label>
            <input type="password" class="form-control" id="con_password" name="con_password" minlength="6" maxlength="20" required> 
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success btn-round pull-right" name="changePass" id="changePass" data-id="<?php echo $_SESSION['user_id']['register_user_id']; ?>" disabled><i class="fa fa-save"></i> Save</button>
          <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          </form>
        </div>
      </div>
    </div>
  </div> 

 
 

<div class="modal fade" id="updateInfoModal" tabindex="-1" role="dialog" style="margin-top: -9%;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white">Update Information <i class="fa fa-info-circle"></i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times"></i>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="userAccount.php?id=<?php echo $_SESSION['user_id']['register_user_id']; ?>" onsubmit="return passReq()" enctype="multipart/form-data">
          <div class="form-group">
            <label>Select your Profile Picture</label>
            <div id="profile-container">
            <img id="profileImage" src="img/avatar.jpg" alt="Circle Image" class="rounded-circle img-fluid"/>
          </div>
            <input type="file" name="image" id="imageUpload" placeholder="Photo" required="" capture>
          </div>
          <div class="form-group">
            <label for="exampleInput1" class="bmd-label-floating">First Name</label>
            <input type="text" class="form-control" id="f_name" name="f_name" value="<?php echo $row['f_name']; ?>" pattern="[a-zA-Z ]+" minlength="2" maxlength="20" required> 
          </div>
          <div class="form-group">
            <label for="exampleInput1" class="bmd-label-floating">Middle Name</label>
            <input type="text" class="form-control" id="m_name" name="m_name" value="<?php echo $row['m_name']; ?>" pattern="[a-zA-Z ]+" minlength="2" maxlength="20" required> 
          </div> 
          <div class="form-group">
            <label for="exampleInput1" class="bmd-label-floating">Last Name</label>
            <input type="text" class="form-control" id="l_name" name="l_name" value="<?php echo $row['l_name']; ?>" pattern="[a-zA-Z ]+" minlength="2" maxlength="20" required> 
          </div> 
          <div class="form-group">
            <label for="exampleInput1" class="bmd-label-floating">Username</label>
            <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $row['user_name']; ?>" minlength="5" maxlength="20" required> 
          </div> 
          <div class="form-group">
            <label for="exampleInput1" class="bmd-label-floating">G-mail</label>
            <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $row['user_email']; ?>" readonly> 
          </div> 
          <div class="form-group">
            <label for="exampleInput1" class="bmd-label-floating">Contact Number</label>
            <input type="number" class="form-control" id="contact_number" name="contact_number" value="<?php echo $row['contact_number']; ?>" readonly> 
          </div> 
          <div class="text-center">
            <span id="availability"></span>
          </div> 
          <div class="form-group"> 
            <label for="exampleInput1" class="bmd-label-floating text-warning">To save changes, Enter you password.</label>
            <input type="password" class="form-control"  name="user_password" id="user_password" data-id="<?php echo $_SESSION['user_id']['register_user_id']; ?>">
            <span class="bmd text-danger" id="errorPwd"></span>
          </div> 
        </div> 
        <div class="card-footer">  
          <button type="submit" class="btn btn-success pull-right btn-round" name="updateAccount"  id="updateAccount" data-id="<?php echo $_SESSION['user_id']['register_user_id']; ?>" disabled><i class="fa fa-save"></i> Save</button>
          <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
        </form>
      </div>
    </div>
  </div> 





      <script src="js/main/jquery.min.js" type="text/javascript"></script>
      <script src="js/main/popper.min.js" type="text/javascript"></script>
      <script src="js/main/bootstrap-material-design.min.js" type="text/javascript"></script>
      <script src="js/material-kit.js?v=2.0.4" type="text/javascript"></script>
      <script src="js/function.js" type="text/javascript"></script>
      <script src="js/script.js" type="text/javascript"></script>

      <script>  
 $(document).ready(function(){  
  // check if passs exist
     $('#user_password').blur(function(){

       var user_password = $(this).val();

       $.ajax({
        url:'php/checkPassword.php',
        method:"POST",
        data:{user_password:user_password},
        success:function(data)
        {
         if(data == 0)
         {
          $('#availability').html('<br> <span class="alert alert-danger"> Wrong Password </span> <br>');
          $('#updateAccount').attr("disabled", true);
         }
         else
         {
          $('#availability').html('<br> <span class="alert alert-success"> Password Correct</span> <br>');
          $('#updateAccount').attr("disabled", false);
         }
        }
       }) 
    }); 

     // check if passs change pass
     $('#users_password').blur(function(){

       var users_password = $(this).val();

       $.ajax({
        url:'php/checkChangePass.php',
        method:"POST",
        data:{users_password:users_password},
        success:function(data)
        {
         if(data == 0)
         {
          $('#availabilities').html('<br> <span class="alert alert-danger"> Wrong Password </span> <br>');
          $('#changePass').attr("disabled", true);
         }
         else
         {
          $('#availabilities').html('<br> <span class="alert alert-success"> Password Correct</span> <br>');
          $('#changePass').attr("disabled", false);
         }
        }
       }) 
    }); 


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

 });  
</script>
    </body>
  </html>