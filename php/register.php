<?php
error_reporting(0);
include('database_connection.php');

if(isset($_SESSION['user_id']))
{
    header("location:index.php");
}

$f_name = '';
$m_name = '';
$l_name = '';
$contact_number = '';
$user_name = '';
$email = '';
$success = '';

if(isset($_POST["register"]))
{
    $query = "
    SELECT * FROM register_user 
    WHERE user_email = :user_email
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':user_email'   =>  $_POST['user_email']
        )
    );
    $no_of_row = $statement->rowCount();
    if($no_of_row > 0)
    {
        $email = '<label class="alert alert-danger">Email Already Exist</label>';
    }
    else
    {
        $user_password = rand(100000,999999);
        $user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
        $user_activation_code = md5(rand());
        $image = $_FILES['image']['tmp_name']; 
        $insert_query = "
        INSERT INTO register_user 
        (user_type,f_name,m_name,l_name,user_image,contact_number,user_name, user_email, user_status, user_password, user_activation_code, user_email_status) 
        VALUES (:user_type, :f_name, :m_name, :l_name, :user_image,:contact_number,  :user_name, :user_email, :user_status, :user_password, :user_activation_code, :user_email_status)
        ";
        $statement = $connect->prepare($insert_query);
        $statement->execute(
            array(
                ':user_type'            =>  'USER',
                ':f_name'           =>  $_POST['f_name'],
                ':m_name'           =>  $_POST['m_name'],
                ':l_name'           =>  $_POST['l_name'], 
                ':user_image'           =>  addslashes(file_get_contents($image)),
                ':contact_number'           =>  $_POST['contact_number'],
                ':user_name'            =>  $_POST['user_name'],
                ':user_email'           =>  $_POST['user_email'],
                ':user_status'           =>  'Inactive',
                ':user_password'        =>  $user_encrypted_password,
                ':user_activation_code' =>  $user_activation_code,
                ':user_email_status'    =>  'not verified'
            )
        );
        $result = $statement->fetchAll();
        if(isset($result))
        {
            $base_url = "http://localhost/Thesis/";  
            $mail_body = "
            <p>Hi ".$_POST['user_name'].",</p>
            <p>Thanks for Registration. Your password is ".$user_password.", You can change your password later.</p>
            <p>Please Open this link to verified your email address - ".$base_url."email_verification.php?activation_code=".$user_activation_code."
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
            $mail->AddAddress($_POST['user_email'], $_POST['user_name']);       
            $mail->WordWrap = 50;                     
            $mail->IsHTML(true);                                   
            $mail->Subject = 'Email Verification';       
            $mail->Body = $mail_body;                       
            if($mail->Send())                                
            {
                $success = '<div class="alert alert-success text-center float-center">Register Done! Please check your G-mail to confirm your account.</div>';
            }
                function itexmo($number,$message,$apicode){
                $url = 'https://www.itexmo.com/php_api/api.php';
                $itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
                $param = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($itexmo),
                    ),
                );
                $context  = stream_context_create($param);
                return file_get_contents($url, false, $context);}
                $result = itexmo("".$_POST['contact_number']."","Hello ".$_POST['f_name']." ".$_POST['m_name']." ".$_POST['l_name'].",We have sent a confirmation email and your password to ".$_POST['user_email']." Please confirm your account to Enable your account. ","TR-LUAPY656640_IT1BP");
                if ($result == ""){
                echo "iTexMo: No response from server!!!
                Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
                Please CONTACT US for help. ";  
                }else if ($result == 0){
                echo "Message Sent!";
                }
                else{   
                echo "Error Num ". $result . " was encountered!";
                }
        }
    }
}

?> 