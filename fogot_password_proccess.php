<?php

use PHPMailer\PHPMailer\PHPMailer;

require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

if(isset($_GET["email"])){
    $email = $_GET["email"];

    if(empty($email)){
        echo "Please enter valid email";
    }else{

        $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
        if($rs->num_rows == 1){
            
            $code = uniqid();
            Database::iud("UPDATE `user` SET `verification_code` = '".$code."' WHERE `email`='".$email."'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '*********';
            $mail->Password = 'dcgfkkrbjeydtziq';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('*********', 'Reset Password');
            $mail->addReplyTo('************', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Verification Code';
            $bodyContent = '<h1>Your Verification Code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo "Verification code sending failed";
            }else{
                echo "success";
            }

        }else{
            echo "Email address not found";
        }

    }
}else{
    echo "Please enter your email address";
}

?>