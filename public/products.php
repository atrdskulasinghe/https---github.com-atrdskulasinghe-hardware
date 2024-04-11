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

$categoryIdUrl = "";
$minCost = "";
$maxCost = "";
$age1 = "";
$warrantyUrl = "";


$searchData = "";

if (isset($_GET['product_name'])) {
    if ($_GET['product_name'] !== "") {
        $searchData = $_GET['product_name'];
    }
}


if (isset($_GET['category_id'])) {
    if (!empty($_GET['category_id'])) {
        $categoryIdUrl = $_GET['category_id'];
    }
} else if (isset($_GET['min'])) {
    if (!empty($_GET['min'])) {
        if (isset($_GET['max'])) {
            if (!empty($_GET['max'])) {
                $minCost = $_GET['min'];
                $maxCost = $_GET['max'];
            }
        }
    }
} else if (isset($_GET['age'])) {

    if (!empty($_GET['age'])) {
        $age1 = $_GET['age'];
    }
} else if (isset($_GET['warranty'])) {
    if (!empty($_GET['warranty'])) {
        $warrantyUrl = $_GET['warranty'];
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
    <link rel="stylesheet" href="./assets/css/user-products.css">
    <link rel="stylesheet" href="./assets/css/user-product-list.css">
    <link rel="stylesheet" href="./assets/css/user-style.css">
    <link rel="stylesheet" href="./assets/css/button.css">
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
            <div class="box">
                <div class="product">
                    <div class="product-filter ">
                        <div class="product-filter-content">
                            <div class="filter-close">
                                <i class="bi bi-x"></i>
                            </div>
                            <h3>Category</h3>
                            <hr>
                            <div class="category-list">
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
                            <!-- <h3>Brand</h3>
                            <hr>
                            <div class="brand-list">
                                <ul>
                                    <li>
                                        <input type="checkbox" id="brand-1">
                                        <label for="brand-1">ORIN</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="brand-2">
                                        <label for="brand-2">Dimo Lumin</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="brand-3">
                                        <label for="brand-3">Fibit</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="brand-4">
                                        <label for="brand-4">kevilton</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="brand-5">
                                        <label for="brand-5">Orange</label>
                                    </li>
                                </ul>
                            </div> -->
                            <h3>Price</h3>
                            <hr>
                            <form class="price-content" method="get">
                                <input type="text" name="min" placeholder="Min" value="<?php echo $minCost ?>">
                                <span>-</span>
                                <input type="text" name="max" placeholder="Max" value="<?php echo $maxCost ?>">
                                <button type="submit">Apply</button>
                            </form>
                            <h3>Warranty Period</h3>
                            <hr>
                            <form class="warranty-list" method="get">
                                <select name="warranty" style="width: 100%; height:30px;outline:none; border-radius: 5px;">
                                    <?php
                                    for ($warranty = 0; $warranty <= 40; $warranty++) {
                                        echo "<option value=\"$warranty\">$warranty</option>";
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn" style="margin-top: 10px; margin-left:0; width:100%">Filter</button>
                            </form>
                        </div>
                    </div>
                    <div class="product-content">
                        <div class="filter-icon">
                            <i class="bi bi-filter-left"></i>
                            <p>Filter</p>
                        </div>
                        <div class="product-list">

                            <?php

                            if ($categoryIdUrl !== "") {
                                $selectItemQuery1 = "SELECT * FROM `item` WHERE `item_category` = '$categoryIdUrl'";
                                $resultItem = $conn->query($selectItemQuery1);

                                if ($resultItem->num_rows > 0) {
                                    while ($itemData = $resultItem->fetch_assoc()) {

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

                                            // $i += 1;
                                            $image_url = $itemImageData['image_url'];

                                            echo '
                                    
                                    <a href="product.php?item_id=' . $item_id . '" class="product-card">
                                        <div class="product-image">
                                            <img src="./assets/images/product/' . $image_url . '" alt="">
                                        </div>
                                        <div class="product-details">
                                            <p>' . $name . '</p>
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
                            } else if ($minCost !== "" && $maxCost !== "") {


                                $minCost = $conn->real_escape_string($minCost);
                                $maxCost = $conn->real_escape_string($maxCost);

                                $selectItemQuery1 = "SELECT * FROM `item` WHERE `price` BETWEEN '$minCost' AND '$maxCost'";
                                $resultItem = $conn->query($selectItemQuery1);

                                if ($resultItem->num_rows > 0) {
                                    while ($itemData = $resultItem->fetch_assoc()) {

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

                                            // $i += 1;
                                            $image_url = $itemImageData['image_url'];

                                            echo '
                                    
                                    <a href="product.php?item_id=' . $item_id . '" class="product-card">
                                        <div class="product-image">
                                            <img src="./assets/images/product/' . $image_url . '" alt="">
                                        </div>
                                        <div class="product-details">
                                            <p>' . $name . '</p>
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
                            } else if ($warrantyUrl !== "") {
                                $selectItemQuery1 = "SELECT * FROM `item` WHERE `warranty` = '$warrantyUrl'";
                                $resultItem = $conn->query($selectItemQuery1);

                                if ($resultItem->num_rows > 0) {
                                    while ($itemData = $resultItem->fetch_assoc()) {

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

                                            // $i += 1;
                                            $image_url = $itemImageData['image_url'];

                                            echo '
                                    
                                    <a href="product.php?item_id=' . $item_id . '" class="product-card">
                                        <div class="product-image">
                                            <img src="./assets/images/product/' . $image_url . '" alt="">
                                        </div>
                                        <div class="product-details">
                                            <p>' . $name . '</p>
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
                            } else if ($searchData !== "") {
                                $selectItemQuery1 = "SELECT * FROM `item` WHERE `name` LIKE '%$searchData%'";
                                $resultItem = $conn->query($selectItemQuery1);

                                if ($resultItem->num_rows > 0) {
                                    while ($itemData = $resultItem->fetch_assoc()) {

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

                                            // $i += 1;
                                            $image_url = $itemImageData['image_url'];

                                            echo '
                                    
                                    <a href="product.php?item_id=' . $item_id . '" class="product-card">
                                        <div class="product-image">
                                            <img src="./assets/images/product/' . $image_url . '" alt="">
                                        </div>
                                        <div class="product-details">
                                            <p>' . $name . '</p>
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
                            } else {

                                $selectItemQuery1 = "SELECT * FROM `item` WHERE 1";
                                $resultItem = $conn->query($selectItemQuery1);

                                if ($resultItem->num_rows > 0) {
                                    while ($itemData = $resultItem->fetch_assoc()) {

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

                                            // $i += 1;
                                            $image_url = $itemImageData['image_url'];

                                            echo '
                                    
                                    <a href="product.php?item_id=' . $item_id . '" class="product-card">
                                        <div class="product-image">
                                            <img src="./assets/images/product/' . $image_url . '" alt="">
                                        </div>
                                        <div class="product-details">
                                            <p>' . $name . '</p>
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
                            }

                            ?>

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
    <script src="./assets/js/user-products.js"></script>
</body>

</html>