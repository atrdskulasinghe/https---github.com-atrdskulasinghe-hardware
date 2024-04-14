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
    <link rel="stylesheet" href="./assets/css/user-style.css">
    <link rel="stylesheet" href="./assets/css/button.css">
    <link rel="stylesheet" href="./assets/css/user-contact.css">
    <link rel="stylesheet" href="./assets/css/input.css">
    <link rel="stylesheet" href="./assets/css/user-home.css">
    <link rel="stylesheet" href="./assets/css/user-product-list.css">
    <link rel="stylesheet" href="./assets/css/user-products.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <div class="header">
                <div class="box">
                    <div class="header-content">
                        <div class="header-content-1 ">
                            <div class="header-category ">
                                <div class="header-category-header">
                                    <i class="bi bi-filter-left"></i>
                                    <h4>ALL CATEGORIES</h4>
                                </div>
                                <div class="header-category-content">
                                    <?php

                                    $selectItemCategoryQuery1 = "SELECT * FROM `item_category` WHERE 1";
                                    $result1 = $conn->query($selectItemCategoryQuery1);

                                    if ($result1->num_rows > 0) {
                                        while ($itemCategoryData = $result1->fetch_assoc()) {

                                            $itemCategoryName = $itemCategoryData['name'];
                                            $itemCategoryId = $itemCategoryData['item_catagory_id'];

                                            echo '
                                                <a href="products.php?category_id=' . $itemCategoryId . '">' . $itemCategoryName . '</a>
                                ';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="header-content-2">
                            <div class="slick-carousel">
                                <div><img src="./assets/images/ui/header/1.jpg" alt=""></div>
                                <div><img src="./assets/images/ui/header/2.jpg" alt=""></div>
                                <div><img src="./assets/images/ui/header/3.jpg" alt=""></div>
                                <div><img src="./assets/images/ui/header/4.jpg" alt=""></div>
                                <div><img src="./assets/images/ui/header/5.jpg" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="loop--slider">
                    <div class="loop--slide--track">



                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/129.jpg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <!-- <div class="loop--slide">
                            <img src="./assets/images/ui/logo/187698.svg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div> -->
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/Cat_logo_PNG1.png" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>

                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/Ceylon_Steel_Corp_Colour_Logo_Sinhala_version.jpg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/ingco-500x500.webp" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/kevilton.jpg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/logo.jpg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/logo (1).jpg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/orange-logo.png" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>



                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/129.jpg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <!-- <div class="loop--slide">
                            <img src="./assets/images/ui/logo/187698.svg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div> -->
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/Cat_logo_PNG1.png" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>

                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/Ceylon_Steel_Corp_Colour_Logo_Sinhala_version.jpg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/ingco-500x500.webp" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/kevilton.jpg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/logo.jpg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/logo (1).jpg" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                        <div class="loop--slide">
                            <img src="./assets/images/ui/logo/orange-logo.png" height="100" width="250" alt="" style="height:50px;object-fit:contain;" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">

                <div class="header-title">
                    <h4>Product Category</h4>
                </div>
                <div class="category-content">
                    <div class="category-arrow category-arrow-left">
                        <div class="category-arrow-content category-arrow-left-content">
                            <i class="ri-arrow-left-s-line"></i>
                        </div>
                    </div>
                    <div class="category-list-1">
                        <div class="category-list-content">
                            <?php

                            $selectItemCategoryQuery1 = "SELECT * FROM `item_category` WHERE 1";
                            $resultItemCategory = $conn->query($selectItemCategoryQuery1);

                            if ($resultItemCategory->num_rows > 0) {
                                while ($itemCategoryData = $resultItemCategory->fetch_assoc()) {

                                    $itemCategoryName = $itemCategoryData['name'];
                                    $itemCategoryId = $itemCategoryData['item_catagory_id'];
                                    $itemCategoryImage = $itemCategoryData['image_url'];


                                    echo '
                                        
                                    <a href="products.php?category_id=' . $itemCategoryId . '" class="category-card">
                                        <div class="category-image">
                                            <img src="./assets/images/item_category/' . $itemCategoryImage . '" alt="">
                                        </div>
                                        <h4>' . $itemCategoryName . '</h4>
                                    </a>
                               
                                    ';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="category-arrow category-arrow-right">
                        <div class="category-arrow-content category-arrow-right-content">
                            <i class="ri-arrow-right-s-line"></i>
                        </div>
                    </div>
                </div>

                <div class="header-title">
                    <h4>Top Product</h4>
                </div>
                <div class="product-list">

                    <?php

                    $sql = "SELECT `item_id`, SUM(`quantity`) AS `total_quantity` FROM `order_details` GROUP BY `item_id` ORDER BY `total_quantity` DESC LIMIT 5";

                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $item_id = $row['item_id'];

                            $selectItemQuery1 = "SELECT * FROM `item` WHERE `item_id` = '$item_id'";
                            $resultItem = mysqli_query($conn, $selectItemQuery1);

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

                                        $feedbackCount = 0;

                                        $starsC1 = 0;
                                        $starsC2 = 0;
                                        $starsC3 = 0;
                                        $starsC4 = 0;
                                        $starsC5 = 0;
                                        $allStarCount = 0;
                                        $percentageStar1 = "";
                                        $percentageStar2 = "";
                                        $percentageStar3 = "";
                                        $percentageStar4 = "";
                                        $percentageStar5 = "";
                                        $averageRating = 0;
                                        $averageRating100 = 0;


                                        $image_url = $itemImageData['image_url'];

                                        $feedback = "SELECT * FROM `item_feedback` WHERE `item_id` = $item_id";
                                        $resultFeedback = $conn->query($feedback);

                                        if ($resultFeedback->num_rows > 0) {
                                            while ($rowFeedback = $resultFeedback->fetch_assoc()) {
                                                $feedbackCount += 1;

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


                                            if ($allStarCount > 0) {
                                                $percentageStar1 = ($starsC1 / $allStarCount) * 100;
                                                $percentageStar2 = ($starsC2 / $allStarCount) * 100;
                                                $percentageStar3 = ($starsC3 / $allStarCount) * 100;
                                                $percentageStar4 = ($starsC4 / $allStarCount) * 100;
                                                $percentageStar5 = ($starsC5 / $allStarCount) * 100;

                                                $totalStars = ($starsC1 * 1) + ($starsC2 * 2) + ($starsC3 * 3) + ($starsC4 * 4) + ($starsC5 * 5);
                                                $averageRating = $totalStars / $allStarCount;
                                                $averageRating100 = ($averageRating * 20);
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
                                            ';
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
                                        echo '
                                            </ul>
                                            <span>(' . $feedbackCount . ')</span>
                                        </div>
                                    </div>
                                </a>
                                ';
                                    }
                                }
                            }
                        }
                    } else {
                        echo "No records found.";
                    }

                    ?>

                </div>
            </div>

            <div class="box">
                <div class="header-title">
                    <h4>Technician Category</h4>
                </div>
                <div class="category-content">
                    <div class="category-arrow category-arrow-left">
                        <div class="category-arrow-content category-arrow-left-content-2">
                            <i class="ri-arrow-left-s-line"></i>
                        </div>
                    </div>
                    <div class="category-list-2">
                        <div class="category-list-content">
                            <?php

                            $selectTechnicianCategoryQuery1 = "SELECT * FROM `technician_category` WHERE 1";
                            $resultTechnicianCategory = $conn->query($selectTechnicianCategoryQuery1);

                            if ($resultTechnicianCategory->num_rows > 0) {
                                while ($technicianCategoryData = $resultTechnicianCategory->fetch_assoc()) {

                                    $technicianCategoryName = $technicianCategoryData['name'];
                                    $technicianCategoryId = $technicianCategoryData['technician_category_id'];
                                    $technicianCategoryImage = $technicianCategoryData['image_url'];

                                    echo '
            
                                        <a href="technicians.php?category_id=' . $technicianCategoryId . '" class="category-card">
                                            <div class="category-image">
                                                <img src="./assets/images/technician_category/' . $technicianCategoryImage . '" alt="">
                                            </div>
                                            <h4>' . $technicianCategoryName . '</h4>
                                        </a>
                                
                                        ';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="category-arrow category-arrow-right">
                        <div class="category-arrow-content category-arrow-right-content-2">
                            <i class="ri-arrow-right-s-line"></i>
                        </div>
                    </div>
                </div>


            </div>
            <div class="home-image">
                <img src="./assets/images/ui/header/3.jpg" alt="">
                <div class="home-image-content">
                    <div class="home-image-text">
                        <h2>Hassle-Free Technician Booking for Home & Garden</h2>
                        <p>Simplify your life with our easy technician booking platform. From home repairs to garden maintenance, find skilled technicians for all your troubleshooting needs. Check out our website for a seamless booking experience!</p>
                        <div class="home-image-button">
                            <a href="./technicians.php">Book Technician</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box">
                <div class="header-title">
                    <h4>Last Product</h4>
                </div>
                <div class="product-list">

                    <?php

                    $selectItemQuery1 = "SELECT * FROM `item` WHERE 1";
                    $resultItem = $conn->query($selectItemQuery1);

                    $i = 0;

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

                                $feedbackCount = 0;

                                $starsC1 = 0;
                                $starsC2 = 0;
                                $starsC3 = 0;
                                $starsC4 = 0;
                                $starsC5 = 0;
                                $allStarCount = 0;
                                $percentageStar1 = "";
                                $percentageStar2 = "";
                                $percentageStar3 = "";
                                $percentageStar4 = "";
                                $percentageStar5 = "";
                                $averageRating = 0;
                                $averageRating100 = 0;


                                $image_url = $itemImageData['image_url'];

                                $feedback = "SELECT * FROM `item_feedback` WHERE `item_id` = $item_id";
                                $resultFeedback = $conn->query($feedback);

                                if ($resultFeedback->num_rows > 0) {
                                    while ($rowFeedback = $resultFeedback->fetch_assoc()) {
                                        $feedbackCount += 1;

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


                                    if ($allStarCount > 0) {
                                        $percentageStar1 = ($starsC1 / $allStarCount) * 100;
                                        $percentageStar2 = ($starsC2 / $allStarCount) * 100;
                                        $percentageStar3 = ($starsC3 / $allStarCount) * 100;
                                        $percentageStar4 = ($starsC4 / $allStarCount) * 100;
                                        $percentageStar5 = ($starsC5 / $allStarCount) * 100;

                                        $totalStars = ($starsC1 * 1) + ($starsC2 * 2) + ($starsC3 * 3) + ($starsC4 * 4) + ($starsC5 * 5);
                                        $averageRating = $totalStars / $allStarCount;
                                        $averageRating100 = ($averageRating * 20);
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
                                    ';
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
                                echo '
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
        </section>


        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>
    <script src="./assets/js/user-home.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.slick-carousel').slick({
                autoplay: true,
                autoplaySpeed: 2000,
                dots: true,
                arrows: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1
            });
        });
    </script>

    <script>

    </script>
</body>

</html>