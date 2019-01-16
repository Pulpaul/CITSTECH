<?php 
include('php/functions.php');

if (!isAdmin()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: index.php');
}

if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user']);
  header("location: index.php");
}

include('php/connection.php');

  $id = $_GET['id'];

  $query = mysqli_query($conn,"select * from `tblacc` where id='$id'");
  $row = mysqli_fetch_array($query);
?> 
<html>
<head>
  <title>Admin</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/admin.css">
 
</head>
<body>

<nav>
<ul class="topnav">
  <a class="navbar-brand" href="#" style="border-left: 2px solid darkred;  border-radius: 50px;">
    <img src="img/logo.png" alt="Logo" style="width:100px; height: 70px; margin-top: -8px;">
  </a>
  <li style="border-right: 2px solid darkred; border-radius: 50px;"><a href="#">Admin <small>panel</small></a></li>
  <li class="right"><a href="admin.php?logout='1'"><i class="fa fa-sign-out" style="font-size: 30px; color: darkred;"></i> Log Out</a></li>

  <li class="right"><a href="#"><i class="fa fa-user-circle-o" style="font-size: 30px; color: darkred;"></i> <?php echo $_SESSION['user']['username']; ?></a></li>
  <li class="right"><a href="#"><i class="fa fa-wpforms" style="font-size: 30px; color: darkred;"></i></a></li>
  <li class="right"><a href="#"><i class="fa fa-envelope-square" style="font-size: 30px; color: darkred;"></i></a></li>
</ul>
</nav>

  
            <div class="sidenav">
    <a href="admin.php">
          <div class="sidelink">
            <span class="linkLabel">
              <i class="fa fa-dashboard" style="font-size:30px; color: darkred;"></i>
              Dashboard
            </span>
          </div>
        </a>
        <a href="concerns.php">
          <div class="sidelink">
            <span class="linkLabel">
              <i class="fa fa-paper-plane-o" style="font-size:30px; color: darkred"></i>
              Concerns
            </span>
          </div>
        </a>
        <a href="accounts.php">
          <div class="sidelink active">
            <span class="linkLabel">
              <i class="fa fa-users" style="font-size:30px; color: darkred"></i>
              Accounts
            </span>
          </div>
        </a>
        <a href="#">
          <div class="sidelink">
            <span class="linkLabel">
              <i class="fa fa-product-hunt" style="font-size:30px; color: darkred"></i>
              Projects
            </span>
          </div>
        </a>
      </div>
</nav>

      <div class="containers">
        <div class="col-md-12">
          <div class="overview-wrap">
        <h2 class="title-1">Update Support</h2>
        <br>
      <a type="button" href="accounts.php" class="btn btn-danger">Cancel</a>
      <br> 
      <br>
        </div>
        <div>
          <?php echo display_error(); ?>
          <form method="post" action="addaccounts.php?id=<?php echo $id; ?>">
          <label>User Type</label>
          <select name="user_type" id="user_type" class="form-control">
              <option value="support">Support</option>
          </select>
          <label> First name</label>
          <input type="text" name="fname" value="<?php echo $row['fname']; ?>" onkeyup="lettersOnly(this)" class="form-control" placeholder="Input First name" required>
          <label> Middle name</label>
          <input type="text" name="mname" value="<?php echo $row['mname']; ?>" onkeyup="lettersOnly(this)" class="form-control" placeholder="Input Middle name" required>
          <label> Last name</label>
          <input type="text" name="lname" value="<?php echo $row['lname']; ?>" onkeyup="lettersOnly(this)" class="form-control" placeholder="Input Last name" required>
          <label> Email </label>
          <input type="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" placeholder="Input Email" required>
          <label> Contact Number </label>
          <input type="number" name="number" value="<?php echo $row['number']; ?>" class="form-control" placeholder="Input Contact Number" required>
          <label> Username </label>
          <input type="text" name="username" value="<?php echo $row['username']; ?>" onkeyup="lettersOnly(this)" class="form-control" placeholder="Input Username" required>

          <br>
      <button type="submit" name="update_support" class="btn btn-success">Update </button>
      <br>
          </form>
        </div>
      </div>
<script type="text/javascript" src="js/function.js"> </script>
</body>
</html>