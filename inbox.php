  <?php 
 include('php/database_connection.php'); 

if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
}
 include 'php/fetch_data.php'; 
?> 
  <html>
    <title> CITS </title>
    <head> 
      
      <link rel="icon" href="img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="css/font-awesome.css">
       
      <link type="text/css" rel="stylesheet" href="css/material-kit.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="plugins/sweetalert/sweetalert.css">
       
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
                  <li class="nav-item "> 
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
                              if ($row['user_image'] == "") {
                                echo "<img src='img/avatar.jpg' alt='Circle Image' class='rounded-circle img-fluid'>";
                              }
                              else {
                                  echo "<img src='data: image/jpeg;base64,".base64_encode($row['user_image'])."' alt='Circle Image' class='rounded-circle img-fluid'>";  
                                } 
                              ?>
                      </div> 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right"> 
                      <div class="dropdown-header">
                        <div class="profile-photo-small">
                        <?php
                              if ($row['user_image'] == "") {
                                echo "<img src='img/avatar.jpg' alt='Circle Image' class='rounded-circle img-fluid'>";
                              }
                              else {
                                  echo "<img src='data: image/jpeg;base64,".base64_encode($row['user_image'])."' alt='Circle Image' class='rounded-circle img-fluid'>";  
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
                          <tr class="activeness">
                            <td><a href="inbox.php"><label class="btn btn-info btn-round btn-fab btn-sm"> <i class="fa fa-inbox"></i> </label> Inbox</a></td> 
                            <td><label id="countReply2"></label></td>
                          </tr>
                          <tr> 
                            <td><a href="outbox.php"><label class="btn btn-primary btn-round btn-fab btn-sm"> <i class="fa fa-envelope-open"></i></label> Outbox</a></td> 
                            <td>  <?php
              
              $id = $_SESSION['user_id']["register_user_id"];

              $pdoQuery = "SELECT * FROM tblconcern WHERE user_id = '$id' AND status != 'Trashed' AND status != 'Drafted'  AND status !='Deleted' AND state = 'Seen' ";

              $pdoResult = $connect->query($pdoQuery);

              $pdoRowCount = $pdoResult->rowCount();

              if ($pdoRowCount <= 0) {
                echo " ";
              } else {
              echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
              }  
              ?> </td>
                            
                          </tr>
                          <tr>
                            <td><a href="drafts.php"><label class="btn btn-rose btn-round btn-fab btn-sm"> <i class="fa fa-file-text"></i></label> Drafts</a></td> 
                            <td> <?php 
                        $id = $_SESSION['user_id']["register_user_id"];

                        $pdoQuery = "SELECT * FROM tblconcern where user_id = $id AND status= 'Drafted' AND status = 'Seen' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        if ($pdoRowCount <= 0) {
                          echo " ";
                        } else {
                        echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
                        } 
                        ?> </td>
                          </tr>
                          <tr>
                            <td><a href="trashUser.php"><label class="btn btn-warning btn-round btn-fab btn-sm"><i class="fa fa-archive"></i></label> Trash</a></td>
                            <td> <?php 
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
                  <div class="card js-sweetalert">
                    <div class="card-header card-header-danger text-center">
                      <i class="fa fa-envelope"></i>
                      MESSAGE
                    </div>
                    <div class="card-body"> 
                      <div class="pull-left">
                        Total: <text id="countReply"></text> items in Inbox
                      </div>
                      <div class="pull-right"> 
                          <div class="input-group has-danger">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <button class="btn btn-danger btn-fab btn-sm btn-round"><i class="fa fa-search"></i></button>
                              </span>
                            </div>
                            <input type="text" id="myInput" onkeyup="Search()" class="form-control" placeholder="Search">
                          </div> 
                      </div>
                      <table id="myTable" class="table table-hover ">
                        <thead> 
                          <th>From</th>
                          <th>Message</th>
                          <th>Date</th>
                          <th class="text-center">Option</th>
                        </thead>
                        <tbody id="fetchReply">

                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
            </div>   

            

      <script type="text/javascript" src="plugins/sweetalert/sweetalert.min.js"></script>
      <script type="text/javascript" src="plugins/sweetalert/dialogs.js"></script> 
      <script src="js/main/jquery.min.js" type="text/javascript"></script>
      <script src="js/main/popper.min.js" type="text/javascript"></script>
      <script src="js/main/bootstrap-material-design.min.js" type="text/javascript"></script>
      <script src="js/material-kit.js?v=2.0.4" type="text/javascript"></script>
      <script src="js/function.js" type="text/javascript"></script>
      <script src="js/script.js" type="text/javascript"></script>
      <script src="js/script2.js" type="text/javascript"></script>
      
    </body>
  </html>