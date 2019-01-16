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
      
      <link rel="icon" href="img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="css/font-awesome.css">
       
      <link type="text/css" rel="stylesheet" href="css/material-kit.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="plugins/sweetalert/sweetalert.css">  
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/select2/3.4.8/select2.css" /> 

      <meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
    </head>
    <body>

          <nav class="navbar navbar-inverse navbar-expand-lg bg-default" role="navigation-demo">
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
                      <i class="fa fa-comments"></i>CHAT
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
                      <a href="inbox.php">
                      <div class="text-center">
                        <button class="btn btn-danger btn-round"> <i class="fa fa-mail-reply"></i>  BACK TO INBOX </button>
                      </div> 
                      </a>
                      <table class="table table-hover ">
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

                                    $pdoQuery = "SELECT * FROM tblconcern WHERE user_id = '$id' AND status != 'Trashed' AND status != 'Drafted' AND status = 'Seen' ";

                                    $pdoResult = $connect->query($pdoQuery);

                                    $pdoRowCount = $pdoResult->rowCount();

                                    if ($pdoRowCount <= 0) {
                                      echo " ";
                                    } else {
                                    echo "<div class='badge badge-pill badge-default'>$pdoRowCount</div>";  
                                    }
                                    ?> 
                            </td> 
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
                                  ?> 
                            </td>
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
                                    ?> 
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div> 
                  </div>
                </div> 
                <div class="col-md-9"> 
                    <div class="card"> 
                    <div class="card-header card-header-danger text-center"> <i class="fa fa-edit"></i> 
                      CREATE NEW CONCERN 
                    </div>
                    <br>  
                      <div class="card-body js-sweetalert"> 
                        <form method="post" id="concern_form" action="createConcern.php" enctype="multipart/form-data" onsubmit="return error()">
                          <div class="form-group" hidden="">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                ID:
                              </span>
                            </div>
                            <select class="form-control show-tick" name="user_id" required="" readonly hidden="">
                              <option class="opt"><?php echo $_SESSION['user_id']['register_user_id']; ?></option> 
                            </select>
                          </div>
                        </div>
                        <?php echo $success; ?>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                Concern Type:
                              </span>
                            </div>
                            <select id="type" name="type" class="form-control select" >
                              <optgroup label="Technical Support">
                                <option>Hardware Related</option>
                                <option>PC troubleshoot</option>
                              </optgroup>
                              <optgroup label="Network Infrastructure">
                                <option>Routers and switches</option>
                                <option>Firewalls </option>
                                <option>Load balancers </option>
                                <option>DNS </option>
                              </optgroup>
                              <optgroup label="Comprehensive Cabling">
                                <option>Backbone Cabling</option>
                                <option>Cabling Connectors</option>
                                <option>Horizontal Connectors</option>
                                <option>Work Area Connectors</option>
                                <option>Equipment Room</option>
                              </optgroup>
                              <optgroup label="Others">
                                <option>Others...</option>
                              </optgroup>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend"> 
                              <span class="input-group-text">
                                Concern Question:  
                              </span>
                            </div>
                            <textarea class="form-control" rows="2" name="question" id="question"  minlength="5" autofocus="" required="" ></textarea>
                          </div> 
                        </div>     
                        <span id="errorConcern" class="bg-danger text-white" style="margin-left: 40%;"></span>
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend"> 
                              <span class="input-group-text">
                                Concern Message:  
                              </span>
                            </div>
                            <textarea class="form-control" rows="5" name="concern" id="concern"  minlength="5" autofocus="" required="" ></textarea>
                          </div> 
                        </div>     
                            <span id="errorImage" class="bg-danger text-white" style="margin-left: 44%;"></span>
                            <br /> 
                          <div class="form" style="padding: 25px 17px;" id="hideImg">   
                            <span class="input-group-text"> 
                                Reference Image:  
                              </span>
                            <input type="file" name="image" id="image" class="form-control" required="" accept="image/x-png,image/gif,image/jpeg">  
                          </div>
                          <div class="form-check" style="padding: 20px;">
                            <label class="form-check-label">
                              <input class="form-check-input" type="checkbox" value="" id="disableImg"> Do not require image.
                              <span class="form-check-sign">
                                <span class="check"></span>
                              </span>
                            </label>
                          </div>
                          <a href="inbox.php" class="btn btn-default btn-round"><i class="fa fa-close"></i> Discard </a>  
                          <div class="float-right">
                          <button type="submit" name="draft" class="btn btn-info btn-round"><i class="fa fa-file-text"></i> DRAFT</button>
                          <button type="submit" name="upload" id="upload" class="btn btn-success btn-round"><i class="fa fa-send"></i> SEND</button> 
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

      
      <script type="text/javascript" src="plugins/sweetalert/sweetalert.min.js"></script>
      <script type="text/javascript" src="plugins/sweetalert/dialogs.js"></script> 
      <script src="js/main/jquery.min.js" type="text/javascript"></script>
      <script src="js/main/popper.min.js" type="text/javascript"></script>
      <script src="js/main/bootstrap-material-design.min.js" type="text/javascript"></script>
      <script src="https://cdn.jsdelivr.net/select2/3.4.8/select2.js"></script>
      <script src="js/material-kit.js?v=2.0.4" type="text/javascript"></script>
      <script src="js/function.js" type="text/javascript"></script>
      <script src="js/script.js" type="text/javascript"></script> 
      <script src="js/script2.js" type="text/javascript"></script>

    </body>
  </html>