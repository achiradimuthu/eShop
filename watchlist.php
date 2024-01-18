<?php

require "connection.php";



?>


<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eShop | Watch List</title>

    <link rel="icon" href="resources/logo.svg">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php
            require "header.php";

            if (isset($_SESSION["u"])) {

                $mail = $_SESSION["u"]["email"];

            ?>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 border border-1 border-secondary rounded">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fs-1 fw-bold">Watchlist <i class="bi bi-heart fs-1"></i></label>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <hr class="hr-break-1">
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Search in watchlist...">
                                        </div>
                                        <div class="col-12 col-lg-2 d-grid mb-3">
                                            <button class="btn btn-outline-primary">Search</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1">
                                </div>

                                <div class="col-11 col-lg-2 border border-start-0 border-top-0 border-bottom-0 border-end border-primary mt-3 mb-3">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link" aria-current="page" href="#">Active</a>
                                        <a class="nav-link active" href="watchlist.php">My watchlist</a>
                                        <a class="nav-link" href="cart.php">My cart</a>
                                        <a class="nav-link disabled">Recently View</a>
                                    </nav>
                                </div>

                                <?php

                                $products = Database::search("SELECT * FROM `watchlist` WHERE `user_email` = '" . $mail . "'");
                                $productcount = $products->num_rows;

                                if ($productcount == 0) {
                                ?>
                                    <!-- no items -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row">
                                            <div class="col-12 emptyview"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bolder mb-3">You have no items in your watchlist yet.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- no items -->
                                <?php
                                } else {
                                ?>

                                    <!-- item -->
                                    <div class="col-12 col-lg-9">
                                        <div class="row g-2">

                                            <?php

                                            for ($x = 0; $x < $productcount; $x++) {
                                                $product = $products->fetch_assoc();
                                                $product_id = $product["product_id"];
                                                $prod_details = Database::search("SELECT * FROM `product` WHERE `id` = '" . $product_id . "'");
                                                $pn = $prod_details->num_rows;
                                                if ($pn == 1) {
                                                    $pf = $prod_details->fetch_assoc();
                                                    $pid = $pf["id"];
                                            ?>

                                                    <!-- card -->
                                                    <div class="card mb-3 mx-0 mx-lg-2  col-12">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">
                                                                <?php
                                                                $imgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pf["id"] . "'");
                                                                $dimgrs = $imgrs->fetch_assoc();
                                                                ?>
                                                                <img src="<?php echo $dimgrs["code"]; ?>" class="img-fluid rounded-start">
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><?php echo $pf["title"]; ?></h5>


                                                                    <!-- <span class="fw-bold text-black-50">Colour : Pacific Blue</span>&nbsp; -->

                                                                    <br />
                                                                    <?php
                                                                    $conditionrs = Database::search("SELECT * FROM `condition` WHERE `id` = '" . $pf["condition_id"] . "'");
                                                                    $dconditionrs = $conditionrs->fetch_assoc();
                                                                    ?>
                                                                    &nbsp;<span class="fw-bold text-black-50">Condition : <?php echo $dconditionrs["name"] ?></span>
                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5">Price : </span>&nbsp;
                                                                    <span class="fw-bold text-black-50 fs-5"><?php echo $pf["price"]; ?></span>
                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                                    <br />
                                                                    <?php
                                                                    $userrs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $pf["user_email"] . "'");
                                                                    $duserrs = $userrs->fetch_assoc();
                                                                    ?>
                                                                    <span class="fw-bold text-black-50 fs-5"><?php echo $duserrs["fname"]." ".$duserrs["lname"] ?></span>&nbsp;
                                                                    <br />
                                                                    <span class="fw-bold text-black-50 fs-5"><?php echo $pf["user_email"]; ?></span>&nbsp;


                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 mt-4">
                                                                <div class="card-body d-grid">
                                                                    <a href="#" class="btn btn-outline-success mb-2">Buy now</a>
                                                                    <a href="#" class="btn btn-outline-warning mb-2" onclick="addToCart(<?php echo $product['id']; ?>);">Add Cart</a>
                                                                    <a href="#" class="btn btn-outline-danger mb-2" onclick="deleteFromWatchlist(<?php echo $product_id; ?>);">Remove</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- card -->

                                            <?php
                                                }
                                            }

                                            ?>


                                        </div>
                                    </div>

                                <?php
                                }

                                ?>






                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </div>
    </div>
    </div>
    </div>

    <?php
                require "footer.php";
    ?>

    </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>

<?php
            } else {
                echo "You have to signin first";
            }

?>