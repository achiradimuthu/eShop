<?php
require "connection.php";

$pid = $_GET["id"];

$watchrs = Database::search("SELECT * FROM `watchlist` WHERE `product_id` = '".$pid."'");
$watchnum = $watchrs->num_rows;

if($watchnum == 0){
    echo "Sorry for the inconvinient........";
}else{
    $watchrow = $watchrs->fetch_assoc();

    $id = $watchrow["product_id"];
    $mail = $watchrow["user_email"];

    Database::iud("INSERT INTO `recent` (`product_id`,`user_email`) VALUES ('".$id."','".$mail."')");
    //insert product data to the recent table

    Database::iud("DELETE FROM `watchlist` WHERE `product_id` = '".$pid."'");
    echo "success";
}

?>