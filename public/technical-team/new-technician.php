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
        header('location: ../admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        // header('location: ../technical-team/index.php');
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
    <link rel="stylesheet" href="../assets/css/dashboard-technician.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/card.css">
    <link rel="stylesheet" href="../assets/css/search.css">
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
                <div class="menu-header">
                    <h1>Logo</h1>
                    <div class="menu-close">
                        <i class="ri-close-line " id="menu-header-icon"></i>
                    </div>
                </div>
                <div class="menu-content">
                    <div class="menu-links">
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./index.php">
                                <p><img src="../assets/images/ui/dashboard.png" alt="">Dashboard</p>
                            </a>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2 active">
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
                                <div class="menu-link-button menu-hidden-button active">
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
                        <div class="menu-link-button-2 ">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/item.png" alt="">Item</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list ">
                                <div class="menu-link-button menu-hidden-button ">
                                    <a href="./items.php">
                                        <p><img src="../assets/images/ui/all items.png" alt="">All Items</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button ">
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
                            <a href="./settings.php">
                                <p><img src="../assets/images/ui/Settings.png" alt="">Settings</p>
                            </a>
                        </div>
                    </div>
                    <div class="menu-logout">
                        <a href="">
                            <p><img src="../assets/images/ui/Exit.png" alt="">Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
        <section class="active section">
            <div class="content">

            <div class="technician">
                    <form class="search-2" method="GET" action="./delivery-boys.php">
                        <div class="search-content-1">
                            <select name="type" id="">
                                <option value="user_id" <?php if (isset($_GET['type']) && $_GET['type'] == 'user_id') echo 'selected'; ?>>By User ID</option>
                                <option value="technician_id" <?php if (isset($_GET['type']) && $_GET['type'] == 'technician_id') echo 'selected'; ?>>By Delivery Boy ID</option>
                                <option value="user_name" <?php if (isset($_GET['type']) && $_GET['type'] == 'user_name') echo 'selected'; ?>>By User Name</option>
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

                                if ($searchType == "user_id") {

                                    $selectCashierQuery = "SELECT * FROM `user` WHERE `account_type` = 'technician' AND `user_id` = '$searchValue'";
                                    $result = $conn->query($selectCashierQuery);

                                    if ($result && $result->num_rows > 0) {
                                        while ($userData = $result->fetch_assoc()) {
                                            $user_id = $userData['user_id'];
                                            $first_name = $userData['first_name'];
                                            $last_name = $userData['last_name'];
                                            $email = $userData['email'];
                                            $phone_number = $userData['phone_number'];
                                            $dob = $userData['dob'];
                                            $house_no = $userData['house_no'];
                                            $state = $userData['state'];
                                            $city = $userData['city'];
                                            $account_type = $userData['account_type'];
                                            $profile_url = $userData['profile_url'];
                                            $password = $userData['password'];
                                            $user_status = $userData['status'];
                                            $vehical = "";

                                            if ($user_status != "pending") {



                                                $selectDBQuery = "SELECT * FROM `technician` WHERE `user_id` = '$user_id'";
                                                $result1 = $conn->query($selectDBQuery);

                                                $status = "pending";

                                                $category = "";
                                                $nic_number = "";
                                                $nic_photo_url = "";
                                                $work_experience = "";
                                                $cost_per_day = "";
                                                $cost_per_hour = "";

                                                if ($result1 && $result1->num_rows > 0) {
                                                    while ($userData1 = $result1->fetch_assoc()) {

                                                        $category = $userData1['category'];
                                                        $nic_number = $userData1['nic_number'];
                                                        $nic_photo_url = $userData1['nic_photo_url'];
                                                        $work_experience = $userData1['work_experience'];
                                                        $cost_per_day = $userData1['cost_per_day'];
                                                        $cost_per_hour = $userData1['cost_per_hour'];
                                                        $status = $userData1['status'];
                                                    }
                                                }


                                                if ($status == "pending") {
                                                    $error = true;
                                                    echo '

                                            <a href="./new-technician-view.php?user=' . $user_id . '" class="card">
                                            <div class="technician-image">
                                                <img src="../assets/images/technician/' . $profile_url . '" alt="">
                                            </div>
                                            <div class="technician-name">
                                                <h3>' . $first_name . ' ' . $last_name . '</h3>
                                            </div>
                                            <div class="technician-details">
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>City</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $city . '</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Date Of Birth</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $dob . '</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Years of experience</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $work_experience . ' Years</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Cost Per Day</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $cost_per_day . '</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Cost Per Hour</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $cost_per_hour . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>';
                                                }
                                            }
                                        }
                                    }
                                } else if ($searchType == "technician_id") {

                                    $user_id = "";

                                    $selectCashierQuery1 = "SELECT * FROM `technician` WHERE `technician_id` = '$searchValue'";
                                    $result1 = $conn->query($selectCashierQuery1);

                                    if ($result1 && $result1->num_rows > 0) {
                                        while ($userData = $result1->fetch_assoc()) {

                                            $user_id = $userData['user_id'];
                                        }
                                    }

                                    $selectCashierQuery = "SELECT * FROM `user` WHERE `account_type` = 'technician' AND `user_id` = '$user_id'";
                                    $result = $conn->query($selectCashierQuery);

                                    if ($result && $result->num_rows > 0) {
                                        while ($userData = $result->fetch_assoc()) {
                                            $user_id = $userData['user_id'];
                                            $first_name = $userData['first_name'];
                                            $last_name = $userData['last_name'];
                                            $email = $userData['email'];
                                            $phone_number = $userData['phone_number'];
                                            $dob = $userData['dob'];
                                            $house_no = $userData['house_no'];
                                            $state = $userData['state'];
                                            $city = $userData['city'];
                                            $account_type = $userData['account_type'];
                                            $profile_url = $userData['profile_url'];
                                            $password = $userData['password'];
                                            $user_status = $userData['status'];
                                            $vehical = "";

                                            if ($user_status != "pending") {



                                                $selectDBQuery = "SELECT * FROM `technician` WHERE `user_id` = '$user_id'";
                                                $result1 = $conn->query($selectDBQuery);

                                                $status = "pending";

                                                $category = "";
                                                $nic_number = "";
                                                $nic_photo_url = "";
                                                $work_experience = "";
                                                $cost_per_day = "";
                                                $cost_per_hour = "";

                                                if ($result1 && $result1->num_rows > 0) {
                                                    while ($userData1 = $result1->fetch_assoc()) {

                                                        $category = $userData1['category'];
                                                        $nic_number = $userData1['nic_number'];
                                                        $nic_photo_url = $userData1['nic_photo_url'];
                                                        $work_experience = $userData1['work_experience'];
                                                        $cost_per_day = $userData1['cost_per_day'];
                                                        $cost_per_hour = $userData1['cost_per_hour'];
                                                        $status = $userData1['status'];
                                                    }
                                                }


                                                if ($status == "pending") {
                                                    $error = true;
                                                    echo '

                                            <a href="./new-technician-view.php?user=' . $user_id . '" class="card">
                                            <div class="technician-image">
                                                <img src="../assets/images/technician/' . $profile_url . '" alt="">
                                            </div>
                                            <div class="technician-name">
                                                <h3>' . $first_name . ' ' . $last_name . '</h3>
                                            </div>
                                            <div class="technician-details">
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>City</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $city . '</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Date Of Birth</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $dob . '</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Years of experience</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $work_experience . ' Years</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Cost Per Day</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $cost_per_day . '</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Cost Per Hour</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $cost_per_hour . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>';
                                                }
                                            }
                                        }
                                    }
                                } else if ($searchType == "user_name") {

                                    $selectCashierQuery = "SELECT * FROM `user` WHERE `account_type` = 'technician' AND (`first_name` LIKE '%$searchValue%' OR `last_name` LIKE '%$searchValue%')";
                                    $result = $conn->query($selectCashierQuery);

                                    if ($result && $result->num_rows > 0) {
                                        while ($userData = $result->fetch_assoc()) {
                                            $user_id = $userData['user_id'];
                                            $first_name = $userData['first_name'];
                                            $last_name = $userData['last_name'];
                                            $email = $userData['email'];
                                            $phone_number = $userData['phone_number'];
                                            $dob = $userData['dob'];
                                            $house_no = $userData['house_no'];
                                            $state = $userData['state'];
                                            $city = $userData['city'];
                                            $account_type = $userData['account_type'];
                                            $profile_url = $userData['profile_url'];
                                            $password = $userData['password'];
                                            $user_status = $userData['status'];
                                            $vehical = "";

                                            if ($user_status != "pending") {



                                                $selectDBQuery = "SELECT * FROM `technician` WHERE `user_id` = '$user_id'";
                                                $result1 = $conn->query($selectDBQuery);

                                                $status = "pending";

                                                $category = "";
                                                $nic_number = "";
                                                $nic_photo_url = "";
                                                $work_experience = "";
                                                $cost_per_day = "";
                                                $cost_per_hour = "";

                                                if ($result1 && $result1->num_rows > 0) {
                                                    while ($userData1 = $result1->fetch_assoc()) {

                                                        $category = $userData1['category'];
                                                        $nic_number = $userData1['nic_number'];
                                                        $nic_photo_url = $userData1['nic_photo_url'];
                                                        $work_experience = $userData1['work_experience'];
                                                        $cost_per_day = $userData1['cost_per_day'];
                                                        $cost_per_hour = $userData1['cost_per_hour'];
                                                        $status = $userData1['status'];
                                                    }
                                                }


                                                if ($status == "pending") {
                                                    $error = true;
                                                    echo '

                                            <a href="./new-technician-view.php?user=' . $user_id . '" class="card">
                                            <div class="technician-image">
                                                <img src="../assets/images/technician/' . $profile_url . '" alt="">
                                            </div>
                                            <div class="technician-name">
                                                <h3>' . $first_name . ' ' . $last_name . '</h3>
                                            </div>
                                            <div class="technician-details">
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>City</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $city . '</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Date Of Birth</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $dob . '</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Years of experience</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $work_experience . ' Years</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Cost Per Day</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $cost_per_day . '</p>
                                                    </div>
                                                </div>
                                                <div class="technician-details-content">
                                                    <div class="technician-details-content-1">
                                                        <p>Cost Per Hour</p>
                                                    </div>
                                                    <div class="technician-details-content-2">
                                                        <p>' . $cost_per_hour . '</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>';
                                                }
                                            }
                                        }
                                    }
                                }
                            } else {
                                $selectCashierQuery = "SELECT * FROM `user` WHERE `account_type` = 'technician'";
                                $result = $conn->query($selectCashierQuery);

                                if ($result && $result->num_rows > 0) {
                                    while ($userData = $result->fetch_assoc()) {
                                        $user_id = $userData['user_id'];
                                        $first_name = $userData['first_name'];
                                        $last_name = $userData['last_name'];
                                        $email = $userData['email'];
                                        $phone_number = $userData['phone_number'];
                                        $dob = $userData['dob'];
                                        $house_no = $userData['house_no'];
                                        $state = $userData['state'];
                                        $city = $userData['city'];
                                        $account_type = $userData['account_type'];
                                        $profile_url = $userData['profile_url'];
                                        $password = $userData['password'];
                                        $user_status = $userData['status'];
                                        $vehical = "";

                                        if ($user_status != "pending") {



                                            $selectDBQuery = "SELECT * FROM `technician` WHERE `user_id` = '$user_id'";
                                            $result1 = $conn->query($selectDBQuery);

                                            $status = "pending";

                                            $category = "";
                                            $nic_number = "";
                                            $nic_photo_url = "";
                                            $work_experience = "";
                                            $cost_per_day = "";
                                            $cost_per_hour = "";

                                            if ($result1 && $result1->num_rows > 0) {
                                                while ($userData1 = $result1->fetch_assoc()) {

                                                    $category = $userData1['category'];
                                                    $nic_number = $userData1['nic_number'];
                                                    $nic_photo_url = $userData1['nic_photo_url'];
                                                    $work_experience = $userData1['work_experience'];
                                                    $cost_per_day = $userData1['cost_per_day'];
                                                    $cost_per_hour = $userData1['cost_per_hour'];
                                                    $status = $userData1['status'];
                                                }
                                            }


                                            if ($status == "pending") {
                                                $error = true;
                                                echo '

                                        <a href="./new-technician-view.php?user=' . $user_id . '" class="card">
                                        <div class="technician-image">
                                            <img src="../assets/images/technician/' . $profile_url . '" alt="">
                                        </div>
                                        <div class="technician-name">
                                            <h3>' . $first_name . ' ' . $last_name . '</h3>
                                        </div>
                                        <div class="technician-details">
                                            <div class="technician-details-content">
                                                <div class="technician-details-content-1">
                                                    <p>City</p>
                                                </div>
                                                <div class="technician-details-content-2">
                                                    <p>' . $city . '</p>
                                                </div>
                                            </div>
                                            <div class="technician-details-content">
                                                <div class="technician-details-content-1">
                                                    <p>Date Of Birth</p>
                                                </div>
                                                <div class="technician-details-content-2">
                                                    <p>' . $dob . '</p>
                                                </div>
                                            </div>
                                            <div class="technician-details-content">
                                                <div class="technician-details-content-1">
                                                    <p>Years of experience</p>
                                                </div>
                                                <div class="technician-details-content-2">
                                                    <p>' . $work_experience . ' Years</p>
                                                </div>
                                            </div>
                                            <div class="technician-details-content">
                                                <div class="technician-details-content-1">
                                                    <p>Cost Per Day</p>
                                                </div>
                                                <div class="technician-details-content-2">
                                                    <p>' . $cost_per_day . '</p>
                                                </div>
                                            </div>
                                            <div class="technician-details-content">
                                                <div class="technician-details-content-1">
                                                    <p>Cost Per Hour</p>
                                                </div>
                                                <div class="technician-details-content-2">
                                                    <p>' . $cost_per_hour . '</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>';
                                            }
                                        }
                                    }
                                }
                            }

                            if ($error == false) {
                                echo "No new technician found.";
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