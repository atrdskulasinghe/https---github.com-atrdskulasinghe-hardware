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

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

$item_id = "";
$item_category = "";
$name = "";
$price = "";
$stock_quantity = "";
$creation_date = "";
$expiration_date = "";
$brand = "";
$discount = "";
$warranty = "";
$weight = "";
$manufacturer = "";
$description = "";
$image1 = "";
$image2 = "";
$image3 = "";
$image4 = "";
$image5 = "";
$itemCategoryna = "";

if (isset($_GET['item_id'])) {
    if (!empty($_GET['item_id'])) {
        $item_id = $_GET['item_id'];
    } else {
        header('location: products.php');
    }
} else {
    header('location: products.php');
}

$selectItemQuery1 = "SELECT * FROM `item` WHERE `item_id` = '$item_id'";
$resultItem = $conn->query($selectItemQuery1);

if ($resultItem->num_rows > 0) {
    $itemData = $resultItem->fetch_assoc();

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
} else {
    header('location: products.php');
}

$selectItemCategoryQuery1 = "SELECT * FROM `item_category` WHERE `item_catagory_id` = '$item_category'";
$resultItemCategory = $conn->query($selectItemCategoryQuery1);

if ($resultItemCategory->num_rows > 0) {
    $itemCategoryData = $resultItemCategory->fetch_assoc();

    $itemCategoryname = $itemCategoryData['name'];
}


$selectItemImageQuery1 = "SELECT * FROM `item_image` WHERE `item_id` = '$item_id'";
$resultItemImage = $conn->query($selectItemImageQuery1);

$i = 0;

if ($resultItemImage->num_rows > 0) {
    while ($itemImageData = $resultItemImage->fetch_assoc()) {

        if ($i == 0) {
            $image1 = $itemImageData['image_url'];
        } else if ($i == 1) {
            $image2 = $itemImageData['image_url'];
        } else if ($i == 2) {
            $image3 = $itemImageData['image_url'];
        } else if ($i == 3) {
            $image4 = $itemImageData['image_url'];
        } else if ($i == 4) {
            $image5 = $itemImageData['image_url'];
        }

        $i++;
    }
}


if (isset($_POST['add-to-cart'])) {

    if (!isset($_SESSION['id'])) {
        header('location: ./login.php');
    }

    $quantity = $_POST['quantity'];

    $selectCartQuery = "SELECT * FROM `cart` WHERE `item_id` = '$item_id' AND `user_id`='$user_id'";
    $resultCart = $conn->query($selectCartQuery);

    if ($resultCart->num_rows > 0) {
        $itemCartData = $resultCart->fetch_assoc();

        $quantityDB = $itemCartData['quantity'];
        $newQuantity = $quantity + $quantityDB;

        $updateUserQuery = "UPDATE `cart` SET 
        `quantity` = '$newQuantity' 
        WHERE `item_id` = '$item_id' AND `user_id` = '$user_id'";
        if ($stock_quantity >= $newQuantity) {

            if ($conn->query($updateUserQuery) === TRUE) {
                header('location: ./cart.php');
                // echo $quantity;
            }
        } else {
            // error
        }
    } else {

        if (!isset($_SESSION['id'])) {
            header('location: ./login.php');
        }

        $cartSql = "INSERT INTO `cart`(`user_id`, `item_id`, `quantity`) 
        VALUES ('$user_id','$item_id','$quantity')";

        if ($stock_quantity >= $newQuantity) {
            if ($conn->query($cartSql) === TRUE) {
                header('location: ./cart.php');
                // echo $quantity;
            }
        } else {
            // error
        }
    }
}

$newQuantity = 1;

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
    <link rel="stylesheet" href="./assets/css/user-product.css">
    <link rel="stylesheet" href="./assets/css/user-review.css">

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
            <div class="product">
                <div class="box">
                    <div class="product-url">
                        <ul>
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>/</li>
                            <li>
                                <a href="products.php">Products</a>
                            </li>
                            <li>/</li>
                            <li>
                                <a href="products.php?category_id= <?php echo $item_category; ?> "><?php echo $itemCategoryname ?></a>
                            </li>
                            <li>/</li>
                            <li>
                                <a href=""><?php echo $name ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-content">
                        <div class="product-details-1">
                            <div class="product-content-1">
                                <h1 class="product-content-1-title"><?php echo $name ?></h1>
                                <div class="product-main-image">
                                    <img src="./assets/images/product/<?php echo $image1 ?>" alt="">
                                </div>
                                <div class="product-all-images">
                                    <div class="product-all-arrow product-all-arrow-left">
                                        <i class="ri-arrow-drop-left-line"></i>
                                    </div>
                                    <div class="product-all-images-content">
                                        <div class="product-all-image">
                                            <img src="./assets/images/product/<?php echo $image2 ?>" alt="">
                                        </div>
                                        <div class="product-all-image">
                                            <img src="./assets/images/product/<?php echo $image3 ?>" alt="">
                                        </div>
                                        <div class="product-all-image">
                                            <img src="./assets/images/product/<?php echo $image4 ?>" alt="">
                                        </div>
                                        <div class="product-all-image">
                                            <img src="./assets/images/product/<?php echo $image5 ?>" alt="">
                                        </div>

                                    </div>
                                    <div class="product-all-arrow product-all-arrow-right">
                                        <i class="ri-arrow-drop-right-line"></i>
                                    </div>
                                </div>
                            </div>
                            <form class="product-content-2" method="POST">
                                <h1 class="product-content-2-title"><?php echo $name ?></h1>
                                <div class="product-content-2-stars">
                                    <ul>
                                        <li class="active">
                                            <i class="bi bi-star-fill"></i>
                                        </li>
                                        <li class="active">
                                            <i class="bi bi-star-fill"></i>
                                        </li>
                                        <li class="active">
                                            <i class="bi bi-star-fill"></i>
                                        </li class="active">
                                        <li class="active">
                                            <i class="bi bi-star-fill"></i>
                                        </li>
                                        <li class="active">
                                            <i class="bi bi-star-fill"></i>
                                        </li>
                                    </ul>
                                    <?php
                                    $feedbackCount1 = 0;
                                    $feedback1 = "SELECT * FROM `item_feedback` WHERE `item_id` = $item_id";
                                    $resultFeedback1 = $conn->query($feedback1);

                                    if ($resultFeedback1->num_rows > 0) {
                                        while ($rowFeedback1 = $resultFeedback1->fetch_assoc()) {
                                            $feedbackCount1 += 1;
                                        }
                                    }
                                    
                                    ?>
                                    <h4><?php echo $feedbackCount1; ?> Ratings</h4>
                                </div>
                                <div class="product-content-2-brand">
                                    <h4>Brand : </h4>&nbsp;
                                    <a ><?php echo $brand ?></a>
                                </div>
                                <div class="product-content-2-brand">
                                    <h4>Stock : </h4>&nbsp;
                                    <a><?php echo $stock_quantity ?></a>
                                </div>
                                <div class="product-content-2-price">
                                    <h1>LKR. <?php echo $price ?></h1>
                                </div>
                                <div class="product-content-2-warranty">
                                    <h4>Warranty : </h4>&nbsp;
                                    <a ><?php echo $warranty ?> year warranty</a>
                                </div>
                                <div class="product-content-2-quantity">
                                    <h4>Quantity : </h4>&nbsp;
                                    <div class="product-content-2-quantity-content">
                                        <div class="product-content-2-quantity-decrement">
                                            <i>-</i>
                                        </div>
                                        <div class="product-content-2-quantity-number">
                                            <span id="quantity-number">
                                                <input type="text" id="quantity" name="quantity" style="width: 30px; text-align: center; border:none; outline:none; background:transparent;" value="1">
                                            </span>
                                        </div>
                                        <div class="product-content-2-quantity-increment">
                                            <i>+</i>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content-2-button">
                                    <button type="submit" name="add-to-cart">Add to Cart</button>
                                    <button type="button" name="buy" onclick="buyNow()">Buy Now</button>
                                </div>
                            </form>
                        </div>
                        <div class="product-details-2">
                            <div class="product-details-2-content-1">
                                <div class="product-description">
                                    <h4>Description</h4>
                                    <p><?php echo $description ?></p>
                                </div>
                                <div class="product-specifications">
                                    <h4>Specifications</h4>
                                    <div class="product-specifications-content">
                                        <div class="product-specifications-content-1">
                                            <ul>
                                                <li>
                                                    <h4>Brand</h4>
                                                    <p><?php echo $brand ?></p>
                                                </li>
                                                <li>
                                                    <h4>warranty</h4>
                                                    <p><?php echo $warranty ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-specifications-content-2">
                                            <ul>
                                                <li>
                                                    <h4>Creation Date</h4>
                                                    <p><?php echo $creation_date ?></p>
                                                </li>
                                                <li>
                                                    <h4>expiration_date</h4>
                                                    <p><?php echo $expiration_date ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-specifications-content">
                                        <div class="product-specifications-content-1">
                                            <ul>
                                                <li>
                                                    <h4>Weight</h4>
                                                    <p><?php echo $weight ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-specifications-content-2">
                                            <ul>
                                                <li>
                                                    <h4>Manufacturer</h4>
                                                    <p><?php echo $manufacturer ?></p>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <?php

                                $starsC1 = 0;
                                $starsC2 = 0;
                                $starsC3 = 0;
                                $starsC4 = 0;
                                $starsC5 = 0;
                                $allStarCount = 0;

                                $feedback = "SELECT * FROM `item_feedback` WHERE `item_id` = $item_id";
                                $resultFeedback = $conn->query($feedback);

                                if ($resultFeedback->num_rows > 0) {
                                    while ($rowFeedback = $resultFeedback->fetch_assoc()) {
                                        if ($rowFeedback['number_of_stars'] == 1) {
                                            $starsC1 += 1;
                                        }

                                        if ($rowFeedback['number_of_stars'] == 2) {
                                            $starsC2 += 1;
                                        }

                                        if ($rowFeedback['number_of_stars'] == 3) {
                                            $starsC3 += 1;
                                        }

                                        if ($rowFeedback['number_of_stars'] == 4) {
                                            $starsC4 += 1;
                                        }

                                        if ($rowFeedback['number_of_stars'] == 5) {
                                            $starsC5 += 1;
                                        }

                                        $allStarCount += 1;
                                    }
                                }

                                $percentageStar1 = "";
                                $percentageStar2 = "";
                                $percentageStar3 = "";
                                $percentageStar4 = "";
                                $percentageStar5 = "";
                                $averageRating = 0;
                                $averageRating100 = 0;

                                if ($allStarCount > 0) {
                                    $percentageStar1 = ($starsC1 / $allStarCount) * 100;
                                    $percentageStar2 = ($starsC2 / $allStarCount) * 100;
                                    $percentageStar3 = ($starsC3 / $allStarCount) * 100;
                                    $percentageStar4 = ($starsC4 / $allStarCount) * 100;
                                    $percentageStar5 = ($starsC5 / $allStarCount) * 100;

                                    $totalStars = ($starsC1 * 1) + ($starsC2 * 2) + ($starsC3 * 3) + ($starsC4 * 4) + ($starsC5 * 5);
                                    $averageRating = number_format($totalStars / $allStarCount, 1);
                                    $averageRating100 = ($averageRating * 20);
                                }



                                ?>

                                <div class="review">
                                    <h4>Review</h4>
                                    <div class="review-content">
                                        <div class="review-content-1">
                                            <h1><?php echo $averageRating ?>/<span>5</span></h1>
                                            <ul>
                                                <?php

                                                if ($averageRating100 <= 20 && $averageRating100 > 0) {
                                                    echo '
    
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        
                                                        ';
                                                } else if ($averageRating100 <= 40 && $averageRating100 > 20) {
                                                    echo '
    
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        
                                                        ';
                                                } else if ($averageRating100 <= 60 && $averageRating100 > 40) {
                                                    echo '
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        
                                                        ';
                                                } else if ($averageRating100 <= 80 && $averageRating100 > 60) {
                                                    echo '
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    
                                                    ';
                                                } else if ($averageRating100 <= 100 && $averageRating100 > 80) {
                                                    echo '
                                                            <li class="active">
                                                                <i class="ri-star-fill"></i>
                                                            </li>
                                                            <li class="active">
                                                                <i class="ri-star-fill"></i>
                                                            </li>
                                                            <li class="active">
                                                                <i class="ri-star-fill"></i>
                                                            </li>
                                                            <li class="active">
                                                                <i class="ri-star-fill"></i>
                                                            </li>
                                                            <li class="active">
                                                                <i class="ri-star-fill"></i>
                                                            </li>
                                                            
                                                            ';
                                                } else {
                                                    echo '
    
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        
                                                        ';
                                                }
                                                ?>

                                            </ul>
                                            <p><?php echo $allStarCount; ?> Ratings</p>
                                        </div>

                                        <div class="review-content-2">
                                            <div class="review-content-2-content">
                                                <div class="review-content-2-content-1">
                                                    <ul>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="review-content-2-content-2">
                                                    <div class="review-bar">
                                                        <div class="review-line" style="width: <?php echo $percentageStar5 ?>%;"></div>
                                                    </div>
                                                </div>
                                                <div class="review-content-2-content-3">
                                                    <p><?php echo $starsC5 ?></p>
                                                </div>
                                            </div>
                                            <div class="review-content-2-content">
                                                <div class="review-content-2-content-1">
                                                    <ul>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="review-content-2-content-2">
                                                    <div class="review-bar">
                                                        <div class="review-line" style="width: <?php echo $percentageStar4 ?>%;"></div>
                                                    </div>
                                                </div>
                                                <div class="review-content-2-content-3">
                                                    <p><?php echo $starsC4 ?></p>
                                                </div>
                                            </div>
                                            <div class="review-content-2-content">
                                                <div class="review-content-2-content-1">
                                                    <ul>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="review-content-2-content-2">
                                                    <div class="review-bar">
                                                        <div class="review-line" style="width: <?php echo $percentageStar3 ?>%;"></div>
                                                    </div>
                                                </div>
                                                <div class="review-content-2-content-3">
                                                    <p><?php echo $starsC3 ?></p>
                                                </div>
                                            </div>
                                            <div class="review-content-2-content">
                                                <div class="review-content-2-content-1">
                                                    <ul>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="review-content-2-content-2">
                                                    <div class="review-bar">
                                                        <div class="review-line" style="width: <?php echo $percentageStar2 ?>%;"></div>
                                                    </div>
                                                </div>
                                                <div class="review-content-2-content-3">
                                                    <p><?php echo $starsC2 ?></p>
                                                </div>
                                            </div>
                                            <div class="review-content-2-content">
                                                <div class="review-content-2-content-1">
                                                    <ul>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="review-content-2-content-2">
                                                    <div class="review-bar">
                                                        <div class="review-line" style="width: <?php echo $percentageStar1 ?>%;"></div>
                                                    </div>
                                                </div>
                                                <div class="review-content-2-content-3">
                                                    <p><?php echo $starsC1 ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-review">
                                        <h4>Product Reviews</h4>

                                        <?php
                                        $feedback = "SELECT * FROM `item_feedback` WHERE `item_id` = $item_id";
                                        $resultFeedback = $conn->query($feedback);

                                        if ($resultFeedback->num_rows > 0) {
                                            while ($rowFeedback = $resultFeedback->fetch_assoc()) {

                                                echo '
                                        
                                        <div class="user-review-details">
                                        <div class="user-review-header">
                                            <div class="user-review-header-content-1">
                                                <ul>
                                                ';

                                                if ($rowFeedback['number_of_stars'] == 1) {
                                                    for ($i = 0; $i < 1; $i++) {
                                                        echo '<li class="active">
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>';
                                                    }
                                                } else if ($rowFeedback['number_of_stars'] == 2) {
                                                    for ($i = 0; $i < 2; $i++) {
                                                        echo '<li class="active">
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>';
                                                    }
                                                } else if ($rowFeedback['number_of_stars'] == 3) {
                                                    for ($i = 0; $i < 3; $i++) {
                                                        echo '<li class="active">
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>';
                                                    }
                                                } else if ($rowFeedback['number_of_stars'] == 4) {
                                                    for ($i = 0; $i < 4; $i++) {
                                                        echo '<li class="active">
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>';
                                                    }
                                                } else if ($rowFeedback['number_of_stars'] == 5) {
                                                    for ($i = 0; $i < 5; $i++) {
                                                        echo '<li class="active">
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>';
                                                    }
                                                }

                                                $descriptionF = $rowFeedback['description'];
                                                $dateF = $rowFeedback['date'];


                                                echo '
                                                </ul>
                                            </div>
                                            
                                            <div class="user-review-header-content-2">
                                                <p>' . $dateF . '</p>
                                            </div>
                                        </div>
                                        <div class="user-review-content">
                                            <p>
                                                ' . $descriptionF . '
                                            </p>
                                        </div>
                                        
                                        <hr>
                                    </div>
                                        
                                        ';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="product-details-2-content-2">
                                <div class="product-list">
                                    <?php
                                    $selectItemQuery1 = "SELECT * FROM `item` WHERE 1";
                                    $resultItem = $conn->query($selectItemQuery1);

                                    $i = 0;

                                    if ($resultItem->num_rows > 0) {
                                        while ($itemData = $resultItem->fetch_assoc()) {
                                            $i++;

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

                                                // $i += 1;

                                                $feedbackCount = 0;

                                                $image_url = $itemImageData['image_url'];

                                                $feedback = "SELECT * FROM `item_feedback` WHERE `item_id` = $item_id";
                                                $resultFeedback = $conn->query($feedback);

                                                if ($resultFeedback->num_rows > 0) {
                                                    while ($rowFeedback = $resultFeedback->fetch_assoc()) {
                                                        $feedbackCount += 1;
                                                    }
                                                }

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
                                                    <span>(' . $feedbackCount . ')</span>
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
            </div>
        </section>
        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>
    <script>
        let dec = document.querySelector(".product-content-2-quantity-decrement");
        let inc = document.querySelector(".product-content-2-quantity-increment");
        let quantity = document.getElementById("quantity");

        dec.addEventListener("click", () => {

            if (quantity.value > 1) {
                quantity.value = parseInt(quantity.value) - 1;
            }


        });

        inc.addEventListener("click", () => {

            if (quantity.value < <?php echo $stock_quantity ?>) {
                quantity.value = parseInt(quantity.value) + 1;
            }
        });

        function buyNow() {
            let item_id = "<?php echo $item_id ?>";
            let quantity = document.getElementById("quantity").value;
            window.location.href = 'order.php?item_id=' + item_id + '&quantity=' + quantity;
        }
    </script>
</body>

</html>