<?php
require "connection.php";

$type = $_POST["t"];
$email = $_POST["e"];
$feedback = $_POST["f"];
$pid = $_POST["i"];

// echo $type;
// echo $email;
// echo $feedback;
// echo $pid;

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `feedback` (`user_email`,`product_id`,`feed`,`date`,`type`) VALUES ('".$email."','".$pid."','".$feedback."','".$date."','".$type."')");
echo "success";

?>