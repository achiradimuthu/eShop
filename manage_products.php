<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>eShop | Manage Products</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <h2 class="text-primary fw-bold">Manage All Products</h2>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0  offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning">Search Products</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Product Image</span>
                    </div>
                    <div class="col-6 col-lg-2 bg-primary py-2">
                        <span class="fs-4 fw-bold text-white">Title</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Price</span>
                    </div>
                    <div class="col-2 bg-primary py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Quantity</span>
                    </div>
                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-4 col=lg-1 bg-white"></div>
                </div>
            </div>

            <?php

            $page_no;

            if (isset($_GET["page"])) {
                $page_no = $_GET["page"];
            } else {
                $page_no = 1;
            }

            $product_rs = Database::search("SELECT * FROM `product`");
            $product_nr = $product_rs->num_rows;

            $results_per_page = 20;
            $number_of_pages = ceil($product_nr / $results_per_page);

            $page_first_result = ((int)$page_no) * $results_per_page;
            $view_product_rs = Database::search("SELECT * FROM `product` LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "");
            $view_results_nr = $view_product_rs->num_rows;

            $c = 0;

            ?>

            <div class="col-12 mb-3">
                <div class="row">

                    <?php

                    while ($product_data = $product_rs->fetch_assoc()) {
                        $c = $c + 1;
                    ?>


                        <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                            <span class="fs-6 fw-bold text-white">01</span>
                        </div>
                        <?php

                        $img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $product_data["id"] . "'");
                        $img_data = $img_rs->fetch_assoc();

                        ?>
                        <div class="col-2 bg-light py-2 d-none d-lg-block" onclick="viewProductModel(<?php echo $product_data['id']; ?>);">
                            <img src="<?php echo $img_data["code"]; ?>" style="height: 40px; margin-left: 80px;">
                        </div>
                        <div class="col-6 col-lg-2 bg-primary py-2">
                            <span class="fs-6 fw-bold text-white"><?php echo $product_data["title"]; ?></span>
                        </div>
                        <div class="col-2 bg-light py-2 d-none d-lg-block">
                            <span class="fs-6 fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</span>
                        </div>
                        <div class="col-2 bg-primary py-2 d-none d-lg-block">
                            <span class="fs-6 fw-bold text-white"><?php echo $product_data["qty"]; ?></span>
                        </div>
                        <div class="col-2 bg-light py-2 d-none d-lg-block">
                            <span class="fs-6 fw-bold"><?php echo $product_data["date_time_added"]; ?></span>
                        </div>
                        <div class="col-4 col-lg-1 bg-white py-2 d-grid">
                            <?php

                            $s = $product_data["status_id"];

                            if ($s == '1') {
                            ?>
                                <button class="btn btn-danger" onclick="productBlock(<?php echo $product_data['id']; ?>);">Block</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-success" onclick="productBlock(<?php echo $product_data['id']; ?>);">Unblock</button>
                            <?php
                            }

                            ?>

                        </div>

                    <?php
                    }

                    ?>
                </div>
            </div>

            <div class="col-12 text-center">
                <div class="pagination">
                    <a href="<?php if ($page_no <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no - 1);
                                } ?>">&laquo;</a>
                    <?php

                    for ($page = 1; $page <= $number_of_pages; $page++) {
                        if ($page == $page_no) {
                    ?>
                            <a href="<?php echo "?page=" . ($page); ?>" class="active"><?php echo $page ?></a>
                        <?php
                        } else {
                        ?>
                            <a href="<?php echo "?page=" . ($page); ?>"><?php echo $page ?></a>
                    <?php
                        }
                    }

                    ?>

                    <a href="<?php if ($page_no >= $number_of_pages) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no + 1);
                                } ?>">&raquo;</a>
                </div>
            </div>

            <!-- model -->
            <div class="modal" tabindex="-1" id="viewproductdiv<?php echo $product_data['id']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="offset-lg-4 col-4">
                                <img src="resources/mobile images/iphone12.jpg" style="height: 150px;" class="img-fluid">
                            </div>
                            <div class="col-12">
                                <span class="fs-5 fw-bold">Price : </span>&nbsp;
                                <span class="fs-5">Rs. <?php echo $product_data["price"]; ?> .00</span><br>
                                <span class="fs-5 fw-bold">Quantity : </span>&nbsp;
                                <span class="fs-5"><?php echo $product_data["qty"]; ?> Products left</span><br>
                                <span class="fs-5 fw-bold">Seller : </span>&nbsp;
                                <?php

                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email` = `" . $product_data["user_email"] . "`");
                                $seller_data = $seller_rs->fetch_assoc();

                                ?>
                                <span class="fs-5">Kasun Tharaka</span><br>
                                <span class="fs-5 fw-bold">Description : </span>&nbsp;
                                <span class="fs-5">Good Product</span><br>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- model -->

            <hr>

            <div class="col-12 text-center">
                <h3 class="text-black-50">Manage Catogery</h3>
            </div>
            <div class="col-12 mb-3">
                <div class="row g-1">

                <?php
                        
                        $catogery_rs = Database::search("SELECT * FROM `catogery`");
                        $catogery_num = $catogery_rs->num_rows;

                        for($x = 0;$x < $catogery_num;$x++){
                            $catogery_data = $catogery_rs->fetch_assoc();
                        }
                        
                        ?>

                    <div class="col-12 col-lg-3 border border-danger ms-2" style="height: 50px;">
                        <div class="row g-1 px-1">

                            <div class="col-8 mt-1">
                                <label class="form-label fw-bold"><?php echo $catogery_data["name"]; ?></label>
                            </div>
                            <div class="col-4 border-start border-secondary text-center">
                                <label class="form-label fs-4"><i class="bi bi-trash-fill"></i></label>
                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-lg-3 border border-danger ms-2" style="height: 50px;">
                        <div class="row g-1 px-1">

                            <div class="col-8 mt-1">
                                <label class="form-label fw-bold">Add new Catogery</label>
                            </div>
                            <div class="col-4 border-start border-secondary text-center">
                                <label class="form-label fs-4" onclick="addNewCatogery();"><i class="bi bi-file-plus-fill"></i></i></label>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- model2 -->
            <div class="modal" tabindex="-1" id="addcatogerymodel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add new Catogery</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label class="form-label">New Catogery Name : </label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Your Email : </label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="catogeryVerifyModel();">Add Catogery</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- model2 -->

            <!-- model3 -->
            <div class="modal" tabindex="-1" id="addcatogeryverificationmodel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label class="form-label">Enter the verification code : </label>
                                <input type="text" class="form-control">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Verify & Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- model3 -->

        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>