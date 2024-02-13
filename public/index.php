<?php
include "../config/database.php";

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        // header('location: index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ./cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        header('location: ./technician/index.php');
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        header('location: ./delivery-boy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        header('location: ./admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ./technical-team/index.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="./assets/css/user-nav-1.css">
    <link rel="stylesheet" href="./assets/css/user-nav-2.css">
    <link rel="stylesheet" href="./assets/css/user-menu.css">
    <link rel="stylesheet" href="./assets/css/user-search-bar.css">
    <link rel="stylesheet" href="./assets/css/user-footer.css">
    <link rel="stylesheet" href="./assets/css/user-product-list.css">
    <link rel="stylesheet" href="./assets/css/user-home.css">
    <link rel="stylesheet" href="./assets/css/user-style.css">
</head>

<body>
    <div class="container">
        <?php

        include "../template/user-nav.php";

        ?>
                <?php
            include "../template/user-menu.php";
        ?>
        <section>
            <div class="home">
                <div class="box">
                    <div class="home-header">
                        <div class="home-header-content-1">
                            <div class="header-content-1-header">
                                <i class="bi bi-filter-left"></i>
                                <h4>ALL CATEGORIES</h4>
                            </div>
                            <div class="header-content-1-content ">
                                <ul>
                                    <?php

                                    $selectItemCategoryQuery1 = "SELECT * FROM `item_category` WHERE 1";
                                    $result1 = $conn->query($selectItemCategoryQuery1);

                                    if ($result1->num_rows > 0) {
                                        while ($itemCategoryData = $result1->fetch_assoc()) {

                                            $itemCategoryName = $itemCategoryData['name'];
                                            $itemCategoryId = $itemCategoryData['item_catagory_id'];

                                            echo '
                                                <li>
                                                    <a href="products.php?category_id=' . $itemCategoryId . '">' . $itemCategoryName . '</a>
                                                </li>
                                    ';
                                        }
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                        <div class="home-header-content-2">
                            <div class="home-header-content-2-images">
                                <img src="./assets/images/ui/header-1.png" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="home-content-2 margin-top-40">
                        <h3>Top Products</h3>
                        <div class="product-list">

                            <?php

                            $selectItemQuery1 = "SELECT * FROM `item` WHERE 1";
                            $resultItem = $conn->query($selectItemQuery1);

                            $i = 0;

                            if ($resultItem->num_rows > 0) {
                                while ($itemData = $resultItem->fetch_assoc()) {


                                    if ($i == 5) {
                                        break;
                                    }

                                    $item_id = $itemData['item_id'];
                                    $item_category = $itemData['item_category'];
                                    $name = $itemData['name'];
                                    $price = $itemData['price'];
                                    $stock_quantity = $itemData['stock_quantity'];
                                    $creation_date = $itemData['creation_date'];
                                    $expiration_date = $itemData['expiration_date'];
                                    $brand = $itemData['brand'];
                                    $discount = $itemData['discount'];
                                    $warranty = $itemData['warranty'];
                                    $weight = $itemData['weight'];
                                    $manufacturer = $itemData['manufacturer'];
                                    $description = $itemData['description'];

                                    $selectItemImageQuery1 = "SELECT * FROM `item_image` WHERE `item_id` = '$item_id'";
                                    $resultItemImage = $conn->query($selectItemImageQuery1);

                                    if ($resultItemImage->num_rows > 0) {
                                        $itemImageData = $resultItemImage->fetch_assoc();

                                        $i += 1;
                                        $image_url = $itemImageData['image_url'];

                                        echo '
                                    
                                    <a href="product.php?item_id=' . $item_id . '" class="product-card">
                                        <div class="product-image">
                                            <img src="./assets/images/product/' . $image_url . '" alt="">
                                        </div>
                                        <div class="product-details">
                                            <p>' . $description . '</p>
                                            <h4>LKR.' . $price . '</h4>
                                            <div class="product-stars">
                                                <ul>
                                                    <li>
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>
                                                    <li>
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>
                                                    <li>
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>
                                                    <li>
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>
                                                    <li>
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>
                                                </ul>
                                                <span>(200)</span>
                                            </div>
                                        </div>
                                    </a>
                                    
                                    ';
                                    }
                                }
                            }



                            ?>

                        </div>
                    </div>
                </div>
                <div class="home-content-3">
                    <img src="./assets/images/ui/home.jpg" alt="">
                    <div class="box">
                        <div class="home-content-3-content">
                            <h4>Starting At Only $1,235</h4>
                            <h1>
                                Plaster Trowel<br>
                                PlasticHandle Steel
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="home-content-4">
                        <h3>Latest Products</h3>
                        <div class="home-content-4-content">
                            <div class="product-list">

                                <?php

                                $selectItemQuery1 = "SELECT * FROM `item` WHERE 1";
                                $resultItem = $conn->query($selectItemQuery1);

                                $i = 0;

                                if ($resultItem->num_rows > 0) {
                                    while ($itemData = $resultItem->fetch_assoc()) {


                                        if ($i == 5) {
                                            break;
                                        }

                                        $item_id = $itemData['item_id'];
                                        $item_category = $itemData['item_category'];
                                        $name = $itemData['name'];
                                        $price = $itemData['price'];
                                        $stock_quantity = $itemData['stock_quantity'];
                                        $creation_date = $itemData['creation_date'];
                                        $expiration_date = $itemData['expiration_date'];
                                        $brand = $itemData['brand'];
                                        $discount = $itemData['discount'];
                                        $warranty = $itemData['warranty'];
                                        $weight = $itemData['weight'];
                                        $manufacturer = $itemData['manufacturer'];
                                        $description = $itemData['description'];

                                        $selectItemImageQuery1 = "SELECT * FROM `item_image` WHERE `item_id` = '$item_id'";
                                        $resultItemImage = $conn->query($selectItemImageQuery1);

                                        if ($resultItemImage->num_rows > 0) {
                                            $itemImageData = $resultItemImage->fetch_assoc();

                                            $i += 1;
                                            $image_url = $itemImageData['image_url'];

                                            echo '
        
                                                <a href="product.php?item_id=' . $item_id . '" class="product-card">
                                                    <div class="product-image">
                                                        <img src="./assets/images/product/' . $image_url . '" alt="">
                                                    </div>
                                                    <div class="product-details">
                                                        <p>' . $description . '</p>
                                                        <h4>LKR.' . $price . '</h4>
                                                        <div class="product-stars">
                                                            <ul>
                                                                <li>
                                                                    <i class="bi bi-star-fill"></i>
                                                                </li>
                                                                <li>
                                                                    <i class="bi bi-star-fill"></i>
                                                                </li>
                                                                <li>
                                                                    <i class="bi bi-star-fill"></i>
                                                                </li>
                                                                <li>
                                                                    <i class="bi bi-star-fill"></i>
                                                                </li>
                                                                <li>
                                                                    <i class="bi bi-star-fill"></i>
                                                                </li>
                                                            </ul>
                                                            <span>(200)</span>
                                                        </div>
                                                    </div>
                                                </a>
                                                
                                                ';
                                        }
                                    }
                                }



                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>
    <script src="./assets/js/user-home.js"></script>
</body>

</html>