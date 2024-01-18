<?php


require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eShop | Cart</title>

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

            if (isset($_SESSION["u"]["email"])) {
                $mail = $_SESSION["u"]["email"];

                $total = "0";
                $subtotal = "0";
                $shiping = 0;


            ?>

                <div class="col-12 pt-2" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 border border-1 border-secondary rounded mb-3">
                    <div class="row">

                        <div class="col-12">
                            <label class="form-label fs-1 fw-bold">Basket <i class="bi bi-cart3 fs-2"></i></label>
                        </div>

                        <div class="col-12 col-lg-6">
                            <hr class="hr-break-1">
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6 offset-0 offset-lg-2 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in basket">
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <hr class="hr-break-1">
                        </div>

                        <?php

                        $cartrs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $mail . "'");
                        $cartnum = $cartrs->num_rows;

                        if ($cartnum == 0) {
                        ?>

                            <!-- empty -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptycart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1">You have no items in your basket</label>
                                    </div>
                                    <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid mb-4">
                                        <a href="#" class="btn btn-primary fs-3">Start Shopping</a>
                                    </div>
                                </div>
                            </div>
                            <!-- empty -->

                            <?php
                        } else {

                            for ($x = 0; $x < $cartnum; $x++) {
                                $cartrow = $cartrs->fetch_assoc();

                                $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '".$cartrow["product_id"]."'");
                                $productrow = $productrs->fetch_assoc();

                                $userrs = Database::search("SELECT * FROM `user` WHERE `email` = '".$productrow["user_email"]."'");
                                $userrow = $userrs->fetch_assoc();

                            ?>

                                <!-- have product -->
                                <div class="col-12 col-lg-9">
                                    <div class="row">

                                        <div class="card mb-3 mx-0 col-12">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $userrow["fname"]." ".$userrow["lname"] ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-4">

                                                    <img src="resources/cart/emptycart.svg" class="img-fluid rounded-start" style="max-width: 200px;">
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title"><?php echo $productrow["title"]; ?></h3>

                                                        <span class="fw-bold text-black-50">Colour : Gold</span> &nbsp; |

                                                        &nbsp; <span class="fw-bold text-black-50">Condition : Brandnew</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.<?php echo $productrow["price"]; ?>.00</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                        <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" value="xxxxxxxxxxxxxxxxxxxxxxxxxx">
                                                        <br><br>
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.250.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">
                                                        <a class="btn btn-outline-success mb-2">Buy Now</a>
                                                        <a class="btn btn-outline-danger mb-2">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs.300000.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- have product -->

                        <?php

                            }
                        }

                        ?>





                        <div class="col-12 col-lg-3">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fs-3 fw-bold">Summery</label>
                                </div>

                                <div class="col-12">
                                    <hr>
                                </div>

                                <div class="col-6 mb-1">
                                    <span class="fs-6 fw-bold">Items (2)</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="fs-6 fw-bold">Rs. 200000 .00</span>
                                </div>

                                <div class="col-6 mb-1">
                                    <span class="fs-6 fw-bold">Shipping</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="fs-6 fw-bold">Rs. 450 .00</span>
                                </div>

                                <div class="col-12 mt-3">
                                    <hr>
                                </div>

                                <div class="col-6 nt-2">
                                    <span class="fs-4 fw-bold">Total</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="fs-6 fw-bold">Rs. 450 .00</span>
                                </div>

                                <div class="col-12 mt-3 mb-3 d-grid">
                                    <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
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
</body>

</html>

<?php
            }
?>