<?php
include "../config/database.php";
include "../template/user-data.php";

$searchData = "";

if (isset($_GET['product_name'])) {
    if ($_GET['product_name'] !== "") {
        $searchData = $_GET['product_name'];
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav class="nav-1">
        <!-- <iframe src="components/nav-1.html" width="100%" height="70px" frameborder="0"></iframe> -->
        <div class="box">
            <div class="nav-1-content">
                <div class="nav-1-content-0">
                    <!-- menu icon -->
                    <div class="menu-icon">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <!-- navigation logo -->
                <div class="nav-1-content-1">
                    <!-- <h1>LOGO</h1> -->
                    <img src="./assets/images/ui/hardware-logo.png" alt="" style="height:30px">
                </div>
                <!-- navigation search bar -->
                <div class="nav-1-content-2">
                    <form class="nav-content-2-search" method="get" action="./products.php">
                        <input type="text" placeholder="Search" name="product_name" value="<?php echo $searchData; ?>">
                        <button type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>
                <!-- navigation icons -->

                <div class="nav-1-content-3 <?php if (isset($_SESSION['id'])) {
                                                echo "active";
                                            } ?>">
                    <div class="nav-1-content-3-content-1">
                        <ul>
                            <li>
                                <a href="./cart.php">
                                    <i class="bi bi-bag-fill" id="cart"></i>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="">
                                    <i class="bi bi-chat-fill" id="message"></i>
                                </a>
                            </li> -->
                            <?php

                            $bookingNotications = 0;
                            $deliveryNotications = 0;

                            if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
                                if ($_SESSION['account_type'] == "customer") {

                                    $notification1 = "SELECT * FROM `booking` WHERE `customer_id` = $user_user_id";
                                    $resultNotification1 = $conn->query($notification1);

                                    if ($resultNotification1->num_rows > 0) {
                                        while ($itemNotification1 = $resultNotification1->fetch_assoc()) {

                                            $status = $itemNotification1['status'];
                                            $payment_status = $itemNotification1['payment_status'];

                                            if ($status == "finish") {
                                                if ($payment_status == "pending") {
                                                    $bookingNotications += 1;
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
                                            $order_id6 = $itemNotification2['order_id'];

                                            if ($payment_method == "cash") {
                                                if ($payment_status == "pending") {

                                                    $notification3 = "SELECT * FROM `delivery` WHERE `order_id` = $order_id6";
                                                    $resultNotification3 = $conn->query($notification3);

                                                    if ($resultNotification3->num_rows > 0) {
                                                        $itemNotification3 = $resultNotification3->fetch_assoc();

                                                        $date_of_delivered = $itemNotification3['date_of_delivered'];
                                                        $status = $itemNotification3['status'];

                                                        if ($status == "delivered") {


                                                            $deliveryNotications += 1;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            ?>
                            <li>
                                <a href="./notification.php" style="position: relative;">
                                    <i class="bi bi-bell-fill" id="notification"></i>
                                    <h4 style="position: absolute; top:-10px; right:-10px; background:green; color:white; width:20px; height: 20px; display:flex; justify-content:center; align-items: center; border-radius:50%;font-family: sans-serif; font-size:14px;"><?php echo $bookingNotications + $deliveryNotications ?></h4>
                                </a>
                            </li>
                        </ul>
                        <div class="nav-1-profile">
                            <img style="width:35px; height: 35px;" src="<?php if (isset($_SESSION['id'])) {
                                                                            echo './assets/images/ui/user.png';
                                                                        } else {
                                                                            echo './assets/images/ui/user.png';
                                                                        } ?>" alt="P" id="profile-icon">
                        </div>
                    </div>
                    <div class="nav-1-content-3-content-2">
                        <i class="bi bi-search" id="mobile-search-icon"></i>
                    </div>
                    <div class="profile-content">
                        <ul>
                            <li>
                                <a href="./profile.php"><img src="<?php if (isset($_SESSION['id'])) {
                                                                        echo './assets/images/customer/' . $user_profile_url;
                                                                    } else {
                                                                        echo './assets/images/ui/user2.png';
                                                                    } ?>" alt=""><?php echo $user_first_name . " " . $user_last_name ?></a>
                            </li>
                            <li>
                                <a href="./cart.php"><img src="./assets/images/ui/all items.png" alt="">Cart</a>
                            </li>
                            <li>
                                <a href="./order-history.php"><img src="./assets/images/ui/item.png" alt=""> Order History</a>
                            </li>
                            <li>
                                <a href="./book-history.php"><img src="./assets/images/ui/booking.png" alt=""> Booked History</a>
                            </li>
                            <li>
                                <a href="./logout.php"><img src="./assets/images/ui/exit.png" alt=""> Logout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="notification-content">
                        <div class="notification-header">
                            <div class="notification-header-content-1">
                                <h3>notification</h3>
                            </div>
                            <div class="notification-header-content-2">
                                <a href="">See All</a>
                            </div>
                        </div>
                        <ul>
                            <li>
                                <a href="">
                                    <img src="" alt="">
                                    <div class="notification-details">
                                        <p>Title nofafdsf</p>
                                        <span>4 hours ago</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="message-content">
                        <div class="message-header">
                            <div class="message-header-content-1">
                                <h3>messages</h3>
                            </div>
                            <div class="message-header-content-2">
                                <a href="">See All</a>
                            </div>
                        </div>
                        <ul>
                            <li>
                                <a href="">
                                    <img src="images/profile/profile-1.webp" alt="">
                                    <div class="message-details">
                                        <p>Nimal Sampath</p>
                                        <span>hello</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div> -->

                </div>
                <div class="nav-1-content-4 <?php if (!isset($_SESSION['id'])) {
                                                echo "active";
                                            } ?>">
                    <div class="nav-1-content-4-login">
                        <a href="./login.php">Login</a>
                        <a href="./signup.php" style="margin-left: 10px;">Signup</a>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    <nav class="nav-2">
        <!-- <iframe src="components/nav-2.html" width="100%" height="70px" frameborder="0"></iframe> -->
        <div class="box">
            <div class="nav-2-content">
                <div class="nav-2-content-1">
                    <ul>
                        <li>
                            <a href="./index.php">home</a>
                        </li>
                        <li>
                            <a href="./technicians.php">sevices</a>
                        </li>
                        <li>
                            <a href="products.php">products</a>
                        </li>
                        <li>
                            <a href="contact.php">contact us</a>
                        </li>
                        <!-- <li>
                            <a href="about.php">about us</a>
                        </li> -->
                    </ul>
                </div>
                <div class="nav-2-content-2">
                    <p>Call us on : <a href="">011 2 800 200</a></p>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>