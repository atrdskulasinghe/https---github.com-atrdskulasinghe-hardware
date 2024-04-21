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
    <link rel="stylesheet" href="../assets/css/dashboard-wallet.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
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
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/item.png" alt="">Item</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
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
                        <!-- menu link 1
                            <div class="menu-link-button">
                                <a href="./index.php">
                                    <p><img src="../assets/images/ui/admin.png" alt="">Admin</p>
                                </a>
                            </div> -->
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
            <div class="wallet">
                <div class="content">
                    <div class="wallet-header">
                        <div class="wallet-header-card">
                            <div class="wallet-card-header">
                                <h4>Earned today</h4>
                            </div>
                            <div class="wallet-card-content">
                                <div>
                                    <div class="wallet-card-content-1">
                                        <h3>LRK.<?php echo $todayItemIcome + $todayBookingIcome; ?></h3>
                                    </div>
                                    <!-- <div class="wallet-card-content-2">
                                        <p>48% From Last 24 Hours</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="wallet-header-card">
                            <div class="wallet-card-header">
                                <h4>Earned this week</h4>
                            </div>
                            <div class="wallet-card-content">
                                <div>
                                    <div class="wallet-card-content-1">
                                        <h3>LRK.<?php echo $thisWeekItemIcome + $thisWeekBookingIcome;; ?></h3>
                                    </div>
                                    <!-- <div class="wallet-card-content-2">
                                        <p>48% From Last 24 Hours</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="wallet-header-card">
                            <div class="wallet-card-header">
                                <h4>Earned this month</h4>
                            </div>
                            <div class="wallet-card-content">
                                <div>
                                    <div class="wallet-card-content-1">
                                        <h3>LRK.<?php echo $monthItemIcome + $monthBookingIcome;; ?></h3>
                                    </div>
                                    <!-- <div class="wallet-card-content-2">
                                        <p>33% From Last 30 Day</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="wallet-review"> -->
                    <div class="wallet-history">
                        <div class="wallet-history-header-text">
                            <h2>Selling Report</h2>
                        </div>
                        <div class="wallet-history-header">
                            <div class="wallet-history-header-content-1">
                                <h4><?php echo date('W F Y'); ?></h4>
                                <p>Total Earning</p>
                            </div>
                            <div class="wallet-history-header-content-2">
                                <h2>LKR. <?php echo $totalItemIncome ?></h2>
                            </div>
                        </div>
                        <div class="wallet-table">
                            <table>
                                <tr>
                                    <td>Booking id</td>
                                    <td>Date</td>
                                    <td>Time</td>
                                    <td>Earnings</td>
                                    <!-- <td>Status</td> -->
                                </tr>
                                <?php

                                $booking1 = "SELECT * FROM `booking` WHERE 1";
                                $resultBooking1 = $conn->query($booking1);

                                if ($resultBooking1->num_rows > 0) {

                                    while ($rowBooking = $resultBooking1->fetch_assoc()) {

                                        $booking_id = $rowBooking['booking_id'];
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


                                        if ($status == 'finish') {

                                            echo '
                                                <tr>
                                                    <td>' . $booking_id . '</td>
                                                    <td>' . $finished_date . '</td>
                                                    <td>' . $finished_time . '</td>
                                                    <td>' . $cost . '</td>
                                                </tr>
                                        ';
                                        }
                                    }
                                }


                                ?>
                            </table>
                        </div>
                    </div>

                    <div class="wallet-history">
                        <div class="wallet-history-header-text">
                            <h2>Technician Earning Report</h2>
                        </div>
                        <div class="wallet-history-header">
                            <div class="wallet-history-header-content-1">
                                <h4><?php echo date('W F Y'); ?></h4>
                                <p>Total Earning</p>
                            </div>
                            <div class="wallet-history-header-content-2">
                                <h2>LKR. <?php echo $totalBookingIncome; ?></h2>
                            </div>
                        </div>
                        <div class="wallet-table">
                            <table>
                                <tr>
                                    <td>Booking id</td>
                                    <td>Date</td>
                                    <td>Time</td>
                                    <td>Earnings</td>
                                </tr>
                                <?php


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


                                                if ($order_status == 'finish') {

                                                    echo '
                                                    <tr>
                                                        <td>' . $booking_id . '</td>
                                                        <td>' . $finished_date . '</td>
                                                        <td>' . $finished_time . '</td>
                                                        <td>' . $cost . '</td>
                                                    </tr>
                                            ';
                                                }
                                            }
                                        }
                                    }
                                }


                                ?>
                            </table>
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