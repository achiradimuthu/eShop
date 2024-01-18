<?php

require "connection.php";

session_start();

if(isset($_SESSION["u"])){

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mobile = $_POST["mobile"];
    $addline1 = $_POST["addline1"];
    $addline2 = $_POST["addline2"];
    $usercity = $_POST["usercity"];
    $image = $_FILES["image"];

    if(isset($image)){

        $allowed_image_extention = array("image/jpg","image/jpeg","image/png","image/svg");
        $fileex = $image["type"];
        //echo $fileex;

        if(!in_array($fileex,$allowed_image_extention)){
            echo "please select a valid image";

        }else{

            $new_image_extention;
            if($fileex == "image/jpg"){
                $new_image_extention = ".jpg";
            }else if($fileex == "image/jpeg"){
                $new_image_extention = ".jpeg";
            }else if($fileex == "image/png"){
                $new_image_extention = ".png";
            }else if($fileex == "image/svg"){
                $new_image_extention = ".svg";
            }

            $file_name = "resources/profiles/".uniqid().$new_image_extention;
            //echo $file_name;

            move_uploaded_file($image["tmp_name"],$file_name);

            $profilers = Database::search("SELECT * FROM `profile_img` WHERE `user_email` = '".$_SESSION["u"]["email"]."'");
            $in = $profilers->num_rows;
            
            if($in == 1){

                //update
                Database::iud("UPDATE `profile_img` SET `code` = '".$file_name."' WHERE `user_email` = '".$_SESSION["u"]["email"]."'");

                echo "profile image updated successfuly";

            }else{

                //insert
                Database::iud("INSERT INTO `profile_img` (`code`,`user_email`) VALUES ('".$file_name."','".$_SESSION["u"]["email"]."')");
                echo "New profile image saved successfuly";
            }

        }


    }else{
        echo "Please Select an Image";
    }

    Database::iud("UPDATE `user` SET `fname` = '".$fname."',`lname` = '".$lname."',`mobile` = '".$mobile."' WHERE `email` = '".$_SESSION["u"]["email"]."'");
    
    echo "User has been updated";

    $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '".$_SESSION["u"]["email"]."'");
    $nrs = $addressrs->num_rows;
    echo $nrs;

    if($nrs == 1){

        //update
        Database::iud("UPDATE `user_has_address` SET `line1` = '".$addline1."',`line2` = '".$addline2."',`city_id` = '".$usercity."' WHERE `user_email` = '".$_SESSION["u"]["email"]."'");
        
        echo "Address updated Successfully";

    }else{

        //insert
        Database::iud("INSERT INTO `user_has_address` (`user_email`, `line1`, `line2`, `city_id`) VALUES ('".$_SESSION["u"]["email"]."','".$addline1."','".$addline2."','".$usercity."')");

        echo "New Address added successfuly";

    }

}else{
    echo "error";
}
