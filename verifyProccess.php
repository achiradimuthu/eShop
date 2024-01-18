<?php

session_start();
require "connection.php";

if(isset($_GET["vcode"])){
    $vcode = $_GET["vcode"];
    
    $rs = Database::search("SELECT * FROM `admin` WHERE `verification_code` = '".$vcode."'");
    $nr = $rs->num_rows;

    if($nr == 1){

        $admin_data = $rs->fetch_assoc();
        $_SESSION["a"] = $admin_data;
        echo "success";

    }else{
        echo "Verification code is not valid";
    }

}else{
    echo "Please enter the verification code";
}

?>