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


$user_id = 2;
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
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
$delivery_id = "";

$user_id = $_SESSION['id'];
$order_id = "";

if (isset($_GET['order_id'])) {
    if (!empty($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
    }
}

$selectOrderQuery = "SELECT * FROM `orders` WHERE `order_id` = $order_id";
$resultOrder = $conn->query($selectOrderQuery);

if ($resultOrder->num_rows > 0) {

    while ($rowOrder = $resultOrder->fetch_assoc()) {

        $customer_id = $rowOrder['customer_id'];
        $date = $rowOrder['date'];
        $time = $rowOrder['time'];
        $payment_method = $rowOrder['payment_method'];
        $payment_status = $rowOrder['payment_status'];
        $order_status = $rowOrder['order_status'];

        $selectDeliveryQuery = "SELECT * FROM `delivery` WHERE `order_id` = $order_id";
        $resultDelivery = $conn->query($selectDeliveryQuery);

        if ($resultDelivery->num_rows > 0) {
            $rowDelivery = $resultDelivery->fetch_assoc();

            $delivery_id = $rowDelivery['delivery_id'];
            $delivery_boy_id = $rowDelivery['delivery_boy_id'];
            $date_of_pickup = $rowDelivery['date_of_pickup'];
            $time_of_pickup = $rowDelivery['time_of_pickup'];
            $date_of_delivered = $rowDelivery['date_of_delivered'];
            $time_of_delivered = $rowDelivery['time_of_delivered'];
            $first_name = $rowDelivery['first_name'];
            $last_name = $rowDelivery['last_name'];
            $phone_no = $rowDelivery['phone_no'];
            $status = $rowDelivery['status'];
            $house_no = $rowDelivery['house_no'];
            $state = $rowDelivery['state'];
            $city = $rowDelivery['city'];
            $delivery_cost = $rowDelivery['delivery_cost'];
            $description = $rowDelivery['description'];
            $latitude = $rowDelivery['latitude'];
            $longitude = $rowDelivery['longitude'];

            $selectOrderDetailsQuery = "SELECT * FROM `order_details` WHERE `order_id` = $order_id";
            $resultOrderDetails = $conn->query($selectOrderDetailsQuery);

            if ($resultOrderDetails->num_rows > 0) {

                while ($rowOrderDetails = $resultOrderDetails->fetch_assoc()) {
                    $item_id = $rowOrderDetails['item_id'];
                    $order_type = $rowOrderDetails['order_type'];
                    $quantity = $rowOrderDetails['quantity'];

                    $selectItemQuery = "SELECT * FROM `item` WHERE `item_id` = $item_id";
                    $resultItem = $conn->query($selectItemQuery);

                    if ($resultItem->num_rows > 0) {
                        $rowItem = $resultItem->fetch_assoc();

                        $name = $rowItem['name'];
                        $price = $rowItem['price'];
                        $stock_quantity = $rowItem['stock_quantity'];

                        $total_amount += $quantity * $price;
                    }
                }
            }
        }
    }
}

$total_amount += 200;

if (isset($_POST['accept'])) {

    $updateUserQuery = "UPDATE `orders` SET 
    `order_status` = 'active'
    WHERE `order_id` = $order_id";

    if ($conn->query($updateUserQuery) === TRUE) {
        header("location: ./orders.php");
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
    <link rel="stylesheet" href="../assets/css/dashboard-delivery-request.css">
    <link rel="stylesheet" href="../assets/css/button.css">

    <link rel="stylesheet" href="../assets/css/dashboard-history-view.css">
    <link rel="stylesheet" href="../assets/css/line-1.css">
    <link rel="stylesheet" href="../assets/css/dashboard-history.css">

    <link rel="stylesheet" href="../assets/css/user-cart.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />



</head>

<body>
    <div class="container">
        <!-- navigation -->
        <?php
        include "../../template/dashboard-nav.php";
        ?>
        <!-- <div class="content"> -->
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
                        <div class="menu-link-button active">
                            <a href="./orders.php">
                                <p><img src="../assets/images/ui/add item.png" alt="">Orders</p>
                            </a>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2  ">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/item.png" alt="">Item</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button ">
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
                <div class="history">
                    <div class="history-details-1">
                        <p>Order ID: <?php echo $order_id ?></p>
                        <p>Status: <?php echo ucfirst($status) ?></p>
                        <p>Total Amount : LKR.<?php echo $total_amount ?></p>
                    </div>
                    <!-- <div class="history-details-2">
                        <div class="line-content">
                            <div class="line-all-content">
                                <div class="line-circle line-circle-1 <?php if ($status == "accept" || $status == "pickedup" || $status == "delivered") {
                                                                            echo "active";
                                                                        } ?>">
                                    <i class="ri-check-line"></i>
                                    <h4>Order Accepted</h4>
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
                    </div> -->
                    <div class="history-details-3 margin-top-30">
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
                    <!-- <div class="input-content">
                            <form class="right-button margin-top-30" method="POST">
                                <input type="button" class="btn" value="Contact" onclick="window.location.href='message.php?receiver_id=<?php echo $customer_user_id ?>delivery_id=<?php echo $delivery_id ?>'">
                                <input type="button" class="btn" value="Location" onclick="window.location.href=''">
                                
                            </form>
                        </div> -->
                </div>
                <div class="user-cart" style="margin-top: -50px;">
                    <div class="box">
                        <h3>All Items</h3>
                        <div class="user-cart-content">

                            <div style="width: 100%; ">
                                <!-- <div class="user-cart-content-1"> -->

                                <?php
                                $selectOrderQuery = "SELECT * FROM `orders` WHERE `order_id` = $order_id";
                                $resultOrder = $conn->query($selectOrderQuery);

                                if ($resultOrder->num_rows > 0) {

                                    while ($rowOrder = $resultOrder->fetch_assoc()) {

                                        $customer_id = $rowOrder['customer_id'];
                                        $date = $rowOrder['date'];
                                        $time = $rowOrder['time'];
                                        $payment_method = $rowOrder['payment_method'];
                                        $payment_status = $rowOrder['payment_status'];
                                        $order_status = $rowOrder['order_status'];

                                        $selectDeliveryQuery = "SELECT * FROM `delivery` WHERE `order_id` = $order_id";
                                        $resultDelivery = $conn->query($selectDeliveryQuery);

                                        if ($resultDelivery->num_rows > 0) {
                                            $rowDelivery = $resultDelivery->fetch_assoc();

                                            $delivery_id = $rowDelivery['delivery_id'];
                                            $delivery_boy_id = $rowDelivery['delivery_boy_id'];
                                            $date_of_pickup = $rowDelivery['date_of_pickup'];
                                            $time_of_pickup = $rowDelivery['time_of_pickup'];
                                            $date_of_delivered = $rowDelivery['date_of_delivered'];
                                            $time_of_delivered = $rowDelivery['time_of_delivered'];
                                            $first_name = $rowDelivery['first_name'];
                                            $last_name = $rowDelivery['last_name'];
                                            $phone_no = $rowDelivery['phone_no'];
                                            $status = $rowDelivery['status'];
                                            $house_no = $rowDelivery['house_no'];
                                            $state = $rowDelivery['state'];
                                            $city = $rowDelivery['city'];
                                            $delivery_cost = $rowDelivery['delivery_cost'];
                                            $description = $rowDelivery['description'];
                                            $latitude = $rowDelivery['latitude'];
                                            $longitude = $rowDelivery['longitude'];

                                            $selectOrderDetailsQuery = "SELECT * FROM `order_details` WHERE `order_id` = $order_id";
                                            $resultOrderDetails = $conn->query($selectOrderDetailsQuery);

                                            if ($resultOrderDetails->num_rows > 0) {

                                                while ($rowOrderDetails = $resultOrderDetails->fetch_assoc()) {

                                                    $item_id = $rowOrderDetails['item_id'];
                                                    $quantity = $rowOrderDetails['quantity'];

                                                    $selectItemQuery = "SELECT * FROM `item` WHERE `item_id` = $item_id";
                                                    $resultItem = $conn->query($selectItemQuery);

                                                    if ($resultItem->num_rows > 0) {
                                                        $rowItem = $resultItem->fetch_assoc();

                                                        $name = $rowItem['name'];
                                                        $price = $rowItem['price'];
                                                        $stock_quantity = $rowItem['stock_quantity'];
                                                        $creation_date = $rowItem['creation_date'];
                                                        $expiration_date = $rowItem['expiration_date'];
                                                        $brand = $rowItem['brand'];
                                                        $discount = $rowItem['discount'];
                                                        $warranty = $rowItem['warranty'];
                                                        $weight = $rowItem['weight'];
                                                        $manufacturer = $rowItem['manufacturer'];
                                                        $description = $rowItem['description'];

                                                        $selectItemImageQuery = "SELECT * FROM `item_image` WHERE `item_id` = $item_id";
                                                        $resultItemImage = $conn->query($selectItemImageQuery);

                                                        if ($resultItemImage->num_rows > 0) {
                                                            $rowItemImage = $resultItemImage->fetch_assoc();
                                                            $image_url = $rowItemImage['image_url'];

                                                            $total_amount_item = $price * $quantity;

                                                            $itemFeedback = "SELECT * FROM `item_feedback` WHERE `item_id` = $item_id";
                                                            $resultFeedback = $conn->query($itemFeedback);

                                                            $feedback = false;

                                                            if ($resultFeedback->num_rows > 0) {
                                                                $rowFeedback = $resultFeedback->fetch_assoc();
                                                                $feedback = true;
                                                            }

                                                            echo '
                                                                    <div class="user-cart-product">
                                                                        <div class="cart-product-1">
                                                                            <div class="cart-product-1-1">
                                                                                <img src="../assets/images/product/' . $image_url . '" alt="" style="object-fit:cover;">
                                                                            </div>
                                                                            <div class="cart-product-1-2">
                                                                                <div class="cart-product-1-2-1">
                                                                                    <p>' . $name . '</p>
                                                                                </div>
                                                                                <div class="cart-product-1-2-2">
                                                                                    <div class="cart-q">
                                                                                        <p>Quantity: <input class="quantity" type="text" value="' . $quantity . '" disabled></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cart-product-2">
                                                                            <div class="cart-product-1-2-1">
                                                                                <p class="total-amount-item">Total Amount: LKR.' . $total_amount_item . '</p>
                                                                            </div>
                                                                            <div class="cart-product-1-2-2">';

                                                            if ($status == "delivered") {
                                                                if (!$feedback) {
                                                                    echo '<a href="./feedback.php?order_id=' . $order_id . '&item_id=' . $item_id . '" class="" style="text-align: right; cursor:pointer;"><i class="ri-feedback-line"></i></a>';
                                                                }
                                                                
                                                            }

                                                            echo '
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
                                }
                                ?>
                            </div>
                            <!-- </div> -->


                        </div>
                    </div>
                </div>
                <form class="input-content" method="post">
                    <div class="right-button margin-top-10" style="padding-bottom: 40px;">
                        <?php

                        // echo $order_status;

                        if ($order_status != "accept") {
                            // echo '<input type="submit" value="Picked up" name="pickedup" class="btn" >';
                            // } else if ($status == "delivered") {
                            //     if ($payment_method == "card") {
                            //         if ($payment_status == "pending") {
                            //             echo '<input type="submit" value="Paid" name="paid" class="btn" >';
                            //         }
                            //     }

                            // $delivery_boy_feedback = "SELECT * FROM `delivery_boy_feedback` WHERE `delivery_id` = $delivery_id";
                            // $resultFeedback = $conn->query($delivery_boy_feedback);

                            // if ($resultFeedback->num_rows > 0) {
                            //     // $rowFeedback = $resultFeedback->fetch_assoc();
                            // } else {
                            echo '<input type="submit" value="Accept Order" name="accept" class="btn">';
                            // }
                        }

                        ?>
                    </div>
                </form>
            </div>
        </section>
        <!-- </div> -->
    </div>

    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
    <script>
        function view(orderId, status) {
            window.location.href = 'view-order.php?order_id=' + orderId + '&status=' + status;
        }
    </script>
</body>

</html>