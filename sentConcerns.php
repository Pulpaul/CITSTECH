<?php 
  include('php/database_connection.php');

if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
}
?> 
<html>
<head>
	<title>Sent Items</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="css/user.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
</head>
<body>
 <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="img/logocits.png" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a class="js-arrow" href="user.php">
                                <i class="fa fa-inbox"></i>Inbox  <span class="badge badge-danger">5</span></a>
                        </li>
                        <li>
                            <a href="createconcern.php">
                                <i class="fa fa-paper-plane-o"></i>Create Concern</a>
                        </li>
                        <li class="active has-sub">
                            <a href="#">
                                <i class="fa fa-archive"></i>Sent Concerns</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-database"></i>Project</a>
                        </li>
                        </li>
                    </ul>
                </nav>
            </div>
</aside>
 <div class="page-container">
            
            <header class="header-desktop">
                <div class="section__content section__content--p10">
                    <div class="container-fluid">

                        <div class="header-wrap">

                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for concern" />
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="dropdown">
                            <button onclick="myFunction()" class="dropbtn">Welcome: <?php echo $_SESSION['user_id']['user_name']; ?> <i class="fa fa-angle-down"></i></button>
                              <div id="myDropdown" class="dropdown-content"> 
                                <a href="#"><i class="fa fa-cog"></i> Settings</a>
                                <a href="php/logout.php"><i class="fa fa-sign-out"></i> Log out</a>
                              </div>
                            </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </header>
          
          <div class="col-md-12">
                                 <h2 class="title-1 m-b-25" align="center">Sent Concerns</h2>
                                 <br>
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>type</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
        <?php
                            include('php/connection.php');

                            $user_id = $_SESSION['user_id']['register_user_id'];
                            $query = "SELECT * FROM tblconcern WHERE user_id='$user_id'";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) { ?>
            <tr>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['type']; ?></td>
              <td><?php echo $row['concern']; ?></td>
               <td><?php echo "<div id=myImg>"; ?><?php echo "<a href='concernimage/".$row['image']."'>"; ?> <?php echo "<img src='concernimage/".$row['image']."' >"; ?>
                                <?php echo "</div>"; ?></td>
              <td>
                <a class="btn btn-info btn-sm" href="editAccount.php?id=<?php echo $row['id']; ?>"><i class="fa fa-info-circle"></i> View</a>
              </td>
            </tr>
        <?php } ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
             <div class="main-content">
                <div class="section__content section__content--p30"> 
                    <div class="container-fluid"> 
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="copyright">
                                     
                                   
                                 
                                   
                                </div> 
                                    <p>Copyright © 2018 Competitive I.T. Solutions Inc</p>
                                </div>
                            </div>
                        </div>
 
                    </div>
                </div>
            </div>
        </div>

    </div>
 
    <script type="text/javascript" src="js/function.js"> </script>
       <script>
 
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

 
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

</body>
</html>