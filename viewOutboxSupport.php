  <?php 
 include('php/database_connection.php');

if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
} 
?>  
  <html>  
    <title> SUPPORT </title>
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
                <div class="navbar-brand" href=""><img src="img/logocits.png" class="navbar-icon" style="width: 60%;"></img></div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="navbar-toggler-icon"></span>
                  <span class="navbar-toggler-icon"></span>
                  <span class="navbar-toggler-icon"></span> 
                </button>
              </div> 
              <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto"> 
                  <li class="nav-item">
                    <a href="chatSupport.php" class="nav-link">
                      <i class="fa fa-comments"></i>Chat 
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="forumSupport.php" class="nav-link"> 
                      <i class="fa fa-stack-exchange"></i>FORUM 
                    </a>
                  </li>
                  <li class="nav-item "> 
                    <a href="ticketingSupport.php" class="nav-link "> 
                      <i class="fa fa-ticket"></i>Ticket
                    </a>
                  </li>
                  <li class="nav-item "> 
                    <a href="InventorySupport.php" class="nav-link "> 
                      <i class="fa fa-cubes"></i>Inventory
                    </a>
                  </li>
                  <li class="dropdown nav-item">
                    <a href="#" data-toggle="dropdown">
                      <button class="btn btn-warning btn-fab btn-raised btn-round" id="seenConcern"> <i class="fa fa-bell"></i></button>
                      <span id="countNotiConcern"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right"> 
                      <table>
                        <tbody id="fetchNotiConcern">
                          
                        </tbody>
                      </table>
                      <div class="dropdown-footer text-center">
                        <a href="support.php">
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
                      <a href="#" class="dropdown-item"> <button class="btn btn-info btn-fab btn-round"><i class="fa fa-cog"></i></button>  ACCOUNT</a> 
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
          
            <div class="container-fluid"> 
              <div class="row">
                <div class="col-md-3">
                  <div class="card">
                    <div class="card-header card-header-danger text-center">
                      TAB
                    </div>
                    <div class="card-body">  
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <td><a href="support.php"><label class="btn btn-info btn-round btn-fab btn-sm"> <i class="fa fa-inbox"></i> </label> Inbox</a></td> 
                            <td id="countConcern1"></td>
                          </tr>
                          <tr class="activeness">
                            
                            <td><a href="supportOutbox.php"><label class="btn btn-primary btn-round btn-fab btn-sm"> <i class="fa fa-envelope-open"></i></label> Outbox</a></td> 
                            <td><?php

                        $id = $_SESSION['user_id']['register_user_id'];

                        $pdoQuery = "SELECT * FROM tblreply WHERE sup_id = '$id' AND status = 'Sent' AND status = 'Deleted' AND state = 'Seen' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        if ($pdoRowCount <= 0) {
                          echo " ";
                        } else {
                        echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
                        }  ?></td>
                            
                          </tr> 
                          <tr>
                            <td><a href="trashSupport.php"><label class="btn btn-warning btn-round btn-fab btn-sm"><i class="fa fa-archive"></i></label> Trash</a></td>
                            <td><?php
                        

                        $pdoQuery = "SELECT * FROM tblconcern WHERE status = 'Trashed' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        if ($pdoRowCount <= 0) {
                          echo " ";
                        } else {
                        echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
                        }  ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div> 
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header card-header-danger text-center">
                      <i class="fa fa-envelope-open"></i>
                      OUTBOX
                    </div>
                    <?php 
                    include 'php/connection.php';

                    $rep_id = $_GET['rep_id'];

                    $sql = "SELECT * FROM tblreply INNER JOIN register_user ON sup_id = register_user_id  WHERE rep_id = '$rep_id' ";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($result)) {
                      
                    ?>
                    <div class="card-body"> 
                      <div class="row">
                        <div class="col-md-10"> 
                          <br>
                          <h5><?php echo $row['user_email']; ?></h5>
                        </div>
                        <div class="col-md-2">
                          <br>
                          <h5><?php echo $row['date_reply']; ?></h5>
                          <h5><?php echo $row['time_reply']; ?></h5>                          
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <h3>Your Reply Message:</h3>
                          <div class="card">
                            <div class="container" style="padding: 20px 20px;"> 
                              <?php echo $row['rep_concern']; ?>                          
                              <br>
                              <br>
                              <?php 
                              if ($row['rep_image'] == "") {
                                echo "<div class='alert alert-warning text-center'> No Image Included </div>";
                              }
                              else {
                                echo "<img src='data: image/jpeg;base64,".base64_encode($row['rep_image'])."' class='img-raised rounded img-fluid' width='500'>";
                              } 
                              ?> 
                            </div> 
                          </div>
                        </div>
                      </div>
                      <div class="card" id="showConcern" style="display: none;">
                        <div class="container">
                            <?php 
                            $getsi = $row['concern_id'];

                            $sql2 = "SELECT * FROM tblconcern WHERE id = '$getsi' ";
                            $shri = mysqli_query($conn,$sql2);
                            $fetch = mysqli_fetch_assoc($shri);

                            ?>
                            <?php echo $fetch['type']; ?> <br> 
                            <?php echo $fetch['question']; ?> <br> 
                            <?php echo $fetch['concern']; ?> <br>
                            <?php 
                            if ($fetch['image'] == "") {
                              echo "<div class='alert alert-warning text-center'> No Image Included </div>";
                            }
                            else {
                              echo "<img src='data: image/jpeg;base64,".base64_encode($fetch['image'])."' class='img-raised rounded img-fluid' width='500'>";
                            } 
                          ?> <br>
                        </div> 
                    </div>
                    </div> 
                  <?php } ?>
                    <div class="footer" style="padding: 20px;">
                      <div class="float-left">
                      <a href="supportOutbox.php" class="btn btn-danger btn-round"><i class="fa fa-mail-reply"></i> Back </a>  
                      </div>
                      <div class="float-right">
                        <button class="btn btn-primary btn-round"  id="btnShowConcern"><i class="fa fa-envelope-open"></i> Show Concern </button>  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>  

            <div id="myModal" class="modal">
            <span class="close">×</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
          </div>

      <script type="text/javascript" src="plugins/sweetalert/sweetalert.min.js"></script>
      <script type="text/javascript" src="plugins/sweetalert/dialogs.js"></script> 
      <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
      <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>   
      <script src="assets/js/plugins/bootstrap-notify.js"></script> 
      <script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>   
      <script src="js/function.js" type="text/javascript"></script>       
      <script src="js/script.js" type="text/javascript"></script>  
    </body>
  </html>