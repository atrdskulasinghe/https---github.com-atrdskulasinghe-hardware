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
        // header('location: ../delivery-doy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        header('location: ../admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ../technical-team/index.php');
    }
} else {
    header('location: ../login.php');
}

include "../../config/database.php";
include "../../template/user-data.php";

$user_id = 2;
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}

$delivery_id = "";

if (isset($_GET['delivery_id'])) {
    if (!empty($_GET['delivery_id'])) {
        $delivery_id = $_GET['delivery_id'];
    } else {
        header('location: history.php');
    }
} else {
    header('location: history.php');
}

$order_id = "";
$date_of_pickup = "";
$time_of_pickup = "";
$date_of_delivered = "";
$time_of_delivered = "";
$status = "";
$house_no = "";
$state = "";
$city = "";
$location_url = "";
$delivery_cost = "";
$description = "";
$time = "";
$date = "";
$total_amount = 0;
$payment_method = "";
$payment_status = "";
$customer_user_id = "";
$delivery_boy_id = "";

$selectUserQuery = "SELECT * FROM `delivery_boy` WHERE `user_id` = $user_id";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $delivery_boy_id = $row['delivery_boy_id'];

    $selectDeliveryQuery = "SELECT * FROM `delivery` WHERE `delivery_id` = '$delivery_id'";
    $resultDelivery = $conn->query($selectDeliveryQuery);



    if ($resultDelivery->num_rows > 0) {

        $row = $resultDelivery->fetch_assoc();


        $delivery_boy_idDB = $row['delivery_boy_id'];
        $order_id = $row['order_id'];
        $date_of_pickup = $row['date_of_pickup'];
        $time_of_pickup = $row['time_of_pickup'];
        $date_of_delivered = $row['date_of_delivered'];
        $time_of_delivered = $row['time_of_delivered'];
        $status = $row['status'];
        $house_no = $row['house_no'];
        $state = $row['state'];
        $city = $row['city'];
        $location_url = $row['location_url'];
        $delivery_cost = $row['delivery_cost'];
        $description = $row['description'];

        if ($delivery_boy_idDB == $delivery_boy_id) {

            $selectUserQuery = "SELECT * FROM `orders` WHERE `order_id` = $order_id";
            $result = $conn->query($selectUserQuery);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();

                $time = $row['time'];
                $date = $row['date'];

                $payment_method = $row['payment_method'];
                $payment_status = $row['payment_status'];
                $customer_user_id = $row['customer_id'];

                $selectOrderDetailsQuery = "SELECT * FROM `order_details` WHERE `order_id` = $order_id";
                $resultOrderDetails = $conn->query($selectOrderDetailsQuery);

                if ($resultOrderDetails->num_rows > 0) {

                    while ($rowOrderDetails = $resultOrderDetails->fetch_assoc()) {

                        $item_id = $rowOrderDetails['item_id'];
                        $quantity = $rowOrderDetails['quantity'];

                        $selectUserQuery = "SELECT * FROM `item` WHERE `item_id` = $item_id";
                        $result = $conn->query($selectUserQuery);

                        if ($result->num_rows > 0) {

                            $row = $result->fetch_assoc();
                            $price = $row['price'];

                            $total_amount += $quantity * $price;
                        }
                    }
                }

                $total_amount += $delivery_cost;
            } else {
                header('location: history.php');
            }
        } else {
            header('location: history.php');
        }
    } else {
        header('location: history.php');
    }
} else {
    header('location: history.php');
}

$currentDate = date("Y-m-d");
$currentTime = date("H:i:s");

if (isset($_POST['pickedup'])) {

    if ($status == "accept") {

        $updateQuery = "UPDATE `delivery` SET 
            `status` = 'pickedup',
            `date_of_pickup` = '$currentDate',
            `time_of_pickup` = '$currentTime'
            WHERE `delivery_id` = $delivery_id";

        if ($conn->query($updateQuery) === TRUE) {
            header('location: history-view.php?delivery_id=' . $delivery_id . '');
        } else {
            header('location: history.php');
        }
    }
}

if (isset($_POST['finished'])) {

    $updateQuery = "UPDATE `delivery` SET 
            `status` = 'delivered',
            `date_of_delivered` = '$currentDate',
            `time_of_delivered` = '$currentTime'
            WHERE `delivery_id` = $delivery_id";

    if ($conn->query($updateQuery) === TRUE) {

        header('location: history-view.php?delivery_id=' . $delivery_id . '');
    } else {
        header('location: history.php');
    }
}

if (isset($_POST['paid'])) {

    if ($payment_method == "cash") {

        $updateQuery = "UPDATE `orders` SET 
            `payment_status` = 'paid'
            WHERE `order_id` = $order_id";

        if ($conn->query($updateQuery) === TRUE) {

            $selectUserQuery = "SELECT * FROM `delivery_boy` WHERE `delivery_boy_id` = $delivery_boy_id";
            $result = $conn->query($selectUserQuery);

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();

                $balance = $row['balance'];
                $now_balance = $balance + $delivery_cost;

                $updateQuery = "UPDATE `delivery_boy` SET 
                    `balance` = '$now_balance'
                    WHERE `delivery_boy_id` = $delivery_boy_id";

                if ($conn->query($updateQuery) === TRUE) {
                    header('location: history-view.php?delivery_id=' . $delivery_id . '');
                }
            }
        } else {
            header('location: history.php');
        }
    }
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
    <link rel="stylesheet" href="../assets/css/dashboard-history-view.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/line-1.css">
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
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./delivery-request.php">
                                <p><img src="../assets/images/ui/Product.png" alt="">Delivery Request</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./calender.php">
                                <p><img src="../assets/images/ui/Calendar.png" alt="">Calendar</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./wallet.php">
                                <p><img src="../assets/images/ui/Wallet.png" alt="">My Wallet</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./salary-request.php">
                                <p><img src="../assets/images/ui/salary-request.png" alt="">Salary Request</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./feedback.php">
                                <p><img src="../assets/images/ui/Feedback.png" alt="">Feedback</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./message.php">
                                <p><img src="../assets/images/ui/messages.png" alt="">Messages</p>
                            </a>
                        </div>

                        <!-- menu link 1 -->
                        <div class="menu-link-button active">
                            <a href="./history.php">
                                <p><img src="../assets/images/ui/history.png" alt="">History</p>
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
                <div class="history">
                    <div class="history-details-1">
                        <p>Delivery ID: <?php echo $delivery_id ?></p>
                        <p>Status: <?php echo ucfirst($status) ?></p>
                        <p>Total Amount : LKR.<?php echo $total_amount ?></p>
                    </div>
                    <div class="history-details-2">
                        <div class="line-content">
                            <div class="line-all-content">
                                <div class="line-circle line-circle-1 <?php if ($status == "accept" || $status == "pickedup" || $status == "delivered") {
                                                                            echo "active";
                                                                        } ?>">
                                    <i class="ri-check-line"></i>
                                    <h4>Order Confirmed</h4>
                                </div>
                                <div class="line line-1 <?php if ($status == "pickedup" || $status == "delivered") {
                                                            echo "active";
                                                        } ?>"></div>
                                <div class="line-circle line-circle-2 <?php if ($status == "pickedup" || $status == "delivered") {
                                                                            echo "active";
                                                                        } ?>">
                                    <i class="ri-check-line"></i>
                                    <h4>Picked up order</h4>
                                </div>
                                <div class="line  line-2 <?php if ($status == "delivered") {
                                                                echo "active";
                                                            } ?>"></div>
                                <div class="line-circle line-circle-3 <?php if ($status == "delivered") {
                                                                            echo "active";
                                                                        } ?>">
                                    <i class="ri-check-line"></i>
                                    <h4>Delivered</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="history-details-3">
                        <div class="history-details-3-content-1">
                            <h4>Ordered Date & Time</h4>
                            <p><?php echo $date . ' / ' . $time ?></p>
                            <h4>Pickup Date & Time</h4>
                            <p><?php if (!empty($date_of_pickup)) {
                                    echo $date_of_pickup . ' / ' . $time_of_pickup;
                                } else {
                                    echo "-";
                                } ?></p>
                        </div>
                        <div class="history-details-3-content-2">
                            <div>
                                <h4>Delivered Date & Time</h4>
                                <p><?php if (!empty($date_of_delivered)) {
                                        echo $date_of_delivered . ' / ' . $time_of_delivered;
                                    } else {
                                        echo "-";
                                    } ?></p>
                                <h4>Payment Status</h4>
                                <p><?php echo ucfirst($payment_status) ?></p>
                            </div>
                        </div>
                        <div class="history-details-3-content-3">
                            <div>
                                <h4>Payment Method</h4>
                                <p><?php echo ucfirst($payment_method) ?></p>
                                <h4>Address</h4>
                                <p><?php echo ucfirst($house_no) . ',<br>' . ucfirst($state) . ',<br>' . ucfirst($city) ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="input-content">
                        <form class="right-button margin-top-30" method="POST">
                            <input type="button" class="btn" value="Contact" onclick="window.location.href='message.php?receiver_id=<?php echo $customer_user_id ?>delivery_id=<?php echo $delivery_id ?>'">
                            <input type="button" class="btn" value="Location" onclick="window.location.href=''">
                            <?php

                            if ($status == "accept") {
                                echo '<input type="submit" value="Picked up" name="pickedup" class="btn" >';
                            } else if ($status == "pickedup") {
                                echo '<input type="submit" value="Finished" name="finished" class="btn" >';
                            } else if ($status == "delivered") {
                                if ($payment_method == "card") {
                                    if ($payment_status == "pending") {
                                        echo '<input type="submit" value="Paid" name="paid" class="btn" >';
                                    }
                                }
                            }

                            ?>
                        </form>
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