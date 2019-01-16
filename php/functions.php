<?php
include 'connection.php';
$success = " ";
 
error_reporting(0);

// send concern
if (isset($_POST['upload'])) { 
  
  $image = $_FILES['image']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));

  $question = mysqli_escape_string($conn,$_POST['question']); 
  $concern = mysqli_escape_string($conn,$_POST['concern']);
  $type = mysqli_escape_string($conn,$_POST['type']); 
  $date_sent = mysqli_escape_string($conn,date('Y/m/d'));  
  $time_sent = mysqli_escape_string($conn,date('h:i a')); 
  $user_id = mysqli_escape_string($conn,$_POST['user_id']); 
 
  $query = "INSERT INTO tblconcern (image, question, concern,type,date_sent , status,time_sent,state, user_id, reason) VALUES ('$imgContent', '$question', '$concern', '$type', '$date_sent',  'Unreplied','$time_sent', 'Unseen', '$user_id', '0')";
  

  if (mysqli_query($conn,$query) == true) {

    
  $con_id = mysqli_insert_id($conn); 
  $u_id = mysqli_escape_string($conn,$_POST['user_id']); 
  $time_sent = mysqli_escape_string($conn,date('h:i a')); 
  $date_sent = mysqli_escape_string($conn,date('Y/m/d'));

  $ssd = "INSERT INTO ticketing (con_id, rep_id, s_id, time_sent, date_sent, time_replied, date_replied, u_id, status) VALUES ('$con_id', '0', '0', '$time_sent', '$date_sent', '0', '0', '$u_id', 'Incomplete')";
  mysqli_query($conn,$ssd);
  
    $success = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           CONCERN SENT!
        </div>
      </div>';

  }
  else {
  $con_id = mysqli_insert_id($conn); 
  $u_id = mysqli_escape_string($conn,$_POST['user_id']); 
  $time_sent = mysqli_escape_string($conn,date('h:i a')); 
  $date_sent = mysqli_escape_string($conn,date('Y/m/d'));

   $dds = "INSERT INTO ticketing (con_id, rep_id, s_id, time_sent, date_sent, time_replied, date_replied, u_id, status) VALUES ('$con_id', '0', '0', '$time_sent', '$date_sent', '0', '0', '$u_id', 'Incomplete')";
  mysqli_query($conn,$dds);
    
    $success = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           CONCERN SENT!
        </div>
      </div>';
  }
}

//save draft
if (isset($_POST['draft'])) { 

 $image = $_FILES['image']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));

  $question = mysqli_escape_string($conn,$_POST['question']); 
  $concern = mysqli_escape_string($conn,$_POST['concern']);
  $type = mysqli_escape_string($conn,$_POST['type']); 
  $date_sent = mysqli_escape_string($conn,date('Y/m/d'));  
  $time_sent = mysqli_escape_string($conn,date('h:i a')); 
  $user_id = mysqli_escape_string($conn,$_POST['user_id']); 
 
    $query = "INSERT INTO tblconcern (image, question, concern,type,date_sent , status,time_sent,state, user_id) VALUES ('$imgContent', '$question', '$concern', '$type', '$date_sent',  'Drafted','$time_sent', 'Seen', '$user_id')"; 

  if (mysqli_query($conn , $query) == true) { 
    
    $success = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           Concern save to drafts.
        </div>
      </div>';
  }else{ 

    $success = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           Concern save to drafts.
        </div>
      </div>';
  }
}


//reply concern 
$oobbs = '';

if (isset($_POST['reply'])) {

  $image = $_FILES['rep_image']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));

  $rep_concern = mysqli_escape_string($conn,$_POST['rep_concern']);  
  $users_id = $_POST['users_id'];
  $concern_id = $_POST['concern_id'];
  $sup_id = $_POST['sup_id']; 
  $date_reply = mysqli_escape_string($conn,date('Y/m/d'));  
  $time_reply = mysqli_escape_string($conn,date('h:i a')); 
 
  $querys = "INSERT INTO tblreply (rep_image, rep_concern,  users_id,concern_id,state,sup_id,date_reply,time_reply,status) VALUES ('$imgContent', '$rep_concern', '$users_id', '$concern_id', 'Unseen', '$sup_id', '$date_reply', '$time_reply','0')"; 

  if (mysqli_query($conn , $querys) == true) {

    $rep_id = mysqli_insert_id($conn);

    $sql2 = "UPDATE tblconcern SET status = 'Replied' WHERE id='$concern_id' "; 
    mysqli_query($conn , $sql2); 

    $sql2s = "UPDATE tblreply SET status = 'Sent' WHERE rep_concern = '$rep_concern' AND rep_image ='$imgContent' "; 
    mysqli_query($conn , $sql2s); 

    $s_id = $_POST['sup_id']; 
    $time_replied = mysqli_escape_string($conn,date('h:i a'));  
    $date_replied = mysqli_escape_string($conn,date('Y/m/d'));
    
    $con_id = $_POST['concern_id'];

    $sql2s = "UPDATE ticketing SET rep_id = '$rep_id', s_id = '$s_id',  time_replied = '$time_replied', date_replied = '$date_replied', status = 'Created' WHERE  con_id = '$con_id' ";
    mysqli_query($conn , $sql2s);

    $oobbs = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check text-white"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           Reply Sent!
        </div>
      </div>'; 
  }  
  else {
     $rep_id = mysqli_insert_id($conn);

    $sql2 = "UPDATE tblconcern SET status = 'Replied' WHERE id='$concern_id' "; 
    mysqli_query($conn , $sql2); 

    $sql2s = "UPDATE tblreply SET status = 'Sent' WHERE rep_concern = '$rep_concern' AND rep_image ='$imgContent' "; 
    mysqli_query($conn , $sql2s); 

    $s_id = $_POST['sup_id']; 
    $time_replied = mysqli_escape_string($conn,date('h:i a'));  
    $date_replied = mysqli_escape_string($conn,date('Y/m/d'));
    
    $con_id = $_POST['concern_id'];

    $sql2s = "UPDATE ticketing SET rep_id = '$rep_id', s_id = '$s_id',  time_replied = '$time_replied', date_replied = '$date_replied', status = 'Created' WHERE  con_id = '$con_id' ";
    mysqli_query($conn , $sql2s);

    $oobbs = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check text-white"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           Reply Sent!
        </div>
      </div>'; 
  }
}

//reply manager concern 
$oobb = '';

if (isset($_POST['managerreply'])) {

  $image = $_FILES['rep_image']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));

  $rep_concern = mysqli_escape_string($conn,$_POST['rep_concern']);  
  $users_id = $_POST['users_id'];
  $concern_id = $_POST['concern_id'];
  $sup_id = $_POST['sup_id']; 
  $date_reply = mysqli_escape_string($conn,date('Y/m/d'));  
  $time_reply = mysqli_escape_string($conn,date('h:i a')); 
 
  $querys = "INSERT INTO tblreply (rep_image, rep_concern,  users_id,concern_id,state,sup_id,date_reply,time_reply,status) VALUES ('$imgContent', '$rep_concern', '$users_id', '$concern_id', 'Unseen', '$sup_id', '$date_reply', '$time_reply','0')"; 

  if (mysqli_query($conn , $querys) == true) {

    $rep_id = mysqli_insert_id($conn);

    $sql2 = "UPDATE tblconcern SET status = 'Replied' WHERE id='$concern_id' "; 
    mysqli_query($conn , $sql2); 

    $sql2s = "UPDATE tblreply SET status = 'Sent' WHERE rep_concern = '$rep_concern' AND rep_image ='$imgContent' "; 
    mysqli_query($conn , $sql2s); 

    $s_id = $_POST['sup_id']; 
    $time_replied = mysqli_escape_string($conn,date('h:i a'));  
    $date_replied = mysqli_escape_string($conn,date('Y/m/d'));
    
    $con_id = $_POST['concern_id'];

    $sql2s = "UPDATE ticketing SET rep_id = '$rep_id', s_id = '$s_id',  time_replied = '$time_replied', date_replied = '$date_replied', status = 'Created' WHERE  con_id = '$con_id' ";
    mysqli_query($conn , $sql2s);

    $oobb = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check text-white"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           Reply Sent!
        </div>
      </div>'; 
  }  
  else {
     $rep_id = mysqli_insert_id($conn);

    $sql2 = "UPDATE tblconcern SET status = 'Replied' WHERE id='$concern_id' "; 
    mysqli_query($conn , $sql2); 

    $sql2s = "UPDATE tblreply SET status = 'Sent' WHERE rep_concern = '$rep_concern' AND rep_image ='$imgContent' "; 
    mysqli_query($conn , $sql2s); 

    $s_id = $_POST['sup_id']; 
    $time_replied = mysqli_escape_string($conn,date('h:i a'));  
    $date_replied = mysqli_escape_string($conn,date('Y/m/d'));
    
    $con_id = $_POST['concern_id'];

    $sql2s = "UPDATE ticketing SET rep_id = '$rep_id', s_id = '$s_id',  time_replied = '$time_replied', date_replied = '$date_replied', status = 'Created' WHERE  con_id = '$con_id' ";
    mysqli_query($conn , $sql2s);

    $oobb = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check text-white"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           Reply Sent!
        </div>
      </div>'; 
  }
}


//edit draft
$errer = '';

if (isset($_POST['drafted'])) { 

  $id=$_GET['id'];

  $image = $_FILES['image']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));

  $question = mysqli_escape_string($conn,$_POST['question']); 
  $concern = mysqli_escape_string($conn,$_POST['concern']);
  $type = mysqli_escape_string($conn,$_POST['type']); 
  $date_sent = mysqli_escape_string($conn,date('Y/m/d'));  
  $time_sent = mysqli_escape_string($conn,date('h:i a')); 
  $user_id = mysqli_escape_string($conn,$_POST['user_id']); 
 
  $query2 = "UPDATE tblconcern SET image='$imgContent',question='$question',concern='$concern',type='$type',date_sent='$date_sent',time_sent='$time_sent',user_id='$user_id' WHERE id='$id' ";
  

  if (mysqli_query($conn , $query2) == true) { 
    $errer = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           Saving Draft Successful!
        </div>
      </div>';

      header("location: drafts.php");
  }else{
    $errer = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           Saving Draft Successful!
        </div>
      </div>';

      header("location: drafts.php");
  }
}

// send Draft
$errer = '';

if (isset($_POST['sendDraft'])) { 

  $id=$_GET['id'];

  $image = $_FILES['image']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));

  $question = mysqli_escape_string($conn,$_POST['question']); 
  $concern = mysqli_escape_string($conn,$_POST['concern']);
  $type = mysqli_escape_string($conn,$_POST['type']); 
  $date_sent = mysqli_escape_string($conn,date('Y/m/d'));  
  $time_sent = mysqli_escape_string($conn,date('h:i a')); 
  $user_id = mysqli_escape_string($conn,$_POST['user_id']); 
 
  $queryd = "UPDATE tblconcern SET image='$imgContent',question='$question',concern='$concern',type='$type',date_sent='$date_sent',time_sent='$time_sent',user_id='$user_id',status='Unreplied',state='Unseen' WHERE id='$id' ";

  if (mysqli_query($conn , $queryd) == true) {

  $con_id = $id; 
  $u_id = mysqli_escape_string($conn,$_POST['user_id']); 
  $time_sent = mysqli_escape_string($conn,date('h:i a')); 
  $date_sent = mysqli_escape_string($conn,date('Y/m/d'));

  $queryd = "INSERT INTO ticketing (con_id,time_sent,date_sent,u_id,status) VALUES ('$con_id','$time_sent', '$date_sent', '$u_id', 'Incomplete')";
  mysqli_query($conn , $queryd);
  
    $errer = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           CONCERN SENT!
        </div>
      </div>';
      header("location: drafts.php");
  }
  else {
  $con_id = $id; 
  $u_id = mysqli_escape_string($conn,$_POST['user_id']); 
  $time_sent = mysqli_escape_string($conn,date('h:i a')); 
  $date_sent = mysqli_escape_string($conn,date('Y/m/d'));

  $queryd = "INSERT INTO ticketing (con_id,time_sent,date_sent,u_id,status) VALUES ('$con_id','$time_sent', '$date_sent', '$u_id','Incomplete')";
  mysqli_query($conn , $queryd);
    
    $errer = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           CONCERN SENT!
        </div>
      </div>';
      header("location: drafts.php");

  }
}


//remove reply
$msg = "";

if (isset($_POST['removeReply'])) {

  $seqel = "UPDATE tblreply set status='Trashed' ";
  mysqli_query($conn,$seqel);

  $msg = "Success";
} 

//update profile
$prof = "";

if (isset($_POST['updateAccount'])) { 
  
    $register_user_id = $_GET['id'];

    

    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $image = $_FILES['image']['tmp_name'];
    $imgContent = addslashes(file_get_contents($image));
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $contact_number = $_POST['contact_number'];

      $sqweql = "UPDATE register_user SET   f_name = '$f_name', m_name = '$m_name', l_name = '$l_name', user_image = '$imgContent', user_name = '$user_name', user_email = '$user_email', contact_number = '$contact_number' WHERE register_user_id = '$register_user_id' ";
    mysqli_query($conn , $sqweql); 
  }

  // reset OTP

$error = "";

if (isset($_POST['resetOTP'])) {

  $user_password = mysqli_escape_string($conn,$_POST['user_password']);
  $con_user_password = mysqli_escape_string($conn,$_POST['con_user_password']);

  if ($user_password != $con_user_password) {
    $error = "<div class='alert alert-danger'> One Time Password Do not Match </div>";
  }
  if (empty($user_password) || empty($con_user_password)) {
    $error = "<div class='alert alert-danger'> All fields are required </div>";
  }
  if (strlen($user_password) <= 6) {
    $error = "<div class='alert alert-danger'> Password is too short </div>";
  }
  if (strlen($user_password) > 20) {
    $error = "<div class='alert alert-danger'> Password is too long </div>";
  }
  else{
    $user_encrypted_password = password_hash($con_user_password, PASSWORD_DEFAULT);

    $sql = "UPDATE register_user SET user_password = '$user_encrypted_password' WHERE user_type = 'WEB MASTER'  ";
    mysqli_query($conn,$sql);

    $error = "<div class='alert alert-success'> <i class='fa fa-check'> </i> Updating new OTP Successful! Click here to <a href='php/logout.php' class='text-danger'> Re-Login </a> this account </div>";
  }
}

//change password
  $irror = "";

  if (isset($_POST['changePass'])) {

    $register_user_id = $_GET['id']; 

    $new_password = mysqli_escape_string($conn,$_POST['new_password']);
    $con_password = mysqli_escape_string($conn,$_POST['con_password']);

    if ($new_password != $con_password) {
    $irror = "<div class='alert alert-danger'> Password Do not Match </div>";
    }
    if (empty($new_password) || empty($con_password)) {
      $irror = "<div class='alert alert-danger'> All fields are required </div>";
    }
    if (strlen($new_password) <= 6) {
      $irror = "<div class='alert alert-danger'> Password is too short </div>";
    }
    if (strlen($new_password) > 20) {
      $irror = "<div class='alert alert-danger'> Password is too long </div>";
    }
    else{
    $user_encrypted_password = password_hash($con_password, PASSWORD_DEFAULT);

    $sql = "UPDATE register_user SET user_password = '$user_encrypted_password' WHERE register_user_id = '$register_user_id'  ";
    mysqli_query($conn,$sql);

    $irror = "<div class='alert alert-success'> <i class='fa fa-check'> </i> Updating new Password Successful! Click here to <a href='php/logout.php' class='text-danger'> Re-Login </a> this account </div>";
  }

  }


// reply on thread   
$sended = "";
if (isset($_POST['replyThreadBtn'])) {  

  $image = $_FILES['image']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));
  $id_con =  mysqli_escape_string($conn,$_POST['id_con']); 
  $concern =  mysqli_escape_string($conn,$_POST['concern']); 
  $id_user =  mysqli_escape_string($conn,$_POST['id_user']); 
  $t_time = mysqli_escape_string($conn,date('h:i a')); 
  $t_date = mysqli_escape_string($conn,date('Y/m/d'));
  

  $sql = "INSERT INTO thread (id_con,message, image, t_time, t_date, status, id_user,state) VALUES ('$id_con','$concern','$imgContent','$t_time','$t_date','Thread' ,'$id_user','Unseen')";
  mysqli_query($conn,$sql);
 $sended = '<div class="alert alert-success">
        <div class="container">
          <div class="alert-icon">
            <i class="fa fa-check"></i>
          </div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="fa fa-times"></i></span>
          </button>
           Reply Sent to this Topic! Click <a href="forum.php?id='.$id.'"> this </a> to go the forum of this concern.
        </div>
      </div>';
}


?> 