<?php

include "../../config/database.php";


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

$technician_id = "";
$user_id = 6;
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}
include "../../template/user-data.php";


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
                        <div class="menu-link-button">
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
                    <div class="history-table">
                        <table>
                            <tr>
                                <td></td>
                                <td>Book Id</td>
                                <td>Date</td>
                                <td>Status</td>
                                <td>Cost</td>
                                <td>Action</td>
                            </tr>

                            <?php

                            $error = false;

                            $selectUserQuery = "SELECT * FROM `booking` WHERE `technician_id` = $technician_id";
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
                                    // $location_url = $row['location_url'];
                                    $house_no = $row['house_no'];
                                    $state = $row['state'];
                                    $city = $row['city'];
                                    $payment_status = $row['payment_status'];
                                    $payment_method = $row['payment_method'];
                                    $cost = $row['cost'];
                                    $description = $row['description'];

                                    $selectUserQuery = "SELECT * FROM `user` WHERE `user_id` = $customer_id";
                                    $resultUser = $conn->query($selectUserQuery);

                                    if ($resultUser->num_rows > 0) {

                                        $rowUser = $resultUser->fetch_assoc();

                                        $customer_name = $rowUser['first_name'] . " " . $rowUser['last_name'];
                                        $phone_number = $rowUser['phone_number'];
                                        $email = $rowUser['email'];

                                        if ($technician_idDB == $technician_id) {

                                            if ($status == "accept" || $status == "start" || $status == "finish") {
                                                $error = true;

                                                echo '
                                                <tr>
                                                    <td>
                                                        <img src="../assets/images/booking/' . $photo_url . '" alt="">
                                                    </td>
                                                    <td>' . $booking_id . '</td>
                                                    <td>' . $booked_date . ' /  ' . DateTime::createFromFormat('H:i:s', $booked_time)->format('h:ia') . '</td>

                                                    <td>' . ucfirst($status) . 'ed</td>
                                                    <td>LKR.' . $cost . '</td>
                                                    <td>
                                                    <button class="btn" onclick="window.location.href=\'history-view.php?book_id=' . $booking_id . ' \'">View</button>
                                                    </td>
                                                </tr>
                                            ';
                                            } else if ($status == "cancel") {
                                                echo '
                                            <tr>
                                                <td>
                                                    <img src="../assets/images/booking/' . $photo_url . '" alt="">
                                                </td>
                                                <td>' . $booking_id . '</td>
                                                <td>' . $booked_date . ' /  ' . DateTime::createFromFormat('H:i:s', $booked_time)->format('h:ia') . '</td>

                                                <td>' . ucfirst($status) . 'ed</td>
                                                <td>LKR.'.$cost.'</td>
                                                <td>
                                                </td>
                                            </tr>
                                        ';
                                            }
                                        }
                                    }
                                }
                            }

                            // if ($error == false) {
                            //     echo '<div class="margin-bottom-20">Booking not found</div>';
                            // }

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