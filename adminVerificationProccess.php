<?php

use PHPMailer\PHPMailer\PHPMailer;

require "connection.php";

require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";

if(isset($_POST["email"])){
    $email = $_POST["email"];

    if(empty($email)){
        echo "Please enter the email address";
    }else{

        $adminrs = Database::search("SELECT * FROM `admin` WHERE `email` = '".$email."'");
        $adminnr = $adminrs->num_rows;

        if($adminnr == 1){

            $code = uniqid();

            Database::iud("UPDATE `admin` SET `verification_code` = '".$code."' WHERE `email` = '".$email."'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'bvachiradimuthu@gmail.com';
            $mail->Password = 'dcgfkkrbjeydtziq';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('bvachiradimuthu@gmail.com', 'eShop');
            $mail->addReplyTo('bvachiradimuthu@gmail.com', 'eShop');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Admin Verification Code';
            $bodyContent = '<h1>Your Verification Code is <b>'.$code.'</b></h1>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo "Verification code sending failed";
            }else{
                echo "success";
            }
            
        }else{
            echo "You are not a valied admin";
        }

    }
}
