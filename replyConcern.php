  <?php 
  include('php/database_connection.php');
  include('php/functions.php');

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
                    <a href="chatSupport.php" class="nav-link">
                      <i class="fa fa-comments"></i>Chat 
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
                            <td>
                              <?php

                        $pdoQuery = "SELECT * FROM tblconcern WHERE status = 'Trashed' AND state = 'Seen' ";

                        $pdoResult = $connect->query($pdoQuery);

                        $pdoRowCount = $pdoResult->rowCount();

                        if ($pdoRowCount <= 0) {
                          echo " ";
                        } else {
                        echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
                        }  ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div> 
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="card">
                    <div class="card-header card-header-danger text-center">
                      REPLY CONCERN
                    </div>
                    <?php
                       include('php/connection.php');

                      $id=$_GET['id'];

                      $query=mysqli_query($conn,"SELECT * FROM `tblconcern` WHERE id='$id'");
                      $row=mysqli_fetch_array($query);

                    ?>
                    <div class="card-body"> 
                      <form method="post" action="replyConcern.php?id=<?php echo $row['id']; ?>" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-12">
                        <div class="form-group" hidden="">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                Concern ID:
                              </span>
                            </div>
                            <select class="form-control show-tick" name="concern_id" required="" readonly>
                              <option class="opt"><?php echo $row['id']; ?></option> 
                            </select>
                          </div>
                        </div>
                        <div class="form-group" hidden="">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                User ID:
                              </span>
                            </div>
                            <select class="form-control show-tick" name="users_id" required="" readonly>
                              <option class="opt"><?php echo $row['user_id']; ?></option> 
                            </select>
                          </div>
                        </div>
                        <div class="form-group" hidden="">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                Sup ID:
                              </span>
                            </div>
                            <select class="form-control show-tick" name="sup_id" required="" readonly>
                              <option class="opt"><?php echo $_SESSION['user_id']['register_user_id']; ?></option> 
                            </select>
                          </div>
                        </div>
                          <?php echo $oobbs; ?>
                          <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                Reply Message:  
                              </span>
                            </div>
                            <textarea class="form-control" rows="5" cols="10" name="rep_concern" id="rep_concern"  minlength="5" autofocus="" required=""></textarea> 
                          </div> 
                        </div>     
                            <span id="errorImage" class="bg-danger text-white" style="margin-left: 40%;"></span>
                            <br />  
                            <div class="form" style="padding: 25px 17px;" id="formRepImg">  
                              <span class="input-group-text">
                                Reference Image:
                              </span>
                              <input type="file" name="rep_image" id="rep_image" required="" class="btn btn-default btn-link form-control"> 
                            </div>
                            <div class="form-check" style="padding: 20px;">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" id="disableRepImage"> Do not require image.
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                         <br>
                         <br>
                        </div> 
                      </div>  
                      <div class="footer">
                        <div class="pull-left">
                        <a href="support.php" class="btn btn-danger btn-round"><i class="fa fa-close"></i> Discard </a> 
                      </div>
                      <div class="pull-right">
                        <button type="submit" name="reply" class="btn btn-success btn-round"><i class="fa fa-send"></i> Send </button> 
                      </div>
                      </div>
                      </form>
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
      <script src="js/function.js" type="text/javascript"></script>
      <script src="js/script.js" type="text/javascript"></script>
      <script src="js/script2.js" type="text/javascript"></script>
      
    </body>
  </html>