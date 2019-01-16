  <?php 
 include('php/database_connection.php'); 
 include 'php/functions.php';
if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
}

include 'php/connection.php'; 
$empty = "";
$id = $_GET['id']; 

$sql = "SELECT * FROM tblconcern INNER JOIN register_user ON user_id = register_user_id WHERE id='$id' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

$sqls = "SELECT * FROM tblreply INNER JOIN register_user ON sup_id = register_user_id WHERE concern_id='$id' ";
$results = mysqli_query($conn,$sqls);
$rows = mysqli_fetch_array($results);
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
                  <div class="card">
                    <div class="card-header card-header-danger text-center">  
                      <i class="fa fa-comments"></i> FORUM
                    </div>
                    <div class="card-body">   
                          <div class="card" style="padding: 20px 20px;">
                            <label class="text-center">CONCERN<br> from <?php echo $row["user_name"]; ?></label> 
                            <div class="container"> 
                              <div class="row">
                                <div class="col-md-6">
                                  <p><?php echo $row["type"]; ?></p>
                                  <p><?php echo $row["question"]; ?></p>
                                  <p><?php echo $row["concern"]; ?></p>
                                </div> 
                                <div class="col-md-6 text-right">
                                  <p><?php echo $row["time_sent"]; ?></p>
                                  <p><?php echo $row["date_sent"]; ?></p>
                                </div> 
                              </div> 
                              <br>
                              <?php
                              if ($row['image'] == "") {
                                echo "<div class='alert alert-default text-center' style='background: #EEE;'> No Image Included </div>";
                              }
                              else {
                                echo "<img src='data: image/jpeg;base64,".base64_encode($row['image'])."' class='img-raised rounded img-fluid' width='500'>";  
                              } 
                              ?> 
                               <br> <br> 
                            </div> <br>
                            <label class="text-center">REPLY<br> from <?php echo $rows["user_name"]; ?></label>
                            <div class="container"> 
                              <div class="row">
                                <div class="col-md-8"> 
                                  <p><?php echo $rows["rep_concern"]; ?></p>
                                </div> 
                                <div class="col-md-4 text-right">
                                  <p><?php echo $rows["time_reply"]; ?></p>
                                  <p><?php echo $rows["date_reply"]; ?></p>
                                </div> 
                              </div> 
                              <br>
                              <?php
                              if ($row['image'] == "") {
                                echo "<div class='alert alert-default text-center' style='background: #EEE;'> No Image Included </div>";
                              }
                              else {
                                echo "<img src='data: image/jpeg;base64,".base64_encode($rows['rep_image'])."' class='img-raised rounded img-fluid' width='500'>";
                              }  
                               ?> 
                              <br> <br> 
                            </div> 
                            <?php
                            $id1 = $_GET['id']; 
                            $thre = "SELECT * FROM thread INNER JOIN register_user ON id_user = register_user_id WHERE id_con = '$id1' ";
                            $squa = mysqli_query($conn,$thre); 
                            while ($fret = mysqli_fetch_array($squa)) {
                                echo "<label class='text-center'>REPLY<br> from $fret[user_name]; </label>
                              <div class='container'> 
                                <div class='row'>
                                  <div class='col-md-8'> 
                                    <p>  $fret[message] </p>
                                  </div> 
                                  <div class='col-md-4 text-right'>
                                    <p> $fret[t_time] </p>
                                    <p> $fret[t_date] </p>
                                  </div> 
                                </div>    
                                ";
                                if ($fret['image'] == "") {
                                  echo "<div class='alert alert-default text-center' style='background: #EEE;'> No Image Included </div>";
                                }
                                else {
                                  echo "<img src='data: image/jpeg;base64,".base64_encode($fret['image'])."' class='img-raised rounded img-fluid' width='500'>";  
                                } 
                                echo"<br> <br> 
                              </div> ";
                            }
                            ?> 
                            <div class="card"> 
                              <div class="container">
                                <span>Reply on this thread</span> 
                                <form method="post" action="viewForumSupport.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
                                  <div class="input-group">
                                  <textarea name="concern" class="form-control" placeholder="Input your reply" rows="3" minlength="5" required=""></textarea>
                                  </div> <br>
                                  <input type="text" name="id_user" hidden="" value="<?php echo $_SESSION['user_id']['register_user_id']; ?>">
                                  <input type="text" name="id_con" hidden="" value="<?php echo $row['id']; ?>">
                                  <input type="file" name="image" class="form-control" accept="image/x-png,image/gif,image/jpeg"> <br>
                                  <button type="submit" name="replyThreadBtn" class="btn btn-success btn-round"  data-toggle="tooltip" title="Send"><i class="fa fa-send"></i> Send</button> 
                                </form>
                              </div>
                            </div>
                          </div>

                          <div class="card" style="background-color: #EEE;"> 
                            <div class="container">
                              <div class="form-group">
                                <h3><i class="fa fa-thumbs-up"></i> Did you like the answer? Like the supports reply.</h3>  
                                <button class="btn btn-info btn-round" id="rateFeedback"><i class="fa fa-thumbs-up"></i> Like</button>
                              </div> 
                              <div class="form-group">
                              <h3><i class="fa fa-comment"></i> Post a comment or feedback related to the topic of this forum.</h3>
                              <textarea class="form-control" rows="3" minlength="5" placeholder="Input here..." id="conc_id" hidden=""><?php echo $_GET['id']; ?></textarea>
                              <textarea class="form-control" rows="3" minlength="5" placeholder="Input here..." id="user_id" hidden=""><?php echo $_SESSION['user_id']['register_user_id']; ?></textarea> 
                              <textarea class="form-control" rows="3" minlength="5" placeholder="Input here..." id="comment"></textarea>
                              <button class="btn btn-success btn-round" id="commentForum" ><i class="fa fa-comment"></i> Comment</button> 
                              </div>
                            </div> 
                          </div>
                          <div class="alert alert-info  text-center"><i class="fa fa-comment"></i> COMMENT SECTION</div>
                    <div class="card-footer"> 
                      <table class="table table-bordered">
                        <?php 
                        include 'php/connection.php';
                        $id = $_GET['id'];

                        $sql = "SELECT * FROM feedback INNER JOIN register_user ON user_id = register_user_id WHERE conc_id = '$id' ";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_array($result)) { 
                        
                        ?>
                        <tbody>
                          <tr>
                            <td>
                              <div class="row">
                                <div class="col-md-6">
                                  <img src="img/avatar.jpg" class="img-raised rounded-circle img-fluid" width="50"><label><?php echo $row["comment"]; ?></label>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group text-right">
                                    <label><?php echo $rows["time_reply"]; ?></label>
                                    <p>from <?php echo $row["user_name"]; ?></p>
                                  </div> 
                                </div>
                              </div>
                          </td>
                          </tr> 
                        </tbody>
                      <?php } ?>
                      </table> 
                    </div>
                    <a href="forumSupport.php" class="btn btn-danger btn-round pull-right"><i class="fa fa-mail-reply"></i> Back</a>
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
      <script src="js/item/moment.min.js" type="text/javascript"></script>
      <script src="js/item/bootstrap-datetimepicker.js" type="text/javascript"></script>
      <script src="js/item/nouislider.min.js" type="text/javascript"></script>
      <script src="js/item/easing.min.js" type="text/javascript"></script>
      <script src="js/item/smoothscroll.js" type="text/javascript"></script>
      <script src="js/item/jquery.sharrre.js" type="text/javascript"></script>
      <script src="js/material-kit.js?v=2.0.4" type="text/javascript"></script>
      <script src="js/function.js" type="text/javascript"></script>
      <script src="js/script.js" type="text/javascript"></script>
      <script type="text/javascript">
        $(document).ready(function(){
          //add comment on forum 
            $("#commentForum").click(function(){ 
            var comment = $("#comment").val(); 
            var conc_id = $("#conc_id").val(); 
            var user_id = $("#user_id").val(); 

            if (comment == "") {
              swal("Empty Comment Box", "", "error");
            } 
            else { 
              swal({
                    title: "Post this comment?", 
                    type: "info", 
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function () { 
                    setTimeout(function () {
                        swal("Comment is posted!","","success"); 
                        window.location = "forum.php?id=<?php echo $_GET['id'] ?>";
                    }, 2000);

                $.ajax({
                url: "php/postFeedback.php",
                    type: "POST",
                    data: { 
                    comment: comment, 
                    conc_id: conc_id,
                    user_id: user_id
                     },
                    dataType: "json",
                    success: function(data)
                    {
                  if (data == "Success") {
                  } else {
                    alert("Error 101");
                  }
                    }
              });
                }); 
            }
          });

        // rate the reply
          $(document).on( "click", "#rateFeedback", function(){ 
            

            swal({
                title: "Liked!",
                text: "Thank you for your feedback.",
                imageUrl: "img/thumbs-up.png"
            });
            $.ajax({
                url: "php/likeFeedback.php?id=<?php echo $_GET['id'] ?>",
                dataType: "json",
                success: function(data)
                {
                  window.location = "forum.php?id=<?php echo $_GET['id'] ?>";
                }
            });
            
          });          

        });
      </script>
      
    </body>
  </html>