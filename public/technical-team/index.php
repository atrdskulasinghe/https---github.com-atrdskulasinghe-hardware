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

include "../../config/database.php";
include "../../template/user-data.php";

$startDate = date('Y-m-d', strtotime('-7 days'));
$endDate = date('Y-m-d');

$startDateMonth = date('Y-m-d', strtotime('-30 days'));
$endDateMonth = date('Y-m-d');

$todayItemIcome = 0;
$thisWeekItemIcome = 0;
$monthItemIcome = 0;
$totalItemIncome = 0;

$order_details = "SELECT * FROM `order_details` WHERE 1";
$resultOrderDetails = $conn->query($order_details);

if ($resultOrderDetails->num_rows > 0) {
    while ($rowOrderDetails = $resultOrderDetails->fetch_assoc()) {

        $order_id = $rowOrderDetails['order_id'];
        $item_id = $rowOrderDetails['item_id'];
        $order_type = $rowOrderDetails['order_type'];
        $quantity = $rowOrderDetails['quantity'];

        $item = "SELECT * FROM `item` WHERE `item_id` = $item_id";
        $resultItem = $conn->query($item);

        if ($resultItem->num_rows > 0) {
            $rowItem = $resultItem->fetch_assoc();

            $price = $rowItem['price'];

            $order = "SELECT * FROM `orders` WHERE `order_id` = $order_id";
            $resultOrder = $conn->query($order);

            if ($resultOrder->num_rows > 0) {
                $rowOrder = $resultOrder->fetch_assoc();

                $order_status = $rowOrder['order_status'];
                $date = $rowOrder['date'];


                if ($order_status != 'pending') {
                    // $itemIncome = ($price * $quantity) + $itemIncome;

                    $currentDate = date("Y-m-d");

                    if ($currentDate == $date) {
                        $todayItemIcome += $price * $quantity;
                    }

                    if ($date >= $startDate && $date <= $endDate) {
                        $thisWeekItemIcome += $price * $quantity;
                    }

                    if ($date >= $startDateMonth && $date <= $endDateMonth) {
                        $monthItemIcome += $price * $quantity;
                    }

                    $totalItemIncome += $price * $quantity;
                }
            }
        }
    }
}

// echo $monthItemIcome;

$todayBookingIcome = 0;
$thisWeekBookingIcome = 0;
$monthBookingIcome = 0;
$totalBookingIncome = 0;

$booking = "SELECT * FROM `booking` WHERE 1";
$resultBooking = $conn->query($booking);

if ($resultBooking->num_rows > 0) {
    while ($rowBooking = $resultBooking->fetch_assoc()) {

        $technician_id = $rowBooking['technician_id'];
        $customer_id = $rowBooking['customer_id'];
        $status = $rowBooking['status'];
        $booked_date = $rowBooking['booked_date'];
        $booked_time = $rowBooking['booked_time'];
        $accept_date = $rowBooking['accept_date'];
        $accept_time = $rowBooking['accept_time'];
        $start_date = $rowBooking['start_date'];
        $start_time = $rowBooking['start_time'];
        $finished_date = $rowBooking['finished_date'];
        $finished_time = $rowBooking['finished_time'];
        $photo_url = $rowBooking['photo_url'];
        $payment_status = $rowBooking['payment_status'];
        $payment_method = $rowBooking['payment_method'];
        $cost = $rowBooking['cost'];
        $description = $rowBooking['description'];

        $currentDate = date("Y-m-d");

        if ($currentDate == $finished_date) {
            $todayBookingIcome += $cost * 0.1;
        }

        if ($finished_date >= $startDate && $finished_date <= $endDate) {
            $thisWeekBookingIcome += $cost * 0.1;
        }

        if ($finished_date >= $startDateMonth && $finished_date <= $endDateMonth) {
            $monthBookingIcome += $cost * 0.1;
        }

        $totalBookingIncome += $cost * 0.1;
    }
}

// echo $totalBookingIncome;

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
    <link rel="stylesheet" href="../assets/css/dashboard-delivery-request.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            width: calc(100%);
            margin: 40px auto;
        }
    </style>



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
                        <div class="menu-link-button active">
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
                        <div class="menu-link-button-2 ">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/delivery-boy.png" alt="">Delivery Boy</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list ">
                                <div class="menu-link-button menu-hidden-button ">
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
                        <a href="../logout.php">
                            <p><img src="../assets/images/ui/Exit.png" alt="">Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
        <section class="active section">

        <div class="content">
                <div class="request">
                    <?php

                    $error = false;

                    // $selectUserQuery = "SELECT * FROM `delivery_boy` WHERE `user_id` = $user_id";
                    // $result = $conn->query($selectUserQuery);

                    // if ($result->num_rows > 0) {

                    // $row = $result->fetch_assoc();


                    $selectUserQuery = "SELECT * FROM `delivery` WHERE 1";
                    $result = $conn->query($selectUserQuery);

                    if ($result->num_rows > 0) {



                        while ($row = $result->fetch_assoc()) {


                            $delivery_id = $row['delivery_id'];
                            $order_id = $row['order_id'];
                            $date_of_pickup = $row['date_of_pickup'];
                            $time_of_pickup = $row['time_of_pickup'];
                            $date_of_delivered = $row['date_of_delivered'];
                            $time_of_delivered = $row['time_of_delivered'];
                            $status = $row['status'];
                            $house_no = $row['house_no'];
                            $state = $row['state'];
                            $city = $row['city'];

                            $delivery_cost = $row['delivery_cost'];
                            $description = $row['description'];
                            $latitude = $row['latitude'];
                            $longitude = $row['longitude'];

                            if ($status == "pending") {

                                $selectUserQuery = "SELECT * FROM `orders` WHERE `order_id` = $order_id";
                                $resultOrder = $conn->query($selectUserQuery);

                                if ($resultOrder->num_rows > 0) {

                                    $rowOrder = $resultOrder->fetch_assoc();

                                    $customer_user_id = $rowOrder['customer_id'];
                                    $order_date = $rowOrder['date'];
                                    $order_time = $rowOrder['time'];
                                    $order_status = $rowOrder['order_status'];

                                    if ($order_status == "pending") {

                                        $selectUserQuery = "SELECT * FROM `user` WHERE `user_id` = $customer_user_id";
                                        $resultUser = $conn->query($selectUserQuery);

                                        if ($resultUser->num_rows > 0) {

                                            $rowUser = $resultUser->fetch_assoc();

                                            $first_name = $rowUser['first_name'];
                                            $last_name = $rowUser['last_name'];
                                            $email = $rowUser['email'];
                                            $phone_number = $rowUser['phone_number'];
                                            $profile_url = $rowUser['profile_url'];

                                            $error = true;

                                            // $selectUserQuery = "SELECT * FROM `order_details` WHERE `order_id` = $order_id";
                                            // $resultItem = $conn->query($selectUserQuery);

                                            // if ($resultItem->num_rows > 0) {

                                                echo '
                                        <div class="request-content" href="">
                                            <div class="request-content-1">
                                            <iframe id="map"
                                                    frameborder="0" style="border:0"
                                                    src="https://www.openstreetmap.org/export/embed.html?bbox=' . ($longitude - 0.01) . '%2C' . ($latitude - 0.01) . '%2C' . ($longitude + 0.01) . '%2C' . ($latitude + 0.01) . '&amp;layer=mapnik&amp;marker=' . $latitude . '%2C' . $longitude . '">
                                            </iframe>
                                                <p>' . $description . '</p>
                                            </div>
                                            <div class="request-content-2">
                                                <div class="request-profile">
                                                    <div class="request-profile-content-1">
                                                        <img src="../assets/images/customer/' . $profile_url . '" alt="">
                                                    </div>
                                                    <div class="request-profile-content-2">
                                                        <h4>' . $first_name . ' ' . $last_name . '</h4>
                                                    </div>
                                                </div>
                                                <div class="request-details">
                                                    <div class="request-details-content-1">
                                                        <p>Order Id</p>
                                                    </div>
                                                    <div class="request-details-content-2">
                                                        <p>' . $order_id . '</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="request-details">
                                                    <div class="request-details-content-1">
                                                        <p>Phone Number</p>
                                                    </div>
                                                    <div class="request-details-content-2">
                                                        <p>' . $phone_number . '</p>
                                                    </div>
                                                </div>
                                                <div class="request-details">
                                                    <div class="request-details-content-1">
                                                        <p>Address</p>
                                                    </div>
                                                    <div class="request-details-content-2">
                                                        <p>' . $house_no . '<br>' . $state . '<br>' . $city . '</p>
                                                    </div>
                                                </div>
                    
                                                <div class="request-button">
                                                    <button type="button" class="btn" onclick="view(' . $order_id . ', \'accept\')">View Details</button> 
                                                </div>
                                            </div>
                                        </div>
                    
                                        ';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    // }
                    // }
                    // }

                    if ($error == false) {
                        echo "<p>Devlivery request not found</p>";
                    }


                    ?>

                </div>
            </div>

        </section>
        <!-- </div> -->
    </div>
    <script>

function view(orderId, status) {
    window.location.href = './view-order.php?order_id=' + orderId;
}
</script>
    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>