<?php

session_start();

$email2 = $_POST["email2"];
$password2 = $_POST["password2"];
$remember_me = $_POST["remember_me"];

//echo $email2;
//echo $password2;
//echo $remember_me;

require "connection.php";
$r = Database::search("SELECT * FROM `user` WHERE `email`='".$email2."' AND `password`='".$password2."'");
$n = $r->num_rows;

if($n == 1){
    echo "success";
    $d = $r->fetch_assoc();
    $_SESSION["u"] = $d;
    
    if($remember_me == "true"){
        setcookie("email",$email2,time()+(60*60*24*365));
        setcookie("password",$password2,time()+(60*60*24*365));
    }else{
        setcookie("email",$email2,time()-1);
        setcookie("password",$password2,time()-1);
    }

    
}else{
    echo "Invalid Username or Password";
}
