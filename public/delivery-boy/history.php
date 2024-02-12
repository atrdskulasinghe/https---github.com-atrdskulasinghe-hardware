<?php

include "../../config/database.php";

$user_id = 2;


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
    <link rel="stylesheet" href="../assets/css/dashboard-history.css">
    <link rel="stylesheet" href="../assets/css/button.css">
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
                        <a href="">
                            <p><img src="../assets/images/ui/Exit.png" alt="">Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
        <section class="active section">
            <div class="content">
                <div class="history">
                    <div class="history-table">
                        <table>
                            <tr>
                                <td>Delivery ID</td>
                                <td>Ordered Date</td>
                                <td>Status</td>
                                <td>Amount</td>
                                <td>Delivery Fee</td>
                                <td>Action</td>
                            </tr>

                            <?php
                            $error = false;

                            $selectUserQuery = "SELECT * FROM `delivery_boy` WHERE `user_id` = $user_id";
                            $result = $conn->query($selectUserQuery);

                            if ($result->num_rows > 0) {


                                $row = $result->fetch_assoc();
                                $delivery_boy_id = $row['delivery_boy_id'];

                                $selectDeliveryQuery = "SELECT * FROM `delivery` WHERE `delivery_boy_id` = $delivery_boy_id";
                                $resultDelivery = $conn->query($selectDeliveryQuery);

                                if ($resultDelivery->num_rows > 0) {

                                    while ($row = $resultDelivery->fetch_assoc()) {

                                        $delivery_id = $row['delivery_id'];
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
                                                $total_amount = 0;

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

                                                if ($status == "accept" || $status == "pickedup" || $status == "delivered") {

                                                    echo '
                                                <tr>
                                                    <td>' . $delivery_id . '</td>
                                                    <td>' . $date . ' / ' . $time . '</td>
                                                    <td>' . ucfirst($status) . '</td>
                                                    <td>LKR. ' . $total_amount . '</td>
                                                    <td>LKR. ' . $delivery_cost . '</td>
                                                    <td>
                                                    <button class="btn" onclick="window.location.href=\'history-view.php?delivery_id=' . $delivery_id . ' \'">View</button>
                                                    </td>
                                                </tr>
                                        ';
                                                }
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
        </section>
        <!-- </div> -->
    </div>

    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>