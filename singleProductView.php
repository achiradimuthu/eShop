<?php
session_start();
// echo $_GET["id"];

require "connection.php";

if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $productrs = Database::search("SELECT product.id,product.catogery,product.modal_has_brand,product.title,product.colour,product.price,product.qty,product.description,product.condition_id,product.status_id,product.user_email,product.date_time_added,product.delivery_fee_colombo,product.delivery_fee_other,model.name AS `mname`,brand.name AS `bname` FROM product INNER JOIN model_has_brand ON model_has_brand.id=product.modal_has_brand INNER JOIN brand ON brand.id = model_has_brand.brand_id INNER JOIN model ON model_has_brand.model_id=model.id WHERE product.id= '" . $pid . "'");

    $pn = $productrs->num_rows;

    if ($pn == 1) {
        $pd = $productrs->fetch_assoc();

?>



        <!DOCTYPE html>
        <html>

        <head>
            <title>eShop | Single Product View</title>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="icon" href="resources/logo.svg">

            <link rel="stylesheet" href="bootstrap.css">
            <link rel="stylesheet" href="style.css">

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

        </head>

        <body>

            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 mt-0 singleproduct">
                        <div class="row">

                            <div class="bg-white" style="padding: 11px;">
                                <div class="row">

                                    <div class="col-lg-2 order-lg-1 order-2">

                                        <ul>
                                            <?php

                                            $title = $pd["title"];
                                            $imagers = Database::search("SELECT * FROM images INNER JOIN product ON product.id=images.product_id WHERE product.title='" . $title . "'");

                                            $in = $imagers->num_rows;
                                            $img;

                                            if (!empty($in)) {
                                                for ($x = 0; $x < $in; $x++) {
                                                    $d = $imagers->fetch_assoc();
                                                    if ($x == 0) {
                                                        $img = $d["code"];
                                                    }
                                            ?>
                                                    <li class="mb-1 d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                        <img src="<?php echo $d["code"]; ?>" height="150px" class="mt-1 mb-1" id="pimg<?php echo $x; ?>" onclick="loadmainimg(<?php echo $x; ?>);">
                                                    </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="mb-1 d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1">
                                                </li>
                                                <li class="mb-1 d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1">
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                    <img src="resources/empty.svg" height="150px" class="mt-1 mb-1">
                                                </li>
                                            <?php
                                            }

                                            ?>

                                        </ul>

                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="align-items-center border border-1 border-secondary">
                                            <div style="background-image: url('<?php echo $img; ?>'); background-repeat: no-repeat; background-size: contain; height: 480px;" id="mainimg"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">

                                                <nav>
                                                    <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                        <li class="breadcrumb-item">
                                                            <a href="home.php">Home</a>
                                                        </li>
                                                        <li class="breadcrumb-item">
                                                            <a href="#" class="text-decoration-none text-black-50 fw-bold">Single Product View</a>
                                                        </li>
                                                    </ol>
                                                </nav>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fs-4 fw-bold mt-0"><?php echo $pd["title"]; ?></label>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-1">
                                                    <span class="badge">
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                        <i class="fa fa-star-half mt-1 text-warning fs-6"></i>

                                                        <label class="text-dark fs-6">4.5 Stars</label>
                                                        <label class="text-dark fs-6">35 | 35 Ratings & Reviews</label>
                                                    </span>
                                                </div>

                                                <div class="col-12 d-inline-block">
                                                    <label class="fw-bold fs-4 mt-1"> Rs. <?php echo $pd["price"]; ?> .00</label>&nbsp;&nbsp;
                                                    <label class="fw-bold fs-6 mt-1 text-danger"><del>Rs. <?php echo $pd["price"] + $pd["price"] / 100 * 5; ?> .00</del></label>
                                                </div>

                                                <hr class="hr-break-1">

                                                <div class="col-12">
                                                    <label class="text-primary fs-6 fw-bold">Warrenty : 06 month warrenty</label><br>
                                                    <label class="text-primary fs-6"><b>Return Policy : </b>01 Month Return Policy</label><br>
                                                    <label class="text-primary fs-6"><b class="text-success">In Stock : </b><?php echo $pd["qty"]; ?> Items Left</label>
                                                </div>

                                                <hr class="hr-break-1">

                                                <div class="col-12">
                                                    <?php

                                                    $userrs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $pd["user_email"] . "'");
                                                    $userd = $userrs->fetch_assoc();

                                                    ?>
                                                    <label class="text-dark fs-3 fw-bold mb-3">Seller's Details</label><br>
                                                    <label class="text-success fs-6 fw-bold">Seller's Name : <?php echo $userd["fname"] . " " . $userd["lname"] ?></label><br>
                                                    <label class="text-success fs-6 fw-bold">Seller's Email : <?php echo $userd["email"] ?></label><br>
                                                    <label class="text-success fs-6 fw-bold">Seller's Mobile : <?php echo $userd["mobile"] ?></label><br>
                                                </div>

                                                <hr class="hr-break-1">

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-8 rounded border border-1 border-primary mt-1 pt-2">
                                                            <div class="row">
                                                                <div class="col-md-3 col-sm-3 col-lg-1">
                                                                    <img src="resources/pricetag.png" height="70%">
                                                                </div>
                                                                <div class="col-md-9 col-sm-9 mt-1 pe-4 col-lg-11">
                                                                    <label class="mt-2">Stand a chance to get instant 5% discount by using VISA.</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-6" style="margin-top: 15px;">
                                                            <div class="row">
                                                                <div class="border border-1 border-secondary rounded overflow-hidden float-start mt-1 position-relative product_qty">
                                                                    <div class="col-12">
                                                                        <span>Qty : </span>
                                                                        <input type="number" class="border-0 fs-6 fw-bold text-start" pattern="[0-9]" value="1" id="qty_box">
                                                                        <div class="position-absolute qty_buttons">
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_inc" onclick="increase(<?php echo $pd["qty"]; ?>);">
                                                                                <i class="fas fa-chevron-up"></i>
                                                                            </div>
                                                                            <div class="d-flex flex-column align-items-center border border-1 border-secondary qty_dec" onclick="dicrease(<?php echo $pd["qty"]; ?>);">
                                                                                <i class="fas fa-chevron-down"></i>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mt-1">
                                                                <div class="row">

                                                                    <div class="col-4 col-lg-5 d-grid">
                                                                        <button class="btn btn-primary">Add To Cart</button>
                                                                    </div>
                                                                    <div class="col-4 col-lg-5 d-grid">
                                                                        <button class="btn btn-success" onclick="">Buy Now</button>
                                                                    </div>
                                                                    <div class="col-4 col-lg-2 d-grid">
                                                                        <button class="btn btn-light">
                                                                            <i class="fas fa-heart fs-4 mt-1"></i>
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                        <div class="col-md-6">
                                            <span class="fs-3 fw-bold">Related Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 bg-white">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row p-2" style="text-align: justify;">

                                                <?php
                                                $prod = Database::search("SELECT * FROM `product` WHERE `modal_has_brand` = '" . $pd["modal_has_brand"] . "' AND `modal_has_brand` != '" . $pd["modal_has_brand"] . "' LIMIT 5");
                                                $bds = $prod->num_rows;
                                                ?><script>
                                                    alert($pd["modal_has_brand"]);
                                                </script><?php

                                                            for ($y = 0; $y < $bds; $y++) {
                                                                $pdf = $prod->fetch_assoc();
                                                            ?>
                                                    <div class="card me-1" style="width: 18rem;">
                                                        <?php
                                                                $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pdf["id"] . "'");
                                                                $pimgf = $pimgrs->fetch_assoc();
                                                        ?>

                                                        <img src="<?php $pimgf["code"]; ?>" class="card-img-top" alt="..." />

                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $pdf["title"]; ?></h5>
                                                            <p class="card-text">Rs.100000.00</p>
                                                            <a href="#" class="btn btn-primary fsm2">Add cart</a>
                                                            <a href="#" class="btn btn-primary fsm2">Buy

                                                                Now</a>

                                                            <a href="#" class="mt-2 fs-6"><i class="fas fa-heart mt-1 fs-4 text-black-50"></i></a>


                                                        </div>
                                                    </div>
                                                <?php
                                                            }
                                                ?>



                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-6 bg-white">
                                            <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                                <div class="col-md-6">
                                                    <span class="fs-3 fw-bold">Product Deatails</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 bg-white">
                                            <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                                <div class="col-md-6">
                                                    <span class="fs-3 fw-bold">Send Feedback</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>





                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-6 bg bg-white">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <label class="form-label fw-bold">Brand</label>
                                                        </div>
                                                        <div class="col-10">
                                                            <label class="form-label">Apple</label>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-2">
                                                            <label class="form-label fw-bold">Model</label>
                                                        </div>
                                                        <div class="col-10">
                                                            <label class="form-label">iPhone 12</label>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-2">
                                                            <label class="form-label fw-bold">Description</label>
                                                        </div>
                                                        <div class="col-10">
                                                            <textarea class="form-label" cols="60" rows="10" disabled><?php echo $pd["description"]; ?></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 border border-1 border-secondary">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-3">
                                                            <label class="form-label">Feedback Type</label>
                                                        </div>

                                                        <div class="col-12 col-lg-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r1" checked>
                                                                <label class="form-check-label" for="r1">
                                                                    Positive
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-lg-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r2">
                                                                <label class="form-check-label" for="r2">
                                                                    Neutral
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-lg-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="r3">
                                                                <label class="form-check-label" for="r3">
                                                                    Negative
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <label class="form-label fw-bold">Customer's email</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <input id="e" type="email" class="form-control" value="<?php echo $_SESSION["u"]["email"]; ?>">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mt-3 mb-3">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <label class="form-label fw-bold">Customer's feedback</label>
                                                                </div>
                                                                <div class="col-8">
                                                                    <textarea id="f" class="form-control" cols="30" rows="8"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="offset-lg-2 col-12 col-lg-8 d-grid mt-2 mb-2">
                                                            <button class="btn btn-outline-primary" onclick="saveFeed(<?php echo $pid; ?>);">Send feedback</button>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr class="border-secondary">
                                        </div>

                                        <div class="col-12">
                                            <div class="row g-2">

                                                <?php
                                                $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id` = '" . $pid . "'");
                                                $feedback_nr = $feedback_rs->num_rows;

                                                for ($x = 0; $x < $feedback_nr; $x++) {
                                                    $feedback_data = $feedback_rs->fetch_assoc();
                                                ?>

                                                    <div class="col-12 col-lg-3 bg-white border border-1 border-danger rounded">
                                                        <div class="row">

                                                            <div class="col-12 text-center">
                                                                <span class="fs-5 fw-bold text-primary">Achira</span>
                                                                <br>
                                                                <span class="fs-6 fw-bold text-secondary">achira@gmail.com</span>
                                                            </div>

                                                            <div class="offset-1 col-10 text-center border border-1 border-warning rounded overflow-auto mt-2" style="height: 100px;">
                                                                <p class="fs-6 text-black">
                                                                    asjkbjhbsjhga hkskj kjslh
                                                                </p>
                                                            </div>

                                                            <div class="col-12 text-center mt-2">
                                                                <span class="fs-6 text-black-50 fw-bold">13-07-2022 10:00:00</span>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="row">

                                                                    <?php
                                                                    if ($feedback_data["type"] == "1") {

                                                                    ?>
                                                                        <div class="offset-3 col-6 btn-success text-center">
                                                                            <span class="fs-5 fw-bold text-white">Positive feedback</span>
                                                                        </div>
                                                                    <?php

                                                                    } else if ($feedback_data["type"] == "2") {

                                                                    ?>
                                                                        <div class="offset-3 col-6 btn-warning text-center">
                                                                            <span class="fs-5 fw-bold text-white">Neutral feedback</span>
                                                                        </div>
                                                                    <?php

                                                                    } else if ($feedback_data["type"] == "3") {

                                                                    ?>
                                                                        <div class="offset-3 col-6 btn-danger text-center">
                                                                            <span class="fs-5 fw-bold text-white">Negative feedback</span>
                                                                        </div>
                                                                    <?php

                                                                    }
                                                                    ?>


                                                                </div>
                                                            </div>

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



            <script src="script.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        </body>

        </html>

<?php

    }
} else {
}

?>