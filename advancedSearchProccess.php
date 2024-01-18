<?php

require "connection.php";

$search = $_POST["s"];
$catogery = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort = $_POST["sort"];

$query = "SELECT * FROM `product`";
$status = 0;



if (!empty($search)) {
    $query .= "WHERE `title` LIKE '%" . $search . "%'";
    $status = 1;
}

if ($catogery != "0" && $status == 0) {
    $query .= "WHERE `catogery` = '" . $catogery . "'";
    $status = 1;
} elseif ($catogery != "0" && $status == 1) {
    $query .= "AND `catogery` = '" . $catogery . "'";
}

$status2 = 0;
if ($brand != "0" || $model != "0") {
    $modelHasBrandId = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_id` = '" . $brand . "' OR `model_id` = '" . $model . "'");
    $n = $modelHasBrandId->num_rows;

    if ($n == "1") {
        $f = $modelHasBrandId->fetch_assoc();
        $i = $f["id"];
        $status2 = 1;
    } else {
        $status2 = 0;
    }
} else {
    $status2 = 0;
}

if ($status2 == 1) {
    $query .= "AND `model_has_brand` = '" . $i . "'";
}

if ($condition != "0" && $status == 0) {
    $query .= "WHERE `condition_id` = '" . $condition . "'";
    $status = 1;
} elseif ($condition != "0" && $status == 1) {
    $query .= "AND `condition_id` = '" . $condition . "'";
}

if ($color != "0" && $status == 0) {
    $query .= "WHERE `colour` = '" . $color . "'";
    $status = 1;
} elseif ($color != "0" && $status == 1) {
    $query .= "AND `colour` = '" . $color . "'";
}

if ($status == "0") {
    if (!empty($price_from) && empty($price_to)) {
        $query .= "WHERE `price` >= '" . $price_from . "'";
        $status = 1;
    } elseif (empty($price_from) && !empty($price_to)) {
        $query .= "WHERE `price` <= '" . $price_to . "'";
        $status = 1;
    } elseif (!empty($price_from) && !empty($price_to)) {
        $query .= "WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        $status = 1;
    }
} elseif ($status == "1") {
    if (!empty($price_from) && empty($price_to)) {
        $query .= "AND `price` >= '" . $price_from . "'";
        $status = 1;
    } elseif (empty($price_from) && !empty($price_to)) {
        $query .= "AND `price` <= '" . $price_to . "'";
        $status = 1;
    } elseif (!empty($price_from) && !empty($price_to)) {
        $query .= "AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        $status = 1;
    }
}


if($sort == 0){

}elseif($sort == 1){

    $query .= " ORDER BY `price` ASC "; 

}elseif($sort == 2){

    $query .= " ORDER BY `price` DESC "; 
    
}elseif($sort == 3){

    $query .= " ORDER BY `qty` ASC "; 
    
}elseif($sort == 4){

    $query .= " ORDER BY `qty` DESC "; 
    
}

$query1 = $query;



?>

<div class="row">
    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php

            if ("0" != ($_POST["page"])) {

                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $products = Database::search($query);
            $nProducts = $products->num_rows;
            $userProducts = $products->fetch_assoc();

            $results_per_page = 6;
            $number_of_pages = ceil($nProducts / $results_per_page);

            $viewed_result_count = ((int)$pageno - 1) * $results_per_page;
            $query1 .= "LIMIT " . $results_per_page . " OFFSET " . $viewed_result_count . "";
            $selectedrs = Database::search($query1);
            $srn = $selectedrs->num_rows;

            while ($ps = $selectedrs->fetch_assoc()) {



            ?>

                <div class="card mb-3 mt-3 col-12 col-lg-6">
                    <div class="row">
                        <div class="col-md-4 mt-4">

                            <?php
                            
                            $pimg = Database::search("SELECT * FROM `images` WHERE `product_id` = '".$ps["id"]."'");
                            $presult = $pimg->fetch_assoc();

                            ?>

                            <img src="<?php echo $presult["code"]; ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">

                                <h5 class="card-title fw-bold"><?php echo $ps["title"]; ?></h5>
                                <span class="card-text text-primary fw-bold"><?php echo $ps["price"]; ?></span>
                                <br />
                                <span class="card-text text-success fw-bold fs"><?php echo $ps["qty"]; ?> Items Left</span>

                                <div class="row">
                                    <div class="col-12">

                                        <div class="row g-1">
                                            <div class="col-12 col-lg-4 d-grid">
                                                <a href="#" class="btn btn-success fs">Buy Now</a>
                                            </div>
                                            <div class="col-12 col-lg-4 d-grid">
                                                <a href="#" class="btn btn-danger fs">Add Cart</a>
                                            </div>
                                            <div class="col-12 col-lg-4 d-grid">
                                                <a href="#" class="btn btn-light fs"><i class="bi bi-heart-fill fs-1"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>


        </div>
    </div>

    <div class="offset-0 offset-lg-4 col-12 col-lg-4 mb-3">
        <div class="row">

            <div class="pagination">
                <a <?php if($pageno <= 1){
                    echo "#";
                }else{

                    ?> onclick="advancedSearch('<?php echo ($pageno - 1); ?>');" <?php

                } ?>>&laquo;</a>
                <?php
                
                for($page = 1;$page <= $number_of_pages;$page++){
                    if($page == $pageno){
                        ?>
                        <a onclick="advancedSearch(<?php echo $page; ?>);" class="active"><?php echo $page; ?></a>
                        <?php
                    }else{
                        ?>
                        <a onclick="advancedSearch(<?php echo $page; ?>);"><?php echo $page; ?></a>
                        <?php
                    }
                }
                
                ?>
                
                <a <?php if($pageno <= $number_of_pages){
                    echo "#";
                }else{

                    ?> onclick="advancedSearch('<?php echo ($pageno + 1); ?>');" <?php

                } ?>>&raquo;</a>
            </div>

        </div>
    </div>

</div>