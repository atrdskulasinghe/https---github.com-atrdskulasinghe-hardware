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
        $user_id = $_SESSION['id'];
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

// $user_id = 2;
// if (isset($_SESSION['id'])) {
//     $user_id = $_SESSION['id'];
// }


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
                        <!-- menu link 1 -->
                        <div class="menu-link-button active">
                            <a href="./delivery-request.php">
                                <p><img src="../assets/images/ui/Product.png" alt="">Delivery Request</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <!-- <div class="menu-link-button">
                            <a href="./calender.php">
                                <p><img src="../assets/images/ui/Calendar.png" alt="">Calendar</p>
                            </a>
                        </div> -->
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
                        <div class="menu-link-button ">
                            <a href="./feedback.php">
                                <p><img src="../assets/images/ui/Feedback.png" alt="">Feedback</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <!-- <div class="menu-link-button">
                            <a href="./message.php">
                                <p><img src="../assets/images/ui/messages.png" alt="">Messages</p>
                            </a>
                        </div> -->

                        <!-- menu link 1 -->
                        <div class="menu-link-button">
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
                <div class="request">
                    <?php

                    $error = false;

                    $selectUserQuery = "SELECT * FROM `delivery_boy` WHERE `user_id` = $user_id";
                    $result = $conn->query($selectUserQuery);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        $delivery_boy_id = $row['delivery_boy_id'];

                        

                        $selectUserQuery = "SELECT * FROM `delivery` WHERE `delivery_boy_id` = $delivery_boy_id";
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
                                
                                // echo $delivery_id;

                                $delivery_cost = $row['delivery_cost'];
                                $description = $row['description'];
                                $latitude = $row['latitude'];
                                $longitude = $row['longitude'];

                                // echo $order_id;

                                // 

                                if ($status == "pending") {

                                    $selectUserQuery = "SELECT * FROM `orders` WHERE `order_id` = $order_id";
                                    $resultOrder = $conn->query($selectUserQuery);

                                    if ($resultOrder->num_rows > 0) {

                                        $rowOrder = $resultOrder->fetch_assoc();

                                        $customer_user_id = $rowOrder['customer_id'];
                                        $order_date = $rowOrder['date'];
                                        $order_time = $rowOrder['time'];
                                        $order_status = $rowOrder['order_status'];

                                        // echo $order_status;

                                        if ($order_status != "pending") {

                                            // echo $delivery_boy_id;

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


                                                echo '
                                        <div class="request-content">
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
                                                        <p>Date</p>
                                                    </div>
                                                    <div class="request-details-content-2">
                                                        <p>' . $order_date . '</p>
                                                    </div>
                                                </div>
                                                <div class="request-details">
                                                    <div class="request-details-content-1">
                                                        <p>Time</p>
                                                    </div>
                                                    <div class="request-details-content-2">
                                                        <p>' . $order_time . '</p>
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
                                                    <button type="button" class="btn" onclick="updateBookingStatus(' . $delivery_id . ', \'accept\')">Accept</button> 
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
                    // }
                    // <button type="button" class="btn" onclick="contactUser(' . $customer_user_id . ', ' . $delivery_id . ')">Contact</button>

                    if ($error == false) {
                        echo "<p>Devlivery request not found</p>";
                    }


                    ?>

                </div>
            </div>
        </section>
        <!-- </div> -->
    </div>

    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
    <script>
        function contactUser(userId, deliveryId) {
            // window.location.href = 'message.php?receiver_id=' + userId + '&delivery_id=' + deliveryId;
        }

        function updateBookingStatus(deliveryId, status) {
            window.location.href = 'delivery.php?delivery_id=' + deliveryId + '&status=' + status;
        }
    </script>
</body>

</html>