<?php
include('database_connection.php');

if(isset($_SESSION['user_id']))
{
	header("location:index.php");
}

$error = '';
$user_password = '';
$user_email_status = '';
$user_email = '';

if(isset($_POST["login"]))
{
	$query = "
	SELECT * FROM register_user 
		WHERE user_name = :user_name
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
				'user_name'	=>	$_POST["user_name"],
			)
	);
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if($row['user_email_status'] == 'verified')
			{	
				if(password_verify($_POST["user_password"], $row["user_password"])) 
				{	
					if($row['user_type'] == 'MANAGER') {
					$_SESSION['user_id'] = $row;
					header("location: manager.php");
					}
					elseif($row['user_type'] == 'WEB MASTER') {
					$_SESSION['user_id'] = $row;
					header("location: webMaster.php");
					}
					elseif ($row['user_type'] == 'SUPPORT') {
					$_SESSION['user_id'] = $row;
					header("location: forumSupport.php");
					}
					else {
					$_SESSION['user_id'] = $row;
					header("location: user.php");
					}
				}
				else
				{
					$user_password = "<label class='alert alert-danger'>Wrong Password</label>";
				}
			}
			else
			{
				$user_email_status = "<label class='alert alert-danger'>Please First Verify your email address</label>";
			}
		}
	}
	else
	{
		$user_email = "<label class='alert alert-danger'>Wrong Email Address</label>";
	}
}

?>