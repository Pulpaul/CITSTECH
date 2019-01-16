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
      <link rel="stylesheet" href="css/font-awesome.css">
       <link rel="icon" href="img/logo.png" type="image/x-icon">
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
                            <td id="countConcern1"></td>
                          </tr>
                          <tr>
                            
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
                      <i class="fa fa-cubes"></i>
                      INVENTORY
                    </div>
                    <div class="card-body"> 
                     <div class="pull-left">
                        Total: <?php  

                        $pdoQuery = "SELECT * FROM inventory WHERE status != 'Trashed' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        echo "$pdoRowCount"; ?> item in Inventory
                      </div>
                      <div class="pull-right">  
                          <div class="input-group has-danger"> 
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <button class="kasmot btn btn-danger btn-fab btn-sm btn-round" style="cursor: default;"><i class="fa fa-search"></i></button>
                              </span>
                            </div>
                            <input type="text" id="myInput" onkeyup="Search()" class="form-control" placeholder="Search">
                          </div>
                      </div>
                    <table id="myTable" class="table table-hover">
                        <thead>   
                          <th>Department</th>
                          <th>PC</th>
                          <th>System Unit</th> 
                          <th>Monitor</th> 
                          <th>Mouse</th> 
                          <th>Keyboard</th> 
                          <th>Printer</th> 
                          <th class="text-center">Option</th>
                        </thead> 
                        <?php
                        include 'php/connection.php';

                        $empty = "";

                        $sql = mysqli_query($conn,"SELECT * FROM inventory WHERE status != 'Trashed' ");
                        $result = mysqli_fetch_array($sql);

                        if ($result == 0) {
                           $empty = "<div class='alert alert-default text-center' style='background: #EEE;'><label>Inventory is empty</label></div>";
                         } 
                        else {
                        $sql = "SELECT * FROM inventory WHERE status != 'Trashed' ";
                        $result = mysqli_query($conn,$sql);
                        while ($row = mysqli_fetch_array($result)) { 

                        ?> 
                        <tbody>
                          <tr> 
                            <td><?php echo $row['department']; ?></td> 
                            <td><?php echo $row['pc_name']; ?></td>
                            <td><?php echo $row['system_unit']; ?></td>
                            <td><?php echo $row['monitor']; ?></td>
                            <td><?php echo $row['mouse']; ?></td>
                            <td><?php echo $row['keyboard']; ?></td>
                            <td><?php echo $row['printer_name']; ?></td>
                            <td class="text-center">
                              <a href="editInventorySupport.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-fab btn-round btn-sm" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></a> 
                            </td>  
                          </tr>
                        </tbody>  
                      <?php } } ?>
                      </table> 
                      <?php echo $empty; ?> 
                    </div>
                  </div>
                </div>
              </div>
            </div>  

      <script type="text/javascript" src="plugins/sweetalert/sweetalert.min.js"></script>
      <script type="text/javascript" src="plugins/sweetalert/dialogs.js"></script>  
      <script src="js/material-kit.js?v=2.0.4" type="text/javascript"></script> 
      <script src="js/main/jquery.min.js"></script>
      <script src="js/main/popper.min.js"></script>
      <script src="js/main/bootstrap-material-design.min.js"></script>
      <script src="js/function.js" type="text/javascript"></script>
      <script src="js/script.js" type="text/javascript"></script>
      <script src="js/script2.js" type="text/javascript"></script>
      
    </body>
  </html>