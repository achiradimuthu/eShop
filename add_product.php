<?php

require "connection.php";

session_start();

if (isset($_SESSION["u"])) {

?>



    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop | Add Product</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg">

        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <div class="container-fluid">
            <div class="row gy-3">

                <div class="col-12">
                    <div class="col-12 mb-2">
                        <h3 class="h2 text-center text-primary">Product Listing</h3>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">

                            <span class="text-danger" id="msg"></span>

                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label label1">Select Product Catogery</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="ca">
                                            <option value="0">Select Catogery</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM `catogery`");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>

                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label label1">Select Product Brand</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="br">
                                            <option value="0">Select Brand</option>
                                            <?php

                                            $rs_brand = Database::search("SELECT * FROM `brand`");
                                            $n_brand = $rs_brand->num_rows;

                                            for ($y = 0; $y < $n_brand; $y++) {
                                                $d_brand = $rs_brand->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $d_brand["id"]; ?>"><?php echo $d_brand["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>

                                    </div>

                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label label1">Select Product Model</label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="mo">
                                            <option value="0">Select Model</option>
                                            <?php

                                            $rs_model = Database::search("SELECT * FROM `model`");
                                            $n_model = $rs_model->num_rows;

                                            for ($z = 0; $z < $n_model; $z++) {
                                                $d_model = $rs_model->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $d_model["id"]; ?>"><?php echo $d_model["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>

                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12 mb-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label label1">Add a title to your Product</label>
                                    </div>

                                    <div class="offset-lg-2 col-12 col-lg-8">
                                        <input type="text" class="form-control" id="ti">
                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12 mb-3">
                                <div class="row">

                                    <div class="col-12 col-lg-4">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label label1">Select Product Condition</label>
                                            </div>

                                            <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="bn" checked>
                                                <label class="form-check-label" for="bn">
                                                    Brandnew
                                                </label>
                                            </div>

                                            <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="us">
                                                <label class="form-check-label" for="us">
                                                    Used
                                                </label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label label1">Select Product Colour</label>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">

                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr1" checked>
                                                        <label class="form-check-label" for="clr">
                                                            Gold
                                                        </label>
                                                    </div>

                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr2">
                                                        <label class="form-check-label" for="clr">
                                                            Silver
                                                        </label>
                                                    </div>

                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr3">
                                                        <label class="form-check-label" for="clr">
                                                            Graphite
                                                        </label>
                                                    </div>

                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr4">
                                                        <label class="form-check-label" for="clr">
                                                            Pacific Blue
                                                        </label>
                                                    </div>

                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr5">
                                                        <label class="form-check-label" for="clr">
                                                            Jet Black
                                                        </label>
                                                    </div>

                                                    <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                        <input class="form-check-input" type="radio" name="clrRadio" id="clr6">
                                                        <label class="form-check-label" for="clr">
                                                            Rose Gold
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-4">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label label1">Add Product Quantity</label>
                                            </div>

                                            <div class="col-12">
                                                <input type="number" class="form-control" value="0" min="0" id="qty">
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12 mb-3">
                                <div class="row">

                                    <div class="col-12 col-lg-6">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label label1">Cost per Item</label>
                                            </div>

                                            <div class="col-12 input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="cost">
                                                <span class="input-group-text">.00</span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label label1">Approved Payment Methods</label>
                                            </div>

                                            <div class="col-12">
                                                <div class="row">

                                                    <div class="offset-2 col-2 pm1"></div>
                                                    <div class="col-2 pm2"></div>
                                                    <div class="col-2 pm3"></div>
                                                    <div class="col-2 pm4"></div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12 mb-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label label1">Delivery Costs</label>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="row">

                                            <div class="col-12 col-lg-3 offset-lg-1">
                                                <label class="form-label">Delivery cost within Colombo</label>
                                            </div>

                                            <div class="col-12 col-lg-7">
                                                <div class="col-12 input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="dwc">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <div class="row">

                                            <div class="col-12 col-lg-3 offset-lg-1">
                                                <label class="form-label">Delivery cost out of Colombo</label>
                                            </div>

                                            <div class="col-12 col-lg-7">
                                                <div class="col-12 input-group mb-3">
                                                    <span class="input-group-text">Rs.</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="doc">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12 mb-4">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label label1">Product Description</label>
                                    </div>

                                    <div class="col-12">
                                        <textarea class="form-control" cols="30" rows="25" id="desc"></textarea>
                                    </div>

                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12 mb-3">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label label1">Add Product Image</label>
                                    </div>
                                    <div class="col-12">
                                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thumbnail border border-primary" id="prev">
                                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thumbnail border border-primary">
                                        <img src="resources/addproductimg.svg" class="col-5 col-lg-2 ms-2 img-thumbnail border border-primary">
                                    </div>
                                    <div class="col-12 col-lg-6 mt-2 ms-2">
                                        <input type="file" class="d-none" accept="img/*" id="imageUplorder">
                                        <label for="imageUplorder" class="col-5 col-lg-4 btn btn-primary" onclick="ChangeProductImage();">Uplord</label>
                                    </div>


                                </div>
                            </div>

                            <hr class="hr-break-1">

                            <div class="col-12">
                                <label class="form-label label1">Notice</label>
                                <br />
                                <label class="form-label">We are taking 5% of the product price from every product as a service charge.</label>
                            </div>
                            <div class="col-12 col-lg-4 offset-lg-4 d-grid mb-2">
                                <button class="btn btn-success search-button mt-1" onclick="AddProduct();">Add Product</button>
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
    </body>

    </html>


<?php

} else {
?>
    <script>
        alert("You have to signin or Register.");
        window.location = "index.php";
    </script>
<?php
}

?>