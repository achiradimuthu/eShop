<?php
session_start();
require "connection.php";

$reciver_email = $_SESSION["u"]["email"];
$sender_email = $_GET["email"];

$messge_rs = Database::search("SELECT * FROM `message` WHERE `from` = '" . $sender_email . "' OR `to` = '" . $sender_email . "'");
$message_nr = $messge_rs->num_rows;

for ($x = 0; $x < $message_nr; $x++) {

    $message_data = $messge_rs->fetch_assoc();

    if ($message_data["from"] == $sender_email & $message_data["to"] == $reciver_email) {

?>
        <!-- Reciver massege -->

        <div class="mb-3 w-50">
            <img src="resources/user.svg" style="width: 50px;" class="rounded-circle mb-1">
            <div>
                <div class="bg-light rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-dark"><?php echo $message_data["content"]; ?></p>
                </div>
                <p class="small text-black-50 text-end">01:12 | 10.05.2022</p>
                <p class="invisible" id="rmail"><?php echo $message_data["from"]; ?></p>
            </div>
        </div>

        <!-- Reciver massege -->
    <?php

    } else if ($message_data["from"] == $reciver_email & $message_data["to"] == $sender_email) {

    ?>
        <!-- sender massege -->

        <div class="mb-3 w-50">
            <div>
                <div class="bg-primary rounded py-2 px-3 mb-2">
                    <p class="mb-0 text-white"><?php echo $message_data["content"]; ?></p>
                </div>
                <p class="small text-black-50 text-end">01:10 | 10.05.2022</p>
            </div>
        </div>

        <!-- sender massege -->
<?php

    }

    Database::iud("UPDATE `message` SET `status` = '1' WHERE `from` = '" . $sender_email . "' AND `to` = '" . $sender_email . "'");

}

?>