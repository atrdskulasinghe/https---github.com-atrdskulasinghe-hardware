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
    <link rel="stylesheet" href="./assets/css/notification.css">
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
                <div class="notification-section">

                    <?php

                    $notification1 = "SELECT * FROM `booking` WHERE `customer_id` = $user_user_id  ORDER BY `booking_id` DESC";
                    $resultNotification1 = $conn->query($notification1);

                    if ($resultNotification1->num_rows > 0) {
                        while ($itemNotification1 = $resultNotification1->fetch_assoc()) {

                            $status = $itemNotification1['status'];
                            $payment_status = $itemNotification1['payment_status'];
                            $finished_date = $itemNotification1['finished_date'];
                            $finished_time = $itemNotification1['finished_time'];
                            $booking_id = $itemNotification1['booking_id'];

                            if ($status == "finish") {
                                if ($payment_status == "pending") {

                                    echo '
                                    <a href="book-history-view.php?booking_id=' . $booking_id . '" class="notification-list">
                                            <div class="notification-details">
                                                <h1>' . $finished_date . ' - '.$finished_time.' - Payment Reminder</h1>
                                                <p>The technician has completed the work. Please make the payment. </p>
                                                <div class="notifi-dot">
                                                        <i class="ri-circle-fill"></i>
                                                    </div>
                                            </div>
                                        </a>
                                    
                                    ';
                                } else {
                                    echo '
                                    <a href="book-history-view.php?booking_id=' . $booking_id . '" class="notification-list">
                                            <div class="notification-details">
                                                <h1>' . $finished_date . ' - '.$finished_time.' - Payment Reminder</h1>
                                                <p>The technician has completed the work. Please make the payment. </p>
                                                
                                            </div>
                                        </a>
                                    
                                    ';
                                }
                            }
                        }
                    }

                    $notification2 = "SELECT * FROM `orders` WHERE `customer_id` = $user_user_id";
                    $resultNotification2 = $conn->query($notification2);

                    if ($resultNotification2->num_rows > 0) {
                        while ($itemNotification2 = $resultNotification2->fetch_assoc()) {

                            $payment_method = $itemNotification2['payment_method'];
                            $payment_status = $itemNotification2['payment_status'];
                            $order_id = $itemNotification2['order_id'];

                            if ($payment_method == "cash") {
                                if ($payment_status == "pending") {

                                    $notification3 = "SELECT * FROM `delivery` WHERE `order_id` = $order_id";
                                    $resultNotification3 = $conn->query($notification3);

                                    if ($resultNotification3->num_rows > 0) {
                                        $itemNotification3 = $resultNotification3->fetch_assoc();

                                        $date_of_delivered = $itemNotification3['date_of_delivered'];
                                        $time_of_delivered = $itemNotification3['time_of_delivered'];
                                        $status1 = $itemNotification3['status'];

                                        if ($status1 == "delivered") {
                                            echo '
                                        <a href="order-history-view.php?order_id=' . $order_id . '" class="notification-list">
                                                <div class="notification-details">
                                                    <h1>' . $date_of_delivered . ' - '.$time_of_delivered.' - Payment Reminder</h1>
                                                    <p>The order was placed. Make the payment.</p>
                                                    <div class="notifi-dot">
                                                        <i class="ri-circle-fill"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        
                                        ';
                                        }
                                    }
                                } else {

                                    $notification4 = "SELECT * FROM `delivery` WHERE `order_id` = $order_id  ORDER BY `delivery_id` DESC";
                                    $resultNotification3 = $conn->query($notification4);

                                    if ($resultNotification3->num_rows > 0) {
                                        $itemNotification3 = $resultNotification3->fetch_assoc();

                                        $date_of_delivered = $itemNotification3['date_of_delivered'];
                                        $time_of_delivered = $itemNotification3['time_of_delivered'];
                                        $status1 = $itemNotification3['status'];

                                        if ($status1 == "delivered") {
                                            echo '
                                        <a href="order-history-view.php?order_id=' . $order_id . '" class="notification-list">
                                                <div class="notification-details">
                                                    <h1>' . $date_of_delivered. ' - '.$time_of_delivered.' - Payment Reminder</h1>
                                                    <p>The order was placed. Make the payment.</p>
                                                    
                                                </div>
                                            </a>
                                        
                                        ';
                                        }
                                    }
                                }
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
</body>

</html>