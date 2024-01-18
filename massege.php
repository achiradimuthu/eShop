<!DOCTYPE html>
<html>

<head>
    <title>eShop | Messeges</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

</head>

<body onload="viewRecent();" style="background-color: #74EBD5; background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <?php require "header.php";
            require "connection.php";
            $e = $_SESSION["u"]["email"];
            ?>

            <div class="col-12">
                <hr>
            </div>

            <div class="col-12 py-5 px-4">
                <div class="row rounded shadow overflow-hidden">
                    <div class="col-12 col-lg-5 px-0">
                        <div class="bg-bg-white">

                            <div class="bg-light px-4 py-2">
                                <h5 class="mb-0 py-1">Recent</h5>
                            </div>

                            <?php
                            $message_rs = Database::search("SELECT DISTINCT `from`,`content`,`date_time`,`status` FROM `massege` WHERE `to` = '" . $e . "'");
                            $message_nr = $message_rs->num_rows;
                            ?>

                            <div class="massege_box" id="massege_box">

                                <?php
                                for ($x = 0; $x < $message_nr; $x++) {
                                    $message_data = $message_rs->fetch_assoc();

                                    if ($message_data["status"] == "0") {

                                ?>
                                        <div class="list-group rounded-0" onclick="viewMessages(<?php echo $message_data['from']; ?>);">
                                            <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-info">

                                                <?php
                                                $user_rs = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON `user`.`email` = `profile_img`.`user_email` WHERE `email` = '" . $message_data["from"] . "'");
                                                $user_data = $user_rs->fetch_assoc();
                                                ?>

                                                <div>
                                                    <img src="<?php echo $user_data["code"] ?>" width="50px" class="rounded-circle">
                                                </div>
                                                <div class="me-4">
                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                        <h6 class="mb-0"><?php echo $user_data["fname"] . " " . $user_data["lname"] ?></h6>
                                                        <small class="small fw-bold"><?php echo $message_data["date_time"] ?></small>
                                                    </div>
                                                    <p class="mb-0"><?php echo $message_data["content"] ?></p>
                                                    <p class="invisible"><?php echo $message_data["from"] ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    <?php

                                    } else {

                                    ?>
                                        <div class="list-group rounded-0">
                                            <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-primary">
                                                <div>
                                                    <img src="resources/user.svg" width="50px" class="rounded-circle">
                                                </div>
                                                <div class="me-4">
                                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                                        <h6 class="mb-0">Nimal</h6>
                                                        <small class="small fw-bold">01:10</small>
                                                    </div>
                                                    <p class="mb-0">Got the product.</p>
                                                </div>
                                            </a>
                                        </div>
                                    <?php

                                    }

                                    ?>




                                <?php
                                }
                                ?>

                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-7 px-0">
                        <div class="row px-4 py-5 text-white chat_box">

                            <div class="col-12" style="height: 470px;">
                                <div class="row px-4 py-5 text-white chat_box" id="chat_box">
                                    <!-- message view aria -->
                                </div>
                            </div>

                            <!-- text -->

                            <div class="col-12">
                                <div class="row">
                                    <div class="input-group">
                                        <input type="text" placeholder="Type your massege...." aria-describedby="send_btn" class="form-control rounded-0 border-0 py-3 bg-light" id="msgTxt">
                                        <button id="send_btn" class="btn btn-link fs-2 bg-dark" onclick="sendMsg();"><i class="bi bi-send-fill"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- text -->

                        </div>
                    </div>

                </div>
            </div>

            <?php require "footer.php"; ?>

        </div>
    </div>


    <script src="script.js"></script>
</body>

</html>