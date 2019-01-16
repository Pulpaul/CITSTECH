<?php 
  include('php/database_connection.php');

if(!isset($_SESSION["user_id"]))
{
    header("location: php/logout.php");
}

$connect = new PDO("mysql:host=localhost;dbname=dbcits", "root", "");
$get_all_table_query = "SHOW TABLES";
$statement = $connect->prepare($get_all_table_query);
$statement->execute();
$result = $statement->fetchAll();

if(isset($_POST['table']))
{
 $output = '';
 foreach($_POST["table"] as $table)
 {
  $show_table_query = "SHOW CREATE TABLE " . $table . "";
  $statement = $connect->prepare($show_table_query);
  $statement->execute();
  $show_table_result = $statement->fetchAll();

  foreach($show_table_result as $show_table_row)
  {
   $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
  }
  $select_query = "SELECT * FROM " . $table . "";
  $statement = $connect->prepare($select_query);
  $statement->execute();
  $total_row = $statement->rowCount();

  for($count=0; $count<$total_row; $count++)
  {
   $single_result = $statement->fetch(PDO::FETCH_ASSOC);
   $table_column_array = array_keys($single_result);
   $table_value_array = array_values($single_result);
   $output .= "\nINSERT INTO $table (";
   $output .= "" . implode(", ", $table_column_array) . ") VALUES (";
   $output .= "'" . implode("','", $table_value_array) . "');\n";
  }
 }
 $file_name = 'database_backup_on_' . date('y-m-d') . '.sql';
 $file_handle = fopen($file_name, 'w+');
 fwrite($file_handle, $output);
 fclose($file_handle);
 header('Content-Description: File Transfer');
 header('Content-Type: application/octet-stream');
 header('Content-Disposition: attachment; filename=' . basename($file_name));
 header('Content-Transfer-Encoding: binary');
 header('Expires: 0');
 header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_name));
    ob_clean();
    flush();
    readfile($file_name);
    unlink($file_name);
}
?> 
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Web Master</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="css/font-awesome.css"> 
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="dist/css/ripples.min.css">
  <link rel="stylesheet" href="dist/css/MaterialAdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/all-md-skins.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="webMaster.php" class="logo">
      <span class="logo-mini">C<b>I</b>TS</span>
      <span class="logo-lg"><b><?php echo $_SESSION['user_id']['user_type']; ?></b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="img/logo.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['user_id']['user_name']; ?></span>
            </a>
            <ul class="dropdown-menu"> 
              <li class="user-header">
                <img src="img/logo.png" class="img-circle" alt="User Image"> 
                <p>
                  <?php echo $_SESSION['user_id']['user_name']; ?>
                </p>
                <?php echo $_SESSION['user_id']['user_email']; ?>
              </li>  
              <li class="user-footer">
                <div class="col-md-6">
                  <a href="setting.php" class="btn btn-default btn-flat">Account <i class="fa fa-cog"></i></a>
                </div>
                <div class="col-md-6">
                  <a href="php/logout.php" class="btn btn-default btn-flat">Sign out <i class="fa fa-sign-out"></i></a>
                </div>
              </li>
            </ul>
          </li> 
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/logo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['user_id']['user_name']; ?></p> 
          <?php echo $_SESSION['user_id']['user_email']; ?>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <ul class="sidebar-menu" data-widget="tree">  
        <li>
          <a href="webMaster.php">
            <i class="fa fa-address-book" style="font-size: 20px"></i> <span>Accounts</span> 
          </a>
        </li> 
        <li class="active">
          <a href="backupDatabase.php">
            <i class="fa fa-database" style="font-size: 20px"></i> <span>Database</span> 
          </a>
        </li> 
      </ul>
    </section>
  </aside>

    <div class="content-wrapper">  
      <section class="content"> 
        <div class="box">
          <div class="box-header with-border text-center">
            <h3 class="box-title"><i class="fa fa-database"></i> BACKUP DATABASE </h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body"> 
            <br />
            <form method="post" id="export_form">
             <h3>Select Tables for Export</h3>
            <?php
            foreach($result as $table)
            {
            ?>
             <div class="checkbox">
              <label><input type="checkbox" class="checkbox_table" name="table[]" value="<?php echo $table["Tables_in_dbcits"]; ?>" /> <?php echo $table["Tables_in_dbcits"]; ?></label>
             </div>
            <?php
            }
            ?> 
            <div class="form-group">
              
              <button type="submit" name="submit" id="submit" class="btn btn-info bg-olive" value="Export"><i class="fa fa-database"></i> EXPORT </button>
             </div>
          </form>
          </div>  
        </div>    
        </section> 
      </div>

  <footer class="main-footer>  
  <strong> <img src="img/logocits.png" style="width: 200px;"></strong>
  </footer>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/material.min.js"></script>
<script src="dist/js/ripples.min.js"></script>
<script src="dist/js/adminlte.min.js"></script> 
<script>
    $.material.init();
</script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>  
<script>
  $(function () {
    $('#concern').DataTable()
    $('#').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script type="text/javascript" src="js/script.js"></script> 
<script>
$(document).ready(function(){
 $('#submit').click(function(){
  var count = 0;
  $('.checkbox_table').each(function(){
   if($(this).is(':checked'))
   {
    count = count + 1;
   }
  });
  if(count > 0)
  {
   $('#export_form').submit();
  }
  else
  {
   alert("Please Select Atleast one table for Export");
   return false;
  }
 });
});
</script>
</body>
</html>