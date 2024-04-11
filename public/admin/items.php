<?php

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: ../index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ../cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        header('location: ../technician/index.php');
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        header('location: ../delivery-boy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        // header('location: ../admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ../technical-team/index.php');
    }
} else {
    header('location: ../login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard-menu.css">
    <link rel="stylesheet" href="../assets/css/dashboard-nav.css">
    <link rel="stylesheet" href="../assets/css/dashboard-profile.css">
    <link rel="stylesheet" href="../assets/css/dashboard-review.css">
    <link rel="stylesheet" href="../assets/css/dashboard-product.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/card.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/review.css">
    <link rel="stylesheet" href="../assets/css/stars.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
    <?php
    include "../../config/database.php";
    include "../../template/user-data.php";

    ?>
</head>

<body>
    <div class="container">
        <!-- navigation -->
        <?php
        include "../../template/dashboard-nav.php";
        ?>
        <!-- <div class="content"> -->
        <aside class="active aside">
            <!-- menu -->
            <div class="menu">
            <?php
                include "../../template/dashboard-menu.php";
                ?>
                <div class="menu-content">
                    <div class="menu-links">
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./index.php">
                                <p><img src="../assets/images/ui/dashboard.png" alt="">Dashboard</p>
                            </a>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/booking.png" alt="">Technician</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technicians.php">
                                        <p><img src="../assets/images/ui/booking.png" alt="">Technicians</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./new-technician.php">
                                        <p><img src="../assets/images/ui/new technicians.png" alt="">New Technicians</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technician-category.php">
                                        <p><img src="../assets/images/ui/category.png" alt="">Technician Category</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technician-salary-request.php">
                                        <p><img src="../assets/images/ui/salary-request.png" alt="">Salary Request</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/delivery-boy.png" alt="">Delivery Boy</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./delivery-boys.php">
                                        <p><img src="../assets/images/ui/Courier.png" alt="">All Delivery Boys</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./new-delivery-boy.php">
                                        <p><img src="../assets/images/ui/new delivery boy.png" alt="">New Delivery Boys</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./delivery-boy-salary-request.php">
                                        <p><img src="../assets/images/ui/salary-request.png" alt="">Salary Request</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/employee.png" alt="">Employee</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./add-technical-team.php">
                                        <p><img src="../assets/images/ui/technical team.png" alt="">Add Technical Team</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technical-team.php">
                                        <p><img src="../assets/images/ui/technical team.png" alt="">Technical Team</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./add-cashiers.php">
                                        <p><img src="../assets/images/ui/Cashiers.png" alt="">Add Cashiers</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./cashiers.php">
                                        <p><img src="../assets/images/ui/Cashiers.png" alt="">Cashiers</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./orders.php">
                                <p><img src="../assets/images/ui/add item.png" alt="">Orders</p>
                            </a>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2  active">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/item.png" alt="">Item</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button active">
                                    <a href="./items.php">
                                        <p><img src="../assets/images/ui/all items.png" alt="">All Items</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./add-item.php">
                                        <p><img src="../assets/images/ui/add item.png" alt="">Add Item</p>
                                    </a>
                                </div>

                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./item-category.php">
                                        <p><img src="../assets/images/ui/category.png" alt="">Item Category</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./customers.php">
                                <p><img src="../assets/images/ui/customer.png" alt="">Customer</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./income.php">
                                <p><img src="../assets/images/ui/income.png" alt="">Income Report</p>
                            </a>
                        </div>

                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./settings.php">
                                <p><img src="../assets/images/ui/Settings.png" alt="">Settings</p>
                            </a>
                        </div>
                    </div>
                    <div class="menu-logout">
                        <a href="../logout.php">
                            <p><img src="../assets/images/ui/Exit.png" alt="">Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
        <section class="active section">
            <div class="content">
                <div class="product">
                    <form class="search-2" method="GET" action="./items.php">
                        <div class="search-content-1">
                            <select name="type" id="">
                                <option value="item_id" <?php if (isset($_GET['type']) && $_GET['type'] == 'item_id') echo 'selected'; ?>>By Item ID</option>
                                <option value="item_name" <?php if (isset($_GET['type']) && $_GET['type'] == 'item_name') echo 'selected'; ?>>By Item Name</option>
                            </select>
                        </div>
                        <div class="search-content-2">
                            <input type="text" name="search" value="<?php if (isset($_GET['type']) && isset($_GET['search'])) {
                                                                        echo $_GET['search'];
                                                                    } ?>">
                        </div>
                        <div class="search-content-3">
                            <input type="submit" class="btn" value="Search">
                            <button type="submit" class="btn-icon btn">
                                <i class="ri-search-line"></i>
                            </button>
                        </div>
                    </form>
                    <div class="card-content  margin-top-40">
                        <div class="card-list">

                            <?php

                            $error = false;

                            if (isset($_GET['type']) && isset($_GET['search'])) {
                                $searchType = $_GET['type'];
                                $searchValue = $_GET['search'];


                                if ($searchType == "item_id") {

                                    $selectCashierQuery = "SELECT * FROM `item` WHERE 1 AND `item_id` = '$searchValue'";
                                    $result = $conn->query($selectCashierQuery);

                                    if ($result && $result->num_rows > 0) {
                                        while ($itemData = $result->fetch_assoc()) {
                                            $item_id  = $itemData['item_id'];
                                            $item_category  = $itemData['item_category'];
                                            $name = $itemData['name'];
                                            $price = $itemData['price'];
                                            $stock_quantity = $itemData['stock_quantity'];
                                            $creation_date     = $itemData['creation_date'];
                                            $expiration_date = $itemData['expiration_date'];
                                            $brand = $itemData['brand'];
                                            $discount = $itemData['discount'];
                                            $warranty = $itemData['warranty'];
                                            $weight = $itemData['weight'];
                                            $manufacturer = $itemData['manufacturer'];
                                            $description = $itemData['description'];
                                            $image1 = "";

                                            $selectCashierQuery1 = "SELECT * FROM `item_image` WHERE `item_id` = '$item_id' LIMIT 1";
                                            $result1 = $conn->query($selectCashierQuery1);

                                            if ($result1) {
                                                if ($result1->num_rows > 0) {
                                                    $itemData1 = $result1->fetch_assoc();
                                                    $image1 = $itemData1['image_url'];
                                                }
                                            }

                                            $error = true;

                                            echo '
                                            <a href="./item-view.php?item_id=' . $item_id . '" class="card">
                                               <div class="product-image">
                                                   <img src="../assets/images/product/' . $image1 . '" alt="">
                                               </div>
                                               <div class="product-name">
                                                   <h3>' . $name . '</h3>
                                               </div>
                                               <div class="product-price">
                                                   <h4>Rs. ' . $price . '</h4>
                                               </div>
                                               <div class="product-stars">
                                                   <div class="stars">
                                                       <ul>
                                                           <li>
                                                               <i class="ri-star-fill active"></i>
                                                           </li>
                                                           <li>
                                                               <i class="ri-star-fill active"></i>
                                                           </li>
                                                           <li>
                                                               <i class="ri-star-fill active"></i>
                                                           </li>
                                                           <li>
                                                               <i class="ri-star-fill active"></i>
                                                           </li>
                                                           <li>
                                                               <i class="ri-star-fill"></i>
                                                           </li>
                                                       </ul>
                                                       <p>(120)</p>
                                                   </div>
                                               </div>
                                           </a>
                                            ';
                                        }
                                    }
                                } else if ($searchType == "item_name") {

                                    $selectCashierQuery = "SELECT * FROM `item` WHERE 1 AND (`name` LIKE '%$searchValue%')";
                                    $result = $conn->query($selectCashierQuery);

                                    if ($result && $result->num_rows > 0) {
                                        while ($itemData = $result->fetch_assoc()) {
                                            $item_id  = $itemData['item_id'];
                                            $item_category  = $itemData['item_category'];
                                            $name = $itemData['name'];
                                            $price = $itemData['price'];
                                            $stock_quantity = $itemData['stock_quantity'];
                                            $creation_date     = $itemData['creation_date'];
                                            $expiration_date = $itemData['expiration_date'];
                                            $brand = $itemData['brand'];
                                            $discount = $itemData['discount'];
                                            $warranty = $itemData['warranty'];
                                            $weight = $itemData['weight'];
                                            $manufacturer = $itemData['manufacturer'];
                                            $description = $itemData['description'];
                                            $image1 = "";

                                            $selectCashierQuery1 = "SELECT * FROM `item_image` WHERE `item_id` = '$item_id' LIMIT 1";
                                            $result1 = $conn->query($selectCashierQuery1);

                                            if ($result1) {
                                                if ($result1->num_rows > 0) {
                                                    $itemData1 = $result1->fetch_assoc();
                                                    $image1 = $itemData1['image_url'];
                                                }
                                            }

                                            $error = true;

                                            echo '
                                            <a href="./item-view.php?item_id=' . $item_id . '" class="card">
                                               <div class="product-image">
                                                   <img src="../assets/images/product/' . $image1 . '" alt="">
                                               </div>
                                               <div class="product-name">
                                                   <h3>' . $name . '</h3>
                                               </div>
                                               <div class="product-price">
                                                   <h4>Rs. ' . $price . '</h4>
                                               </div>
                                               <div class="product-stars">
                                                   <div class="stars">
                                                       <ul>
                                                           <li>
                                                               <i class="ri-star-fill active"></i>
                                                           </li>
                                                           <li>
                                                               <i class="ri-star-fill active"></i>
                                                           </li>
                                                           <li>
                                                               <i class="ri-star-fill active"></i>
                                                           </li>
                                                           <li>
                                                               <i class="ri-star-fill active"></i>
                                                           </li>
                                                           <li>
                                                               <i class="ri-star-fill"></i>
                                                           </li>
                                                       </ul>
                                                       <p>(120)</p>
                                                   </div>
                                               </div>
                                           </a>
                                            ';
                                        }
                                    }
                                }
                            } else {

                                $selectCashierQuery = "SELECT * FROM `item` WHERE 1";
                                $result = $conn->query($selectCashierQuery);

                                if ($result && $result->num_rows > 0) {
                                    while ($itemData = $result->fetch_assoc()) {
                                        $item_id  = $itemData['item_id'];
                                        $item_category  = $itemData['item_category'];
                                        $name = $itemData['name'];
                                        $price = $itemData['price'];
                                        $stock_quantity = $itemData['stock_quantity'];
                                        $creation_date     = $itemData['creation_date'];
                                        $expiration_date = $itemData['expiration_date'];
                                        $brand = $itemData['brand'];
                                        $discount = $itemData['discount'];
                                        $warranty = $itemData['warranty'];
                                        $weight = $itemData['weight'];
                                        $manufacturer = $itemData['manufacturer'];
                                        $description = $itemData['description'];
                                        $image1 = "";

                                        $selectCashierQuery1 = "SELECT * FROM `item_image` WHERE `item_id` = '$item_id' LIMIT 1";
                                        $result1 = $conn->query($selectCashierQuery1);

                                        if ($result1) {
                                            if ($result1->num_rows > 0) {
                                                $itemData1 = $result1->fetch_assoc();
                                                $image1 = $itemData1['image_url'];
                                            }
                                        }

                                        $error = true;

                                        echo '
                                        <a href="./item-view.php?item_id=' . $item_id . '" class="card">
                                           <div class="product-image">
                                               <img src="../assets/images/product/' . $image1 . '" alt="">
                                           </div>
                                           <div class="product-name">
                                               <h3>' . $name . '</h3>
                                           </div>
                                           <div class="product-price">
                                               <h4>Rs. ' . $price . '</h4>
                                           </div>
                                           <div class="product-stars">
                                               <div class="stars">
                                                   <ul>
                                                       <li>
                                                           <i class="ri-star-fill active"></i>
                                                       </li>
                                                       <li>
                                                           <i class="ri-star-fill active"></i>
                                                       </li>
                                                       <li>
                                                           <i class="ri-star-fill active"></i>
                                                       </li>
                                                       <li>
                                                           <i class="ri-star-fill active"></i>
                                                       </li>
                                                       <li>
                                                           <i class="ri-star-fill"></i>
                                                       </li>
                                                   </ul>
                                                   <p>(120)</p>
                                               </div>
                                           </div>
                                       </a>
                                        ';
                                    }
                                }
                            }

                            if ($error == false) {
                                echo "No Items found.";
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- </div> -->
    </div>

    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>