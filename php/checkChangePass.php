<?php  
include 'connection.php';
if(isset($_POST["users_password"]))
	
{ 
 $query = "SELECT * FROM register_user WHERE user_type = 'USER' ";
 $result = mysqli_query($conn, $query);
 
 while ($row = mysqli_fetch_array($result)) {
 	if (password_verify($_POST["users_password"], $row["user_password"])) {

 		 echo mysqli_num_rows($result);

 		 $error = "<label class='alert alert-success'> Existing </label>";
      }
      else{
        $error = "<label class='alert alert-danger'> Not existing </label>";
      }
 }
}
?>