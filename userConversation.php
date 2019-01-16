  <?php 
 include('php/database_connection.php');
 include('php/connection.php');

$id = $_GET['id'];

if(!isset($_SESSION["user_id"]))
{
  header("location: php/logout.php");
}
else {
  $sqls = "UPDATE chat SET status = 'Seen' WHERE from_id = '$id' ";
  mysqli_query($conn,$sqls);
}

$sql = mysqli_query($conn,"SELECT * FROM register_user WHERE register_user_id = '$id' ");
$row = mysqli_fetch_array($sql);
?> 
  <html>
    <title> CITS </title>
    <head>
      <link rel="icon" href="img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="css/font-awesome.css">
       
      <link type="text/css" rel="stylesheet" href="css/material-kit.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/> 
       
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>

          <nav class="navbar navbar-inverse navbar-expand-lg bg-white" role="navigation-demo">
            <div class="container-fluid"> 
              <div class="navbar-translate">
                <div class="navbar-brand" href="user.php"><img src="img/logocits.png" class="navbar-icon" style="width: 60%;"></img></div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="navbar-toggler-icon"></span>
                  <span class="navbar-toggler-icon"></span>
                  <span class="navbar-toggler-icon"></span> 
                </button> 
              </div> 
              <div class="collapse navbar-collapse">  
                <ul class="navbar-nav ml-auto"> 
                  <li class="nav-item active">
                    <a href="user.php" class="nav-link"> 
                      <i class="fa fa-stack-exchange"></i>FORUM 
                    </a>
                  </li>
                  <li class="nav-item active">
                    <a href="liveChat.php" class="nav-link"> 
                      <i class="fa fa-comments"></i>CHAT <span id="countNotiChatUser">
                    </a>
                  </li>
                  <li class="nav-item"> 
                    <a href="chatbot.php" class="nav-link "> 
                      <i class="fa fa-android"></i>CITSBOT 
                    </a>
                  </li>
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
                                  echo "<img src='data: image/jpeg/;base64,".base64_encode($_SESSION['user_id']['user_image'])."' class='rounded-circle img-fluid'>";   
                              ?>
                      </div> 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right"> 
                      <div class="dropdown-header">
                        <div class="profile-photo-small">
                        <?php 
                                  echo "<img src='data: image/jpeg;base64,".base64_encode($_SESSION['user_id']['user_image'])."' class='rounded-circle img-fluid'>";   
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
          
            <div class="container-fluid" style="overflow-x: hidden;"> 
              <div class="row">
                <div class="col-md-3">
                  <div class="card">
                    <div class="card-header card-header-danger text-center">
                      TAB
                    </div>
                    <div class="card-body"> 
                      <div class="text-center">
                        <a href="createConcern.php">
                      <button class="btn btn-danger btn-round"> <i class="fa fa-edit"></i> CREATE CONCERN</button>
                        </a>
                      </div> 
                      <table class="table table-hover">
                        <tbody>
                          <br />
                          <tr>
                            <td><a href="inbox.php"><label class="btn btn-info btn-round btn-fab btn-sm"> <i class="fa fa-inbox"></i> </label> Inbox</a></td> 
                            <td><label id="countReply2"></label></td>
                          </tr>
                          <tr>
                            
                            <td><a href="outbox.php"><label class="btn btn-primary btn-round btn-fab btn-sm"> <i class="fa fa-envelope-open"></i></label> Outbox</a></td> 
                            <td><?php
              
                            $id = $_SESSION['user_id']["register_user_id"];

                            $pdoQuery = "SELECT * FROM tblconcern WHERE user_id = '$id' AND status != 'Trashed' AND status != 'Drafted' AND state = 'Seen'  ";

                            $pdoResult = $connect->query($pdoQuery);

                            $pdoRowCount = $pdoResult->rowCount();

                            if ($pdoRowCount <= 0) {
                              echo " ";
                            } else {
                            echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
                            } 
                            ?></td>
                            
                          </tr>
                          <tr>
                            <td><a href="drafts.php"><label class="btn btn-rose btn-round btn-fab btn-sm"> <i class="fa fa-file-text"></i></label> Drafts</a></td> 
                            <td><?php
              
                            $id = $_SESSION['user_id']["register_user_id"];

                            $pdoQuery = "SELECT * FROM tblconcern WHERE user_id = '$id' AND status = 'Drafted' AND status = 'Seen' ";

                            $pdoResult = $connect->query($pdoQuery);

                            $pdoRowCount = $pdoResult->rowCount();

                            if ($pdoRowCount <= 0) {
                              echo " ";
                            } else {
                            echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
                            }  
                            ?></td>
                          </tr>
                          <tr>
                            <td><a href="trashUser.php"><label class="btn btn-warning btn-round btn-fab btn-sm"><i class="fa fa-archive"></i></label> Trash</a></td>
                            <td><?php
              
                            $id = $_SESSION['user_id']["register_user_id"];

                            $pdoQuery = "SELECT * FROM tblreply WHERE users_id='$id' AND status = 'Trashed' AND status = 'Seen' ";

                            $pdoResult = $connect->query($pdoQuery);

                            $pdoRowCount = $pdoResult->rowCount();

                            if ($pdoRowCount <= 0) {
                              echo " ";
                            } else {
                            echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
                            } 
                            ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div> 
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header card-header-danger text-center">  
                      <i class="fa fa-users"></i> <?php echo $row['user_email']; ?>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="alert" style="background-color: #EEE;">Available Support</div> 
                          <table class="table table-hover">
                            <tbody id="userStatus">
                              
                            </tbody>
                          </table>
                        </div> 
                        <div class="col-md-8">
                          <div class="alert" style="background-color: #EEE;"> 
                            <?php echo $row['user_name'];
                            if ($row['user_status'] == 'Inactive') {
                              echo " <i class='fa fa-dot-circle-o text-danger'></i> is Offline";
                            }
                            else {
                              echo " <i class='fa fa-dot-circle-o text-success'></i> Active now";
                            }
                            ?> 
                          </div> 
                          <div class="card">
                            <div class="card-body" style="overflow-y: scroll; width:100%; height:40%;"  id="fetchChatUser">
                            </div>
                            <div class="container">
                              <div class="input-group has-success" id="formInput"> 
                                <input type="text" class="form-control" value="<?php echo $_SESSION['user_id']['register_user_id'] ?>" id="from_id" hidden="">
                                <input type="text" class="form-control" value="<?php echo $_GET['id']; ?>" id="to_id" hidden="">
                                <input type="text" class="form-control" placeholder="Type a message" id="message" required="" minlength="1">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <button class="btn btn-success btn-fab btn-round" id="sendUserChat"><i class="fa fa-send"></i></button>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="card-footer">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>   

      <script src="js/main/jquery.min.js" type="text/javascript"></script>
      <script src="js/main/popper.min.js" type="text/javascript"></script>
      <script src="js/main/bootstrap-material-design.min.js" type="text/javascript"></script>
      <script src="js/material-kit.js?v=2.0.4" type="text/javascript"></script>
      <script src="js/function.js" type="text/javascript"></script>
      <script src="js/script.js" type="text/javascript"></script>
      <script src="js/script2.js" type="text/javascript"></script>
      <script type="text/javascript">
        $(document).ready(function(){  
          // fetch chat users
          setInterval(function(){ 
              $('#fetchChatUser').load('php/fetchChatUser.php?id=<?php echo $_GET['id']; ?>')
            }, 2000 );

        // send message chat user
          $("#sendUserChat").click(function(){
          var from_id = $("#from_id").val(); 
          var to_id = $("#to_id").val();  
          var message = $("#message").val(); 

          if (message == "" || message == " ") { 
            } else {
              $.ajax({
                url: "php/sendUserChat.php",
                    type: "POST",
                    data: {
                      from_id: from_id,
                      to_id: to_id,
                      message: message
                    },
                    dataType: "json",
                    success: function(data)
                    {
                  if (data == "Added.") { 
                    document.getElementById('message').value = '';
                  } else { 
                  }
                    }
              });
            }
          });

          
      });
      </script>
    </body>
  </html>