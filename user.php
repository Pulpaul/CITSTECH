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
                      <i class="fa fa-home"></i> HOME
                    </div>
                    <div class="card-body">
                      <div class="input-group has-danger">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <button class="btn btn-danger btn-fab btn-sm btn-round"><i class="fa fa-search"></i></button>
                          </span>
                        </div>
                        <input type="text" id="myInput" onkeyup="Search()" class="form-control" placeholder="Search for a concern.....">
                      </div> <br> 
                      <div class="alert text-center" style="background-color: #EEE;">Here are Recent Concerns that may give you ideas. You can search question, click on the search bar.</div>
                      <table  id="myTable" class="table table-hover">
                        <?php
                        include 'php/connection.php';

                        $empty = "";

                        $sql = "SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE status = 'Replied' ";
                        $result = mysqli_query($conn,$sql);

                        if (mysqli_num_rows($result) == 0) {
                           $empty = "<div style='background: #EEE;' class='text-center'> Empty Transactions </div>";
                         } 
                        else {
                          while ($row = mysqli_fetch_assoc($result)) { 

                        ?>
                        <tbody>
                          <tr>
                            <td>
                              <a href="forum.php?id=<?php echo $row["id"]; ?>">
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group text-left" style="margin-left: 50px;">
                                    <?php
                                    $conc_id = $row['id'];
                                    $asd = "SELECT comment FROM feedback WHERE conc_id = '$conc_id' AND comment != '0' AND status = 'Comment' ";
                                    $ddd = mysqli_query($conn,$asd);
                                    $fet = mysqli_num_rows($ddd);

                                    if (empty($fet)) {
                                      echo "0";
                                    }
                                    else {
                                      echo $fet;
                                    } 
                                    ?> 
                                    <p><i class="fa fa-comment"></i></p>
                                    <div class="form-group text-center" style="margin-top: -45px;">
                                    <?php
                                    $conc_id = $row['id'];
                                    $sql1 = "SELECT rate FROM feedback WHERE conc_id = '$conc_id' AND rate != 0 ";
                                    $resultss = mysqli_query($conn,$sql1);
                                    $rows1 = mysqli_num_rows($resultss);

                                    if ($rows1 == 0) {
                                      echo "0";
                                    }
                                    else {
                                      echo $rows1;
                                    } 
                                    ?> 
                                    <p><i class="fa fa-thumbs-up"></i></p>
                                  </div>
                                  </div> 
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group text-center"> 
                                    <?php echo $row["question"]; ?>
                                    <p><label class="badge badge-pill badge-default"><?php echo $row["type"]; ?></label></p>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group pull-right">
                                    <?php echo $row["time_sent"]; ?>
                                  </div> 
                                </div>
                              </div>
                              </a>
                            </td>
                          </tr>
                        </tbody>
                        <?php } } ?>
                      </table>
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

    </body>
  </html>