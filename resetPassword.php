<?php

$e = $_POST["e"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];

require "connection.php";

if(empty($np)){
    echo "Enter a new password";
}elseif(strlen($np) < 5 || strlen($np) > 20){
    echo "Password's legnth must be 5 to 20";
}elseif(empty($rnp)){
    echo "Retype your new password";
}elseif($np != $rnp){
    echo "Retype your correct new password";
}elseif(empty($vc)){
    echo "Enter the Verification code";
}else{
    $r = Database::search("SELECT * FROM `user` WHERE `email` = '".$e."'");
    $n = $r->num_rows;

    if($n == 1){
        $d = $r->fetch_assoc();

        if($vc == $d["verification_code"]){

            Database::iud("UPDATE `user` SET `password` = '".$rnp."' WHERE `email` = '".$e."'");
            echo "Password is updated";
            

        }else{
            echo "Couldn't reset the password";
        }

    }else{
        echo "Invalid email";
    }
}

?>