<?php

session_start();
require "connection.php";


$catogery = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["co"];
$color = $_POST["col"];
$qty = $_POST["qty"];
$price = $_POST["p"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$description = $_POST["dsc"];
//$image = $_FILES["img"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;
$usermail = $_SESSION["u"]["email"];

if ($catogery == 0) {
    echo "Please select a catogery";
} elseif ($brand == 0) {
    echo "Please select a brand";
} elseif ($model == 0) {
    echo "Please select a model";
} elseif (empty($title)) {
    echo "Please add a title to your product";
} elseif (strlen($title) > 100) {
    echo "Please enter a title contain 100 characters or lower";
} elseif ($qty == 0 || $qty == "e" || $qty < 0) {
    echo "Please enter a valid quantity";
} elseif (empty($price)) {
    echo "Please enter a price to your product";
} elseif (is_int($price)) {
    echo "Please enter a valid price to your product";
} elseif (empty($dwc)) {
    echo "Please enter a price to delivery within colombo";
} elseif (is_int($dwc)) {
    echo "Please enter a valid price to delivery within colombo";
} elseif (empty($doc)) {
    echo "Please enter a price to delivery outside colombo";
} elseif (is_int($doc)) {
    echo "Please enter a valid price to delivery outside colombo";
} elseif (empty($description)) {
    echo "Please enter description to your product";
} else {

    $modelHasBrand = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id` = '" . $brand . "' AND `model_id` = '" . $model . "'");

    if ($modelHasBrand->num_rows == 0) {
        echo "This product does not exists";
    } else {

        $f = $modelHasBrand->fetch_assoc();
        $modelHasBrandId = $f["id"];

        Database::iud("INSERT INTO `product` (`catogery`,`modal_has_brand`,`colour`,`price`,`qty`,`description`,`title`,`condition_id`,`status_id`,`user_email`,`date_time_added`,`delivery_fee_colombo`,`delivery_fee_other`) VALUES ('" . $catogery . "','" . $modelHasBrandId . "','" . $color . "','" . $price . "','" . $qty . "','" . $description . "','" . $title . "','" . $condition . "','" . $status . "','" . $usermail . "','" . $date . "','" . $dwc . "','" . $doc . "')");
        //echo "product added successfuly";

        $last_id = Database::$connection->insert_id;

        $allowed_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");

        if (isset($_FILES["img"])) {
            $image = $_FILES["img"];
        }

        if (isset($image)) {

            $file_extention = $image["type"];

            if (in_array($file_extention, $allowed_image_extention)) {

                $new_image_extention;
                if ($file_extention == "image/jpg") {
                    $new_image_extention = ".jpg";
                } else if ($file_extention == "image/jpeg") {
                    $new_image_extention = ".jpeg";
                } else if ($file_extention == "image/png") {
                    $new_image_extention = ".png";
                } else if ($file_extention == "image/svg") {
                    $new_image_extention = ".svg";
                }

                $file_name = "resources/products/" . uniqid() . $image["name"].$new_image_extention;
                move_uploaded_file($image["tmp_name"], $file_name);

                Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('" . $file_name . "','" . $last_id . "')");
            } else {
                echo "Please select a valid image";
            }
        } else {
            echo "Please select an image";
        }
    }
}
