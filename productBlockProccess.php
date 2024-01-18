<?php

require "connection.php";

if(isset($_GET["id"])){
    $product_id = $_GET["id"];
    $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '".$product_id."'");
    $product_nr = $product_rs->num_rows;

    if($product_nr == 1){
        $product_data = $product_rs->fetch_assoc();
        $product_status = $product_data["status_id"];

        if($product_status == "1"){
            Database::iud("UPDATE `product` SET `status_id` = '2' WHERE `id` = '".$product_id."'");
            echo "success1";
        }elseif($product_status == "2"){
            Database::iud("UPDATE `product` SET `status_id` = '1' WHERE `id` = '".$product_id."'");
            echo "success2";
        }
    }
}

?>