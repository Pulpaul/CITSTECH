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
                  <li class="nav-item active">
                    <a href="chatSupport.php" class="nav-link">
                      <i class="fa fa-comments"></i>Chat <span id="countNotiChatUser">
                    </a>
                  </li>
                  <li class="nav-item active">
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
                    <a href="inventorySupport.php" class="nav-link "> 
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
          
        <div class="container-fluid" style="overflow-x: hidden;"> 
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
                            <td id="countConcern1"> </td>
                          </tr>
                          <tr>
                            
                            <td><a href="supportOutbox.php"><label class="btn btn-primary btn-round btn-fab btn-sm"> <i class="fa fa-envelope-open"></i></label> Outbox</a></td> 
                            <td> <?php

                        $id = $_SESSION['user_id']['register_user_id'];


                        $pdoQuery = "SELECT * FROM tblreply  WHERE sup_id = '$id' AND status = 'Sent' AND status = 'Deleted' AND state = 'Seen' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        if ($pdoRowCount <= 0) {
                echo " ";
              } else {
              echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
              }  ?></td>
                            
                          </tr>
                          <tr class="activeness">
                            <td><a href="trashSupport.php"><label class="btn btn-warning btn-round btn-fab btn-sm"><i class="fa fa-archive"></i></label> Trash</a></td>
                            <td><?php

                        $pdoQuery = "SELECT * FROM tblconcern WHERE status = 'Trashed' AND state = 'Seen' ";

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
                  <div class="card js-sweetalert">
                    <div class="card-header card-header-danger text-center">
                      <i class="fa fa-archive"></i>
                      TRASH
                    </div>
                    <div class="card-body"> 
                      <div class="pull-left">
                        Total: <?php

                        $pdoQuery = "SELECT * FROM tblconcern WHERE status = 'Trashed' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        echo "$pdoRowCount"; ?>
                          Items in Trash
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
                      <table id="myTable" class="table table-hover">
                        <thead> 
                          <th>From</th>
                          <th>Message</th>
                          <th>image</th>
                          <th>Date</th>
                          <th class="text-center">Action</th>
                        </thead>
                         <tbody> 
                          <?php 
                          include('php/connection.php');

                          $blank = ""; 

                          $query = mysqli_query($conn,"SELECT * FROM tblconcern WHERE status = 'Trashed' ");
                          $row = mysqli_fetch_array($query);

                          if ($row == 0) {
                            $blank = "<div class='alert alert-default text-center' style='background: #EEE;'><label>Trash is Empty</label></div>";
                          }
                          else {
                            $query = mysqli_query($conn,"SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE status = 'Trashed'  ");
                            while($row = mysqli_fetch_array($query)){ 
                          
                          ?>
                          <tr>   
                            <td><?php echo $row['user_email']; ?></td>
                            <td><?php echo $row['concern']; ?></td>
                            <td><?php
                            if ($row['image'] == "") {
                                echo "N/A";
                              }
                              else {
                                  echo "<img src='data: image/jpeg;base64,".base64_encode($row['image'])."' class='img-raised rounded img-fluid' width='75'>";  
                                }  
                              ?></td> 
                            <td><?php echo $row['date_sent']; ?></td>
                            <td>
                              <button  class="btn btn-primary btn-fab btn-sm btn-round" data-toggle="tooltip" title="Restore" id="restoreConcern" data-id="<?php echo $row['id']; ?>"><i class="fa fa-undo"></i></button> 
                              <button  class="btn btn-warning btn-fab  btn-sm btn-round" data-toggle="tooltip" title="Delete" id="deleteConcern" data-id="<?php echo $row['id']; ?>"><i class="fa fa-archive"></i></button>
                            </td>
                          </tr>
                          <?php } } ?>
                        </tbody> 
                      </table>
                      <?php echo $blank; ?>
                    </div>
                  </div>
              </div>
            </div>   

      <script type="text/javascript" src="plugins/sweetalert/sweetalert.min.js"></script>
      <script type="text/javascript" src="plugins/sweetalert/dialogs.js"></script> 
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
      <script src="js/function.js" type="text/javascript"></script>
      <script src="js/script.js" type="text/javascript"></script>
      <script src="js/script2.js" type="text/javascript"></script>

    </body>
  </html>