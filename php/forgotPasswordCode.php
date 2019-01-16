<?php

include('connection.php'); 

$error = '';  

if(isset($_POST["forgot"]))
{	
	$user_email = $_POST['user_email'];

    $query = mysqli_query($conn,"SELECT * FROM register_user WHERE user_email = '$user_email' ");
    $row = mysqli_fetch_assoc($query);
    if($row > 0)
    {	 
        $sql = mysqli_query($conn,"SELECT * FROM register_user WHERE user_email = '$user_email' ");
        $row = mysqli_fetch_array($sql);  
        if (isset($row)) { 
            $base_url = "http://localhost/Thesis/";  
            $mail_body = "
            <p>Hi ".$row['user_email'].",</p>
            <p> Click confirm and reset to Reset you password.</p>
            <p>Please Open this link to enter your new password - ".$base_url."new_password.php?email=".$row['user_email']."
            <p>Best Regards,<br />Competitive I.T Solutions Inc. Technical Support System</p>
            ";
            require 'phpmailer/PHPMailerAutoload.php';
            $mail = new PHPMailer(true);

            $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true));
            $mail->IsSMTP();                                  
            $mail->Host = 'smtp.gmail.com';      
            $mail->Port = '587';                                 
            $mail->SMTPAuth = true;                         
            $mail->Username = 'delapenapaulandrei12@gmail.com';              
            $mail->Password = 'luapyerd';                   
            $mail->SMTPSecure = 'tls';                         
            $mail->From = 'delapenapaulandrei12@gmail.com';        
            $mail->FromName = 'CITS Email Verification';         
            $mail->AddAddress($_POST['user_email']);       
            $mail->WordWrap = 50;
            $mail->IsHTML(true);                                   
            $mail->Subject = 'Email Verification';       
            $mail->Body = $mail_body;                       
            if($mail->Send())                                
            {
                $error = '<div class="alert alert-success">Please check your G-mail to confirm and reset your password.</div>';
            } 
        }
    }
    else
    {	 
        $error = '<div class="alert alert-danger">Email doesnt Exist</div>';
    }
}

?>