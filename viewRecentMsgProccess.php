<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    
    $user_email = $_SESSION["u"]["email"];
    
    $allMsgrs = Database::search("SELECT DISTINCT * FROM `massege` WHERE `to` = '".$user_email."' ORDER BY `date_time` LIMIT 1");
    $allMsgnr = $allMsgrs->num_rows;
    
    for($x=0;$x < $allMsgnr;$x++){
        $allMsgd = $allMsgrs->fetch_assoc();
        echo $allMsgd["email"];
    }

}else{
    echo "Please login to your account first";
}

?>