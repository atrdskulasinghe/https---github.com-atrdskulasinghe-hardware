<?php

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: ../index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ../cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        // header('location: ./technician/index.php');
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        header('location: ../delivery-boy/index.php');
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

$user_id = 6;
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}

$technician_id = "";

$selectUserQuery = "SELECT * FROM `technician` WHERE `user_id` = $user_id";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $technician_id = $row['technician_id'];
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
                        <div class="menu-link-button active">
                            <a href="./booking.php">
                                <p><img src="../assets/images/ui/booking.png" alt="">Booking</p>
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
                        <div class="menu-link-button">
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

                    $selectUserQuery = "SELECT * FROM `booking` WHERE `technician_id` = '$technician_id'";
                    $result = $conn->query($selectUserQuery);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            
                            $booking_id = $row['booking_id'];
                            $technician_idDB = $row['technician_id'];
                            $customer_id = $row['customer_id'];
                            $status = $row['status'];
                            $booked_date = $row['booked_date'];
                            $booked_time = $row['booked_time'];
                            $accept_date = $row['accept_date'];
                            $accept_time = $row['accept_time'];
                            $start_date = $row['start_date'];
                            $start_time = $row['start_time'];
                            $photo_url = $row['photo_url'];
                            $location_url = $row['location_url'];
                            $house_no = $row['house_no'];
                            $state = $row['state'];
                            $city = $row['city'];
                            $payment_status = $row['payment_status'];
                            $payment_method = $row['payment_method'];
                            $cost = $row['cost'];
                            $description = $row['description'];

                            $selectUserQueryCustomer = "SELECT * FROM `customer` WHERE `customer_id` = $customer_id";
                            $resultCustomer = $conn->query($selectUserQueryCustomer);

                            if ($resultCustomer->num_rows > 0) {
                                $rowCustomer = $resultCustomer->fetch_assoc();

                                $customerUserId = $rowCustomer['user_id'];

                                $selectUserQueryUser = "SELECT * FROM `user` WHERE `user_id` = $customerUserId";
                                $resultUser = $conn->query($selectUserQueryUser);

                                if ($resultUser->num_rows > 0) {
                                    $rowUser = $resultUser->fetch_assoc();

                                    $customer_name = $rowUser['first_name'] . " " . $rowUser['last_name'];
                                    $phone_number = $rowUser['phone_number'];
                                    $email = $rowUser['email'];
                                    $profile_url = $rowUser['profile_url'];

                                    if ($technician_idDB == $technician_id) {
                                        if ($status == "pending") {
                                            $error = true;
                                            echo '
                            <div class="request-content">
                                <div class="request-content-1">
                                    <iframe src="' . $location_url . '" frameborder="0"></iframe>
                                    <p>' . $description . '</p>
                                </div>
                                <div class="request-content-2">
                                    <div class="request-profile">
                                        <div class="request-profile-content-1">
                                            <img src="../assets/images/customer/' . $profile_url . '" alt="">
                                        </div>
                                        <div class="request-profile-content-2">
                                            <h4>' . $customer_name . '</h4>
                                        </div>
                                    </div>
                                    <div class="request-details">
                                        <div class="request-details-content-1">
                                            <p>Date</p>
                                        </div>
                                        <div class="request-details-content-2">
                                            <p>' . $booked_date . '</p>
                                        </div>
                                    </div>
                                    <div class="request-details">
                                        <div class="request-details-content-1">
                                            <p>Time</p>
                                        </div>
                                        <div class="request-details-content-2">
                                            <p>' . $booked_time . '</p>
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
                                        <button type="button" class="btn" onclick="contactUser(' . $user_id . ', ' . $booking_id . ')">Contact</button>
                                        <button type="button" class="btn" onclick="updateBookingStatus(' . $booking_id . ', \'accept\')">Accept</button>
                                        <button type="button" class="btn" onclick="updateBookingStatus(' . $booking_id . ', \'cancel\')">Cancel</button>
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

                    if ($error == false) {
                        echo "Booking not found";
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
        function contactUser(userId, bookingId) {
            window.location.href = 'message.php?receiver_id=' + userId + '&book_id=' + bookingId;
        }

        function updateBookingStatus(bookingId, status) {
            window.location.href = 'book.php?book_id=' + bookingId + '&status=' + status;
        }
    </script>
</body>

</html>