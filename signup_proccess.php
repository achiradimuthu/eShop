<?php

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

require "connection.php";

if(empty($fname)){
    echo "Please enter your First Name";
}elseif(strlen($fname) > 45){
    echo "First name must be less than 45 Charactors";
}elseif(empty($lname)){
    echo "Please enter your Last Name";
}elseif(strlen($lname) > 45){
    echo "Last name must be less than 45 Charactors";
}elseif(empty($email)){
    echo "Please enter your Email";
}elseif(strlen($email) > 50){
    echo "First name must be less than 45 Charactors";
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "Invalid Email Address";
}elseif(empty($password)){
    echo "Please Enter Your password";
}elseif(strlen($password) < 5 || strlen($password) > 20){
    echo "Password Length should be between 5 to 20";
}elseif(empty($mobile)){
    echo "Please enter your Mobile Number";
}elseif(strlen($mobile) !=10){
    echo "Mobile number should contain 10 characters";
}elseif(preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/",$mobile == 0)){
    echo "Invalid mobile Number";
}else{
    $r = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' OR `mobile` = '".$mobile."'");
    $n = $r->num_rows;

    if($n > 0){
        echo "User with the same Email address or Phone number already exists";
    }else{
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("y-m-d H:i:s");

        Database::iud("INSERT INTO `user` (`email`,`fname`,`lname`,`password`,`mobile`,`gender`,`register_date`) VALUES ('".$email."','".$fname."','".$lname."','".$password."','".$mobile."','".$gender."','".$date."')");

        echo "success";
        
    }
}

?>