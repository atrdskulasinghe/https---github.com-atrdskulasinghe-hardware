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

$booking_id = "";
$user_id = 6;
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

$status = $customer_id = $booked_date = $booked_time = $accept_date = $accept_time = $start_date = $start_time = $finished_date = $finished_time = $photo_url = $location_url = $house_no = $state = $city = $payment_status = $payment_method = $cost = $description = "";

$technician_id = "";
$cost_per_day = "";
$cost_per_hour = "";

$selectUserQuery = "SELECT * FROM `technician` WHERE `user_id` = $user_id";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $technician_id = $row['technician_id'];
    $cost_per_day = $row['cost_per_day'];
    $cost_per_hour = $row['cost_per_hour'];
}

if (isset($_GET['book_id'])) {
    if ($_GET['book_id'] !== "") {


        $booking_id = $_GET['book_id'];

        $selectUserQuery = "SELECT * FROM `booking` WHERE `booking_id` = $booking_id";
        $result = $conn->query($selectUserQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $technician_idDB = $row['technician_id'];
            $customer_id = $row['customer_id'];
            $status = $row['status'];
            $booked_date = $row['booked_date'];
            $booked_time = $row['booked_time'];
            $accept_date = $row['accept_date'];
            $accept_time = $row['accept_time'];
            $start_date = $row['start_date'];
            $start_time = $row['start_time'];
            $finished_date = $row['finished_date'];
            $finished_time = $row['finished_time'];
            $photo_url = $row['photo_url'];
            // $location_url = $row['location_url'];
            $house_no = $row['house_no'];
            $state = $row['state'];
            $city = $row['city'];
            $payment_status = $row['payment_status'];
            $payment_method = $row['payment_method'];
            $cost = $row['cost'];
            $description = $row['description'];
            $latitude = $row['latitude'];
            $longitude = $row['longitude'];


            if ($technician_idDB == $technician_id) {
                if ($status !== 'pending') {
                } else {
                    header('location: history.php');
                }
            } else {
                header('location: history.php');
            }
        }
    } else {
        header('location: history.php');
    }
} else {
    header('location: history.php');
}


if (isset($_POST['start'])) {
    $currentDate = date("Y-m-d");
    $currentTime = date("H:i:s");
    $updateQuery = "UPDATE `booking` SET 
        `status` = 'start',
        `start_date` = '$currentDate',
        `start_time` = '$currentTime'
        WHERE `booking_id` = $booking_id";

    if ($conn->query($updateQuery) === TRUE) {
        header('location: history-view.php?book_id=' . $booking_id . '');
    } else {
        header('location: booking.php');
    }
}

if (isset($_POST['finish'])) {
    $currentDate = date("Y-m-d");
    $currentTime = date("H:i:s");

    $start_datetime = $start_date . ' ' . $start_time;

    $start_timestamp = strtotime($start_datetime);
    $current_timestamp = strtotime($currentDate . ' ' . $currentTime);

    $duration_seconds = $current_timestamp - $start_timestamp;

    $duration_hours = floor($duration_seconds / 3600);
    $duration_minutes = ($duration_seconds % 3600) / 60;

    $hourly_rate = $cost_per_hour;
    $daily_rate = $cost_per_day;

    if ($duration_hours >= 8) {
        $cost1 = $daily_rate;
    } else {
        $cost1 = $duration_hours * $hourly_rate;
        if ($duration_minutes > 0) {
            $cost1 += $hourly_rate * ($duration_minutes / 60);
        }
    }

    $formatted_cost = floor($cost1 * 1000) / 1000;

    if($formatted_cost < $hourly_rate){
        $formatted_cost = $hourly_rate;
    }

    $updateQuery = "UPDATE `booking` SET 
        `status` = 'finish',
        `finished_date` = '$currentDate',
        `finished_time` = '$currentTime',
        `cost` = '$formatted_cost'
        WHERE `booking_id` = $booking_id";

    if ($conn->query($updateQuery) === TRUE) {

        $percent = $formatted_cost * 0.20;
        $technician_amount = $formatted_cost - $percent;

        $selectUserQuery = "SELECT * FROM `technician` WHERE `user_id` = $user_id";
        $result = $conn->query($selectUserQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $balance = $row['balance'];
            $now_balance = $balance + $technician_amount;

            $updateQuery = "UPDATE `technician` SET 
                `balance` = '$now_balance'
                WHERE `user_id` = $user_id";

            if ($conn->query($updateQuery) === TRUE) {
                header('location: history-view.php?book_id=' . $booking_id . '');
            }
        }
    } else {
        header('location: booking.php');
    }

    // percentage


}

if (isset($_POST['paid'])) {

    if ($payment_method == "cash") {
        $updateQuery = "UPDATE `booking` SET 
                `payment_status` = 'paid'
                WHERE `booking_id` = '$booking_id'";
    
        if ($conn->query($updateQuery) === TRUE) {
            header('location: history-view.php?book_id=' . $booking_id . '');
        }
    } else {
        header('location: history.php');
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
    <link rel="stylesheet" href="../assets/css/line-2.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<style>
    .history-details-image {
        max-width: 600px !important;
        height: 300px !important;
        margin: auto;
        margin-bottom: 20px;
    }

    .history-details-image img {
        width: 100%;
        height: 100%;
        border-radius: 5px;
        object-fit: cover;
    }
</style>

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
                        <!-- <div class="menu-link-button">
                            <a href="./message.php">
                                <p><img src="../assets/images/ui/messages.png" alt="">Messages</p>
                            </a>
                        </div> -->

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
                        <p>Booked Date : <?php echo $booked_date ?></p>
                        <p>Booking ID: <?php echo $booking_id ?></p>
                        <p>Status: <?php echo ucfirst($status) ?></p>
                    </div>
                    <div class="history-details-2">
                        <div class="line-content">
                            <div class="line-all-content">
                                <div class="line-circle line-circle-1 active">
                                    <i class="ri-check-line"></i>
                                    <h4>Booking Confirmed</h4>
                                </div>
                                <div class="line line-1 <?php if ($status == "accept" || $status == "start" ||  $status == "finish") {
                                                            echo "active";
                                                        } ?>"></div>
                                <div class="line-circle line-circle-2  <?php if ($status == "accept" || $status == "start" ||  $status == "finish") {
                                                                            echo "active";
                                                                        } ?>">
                                    <i class="ri-check-line"></i>
                                    <h4>Accepted</h4>
                                </div>
                                <div class="line  line-2 <?php if ($status == "start" || $status == "finish") {
                                                                echo "active";
                                                            } ?>"></div>
                                <div class="line-circle line-circle-3  <?php if ($status == "start" || $status == "finish") {
                                                                            echo "active";
                                                                        } ?>">
                                    <i class="ri-check-line"></i>
                                    <h4>Started</h4>
                                </div>
                                <div class="line  line-3 <?php if ($status == "finish") {
                                                                echo "active";
                                                            } ?>"></div>
                                <div class="line-circle line-circle-4  <?php if ($status == "finish") {
                                                                            echo "active";
                                                                        } ?>">
                                    <i class="ri-check-line "></i>
                                    <h4>Finished</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="history-details-image">
                        <img src="../assets/images/booking/<?php echo $photo_url ?>" alt="">
                    </div>
                    <div class="history-details-3">
                        <div class="history-details-3-content-1">
                            <h4>Booked Date & Time</h4>
                            <p><?php echo $accept_date . " " . $accept_time; ?></p>
                            <h4>Accept Date & Time</h4>
                            <p><?php echo $accept_date . " " . $accept_time; ?></p>
                        </div>
                        <div class="history-details-3-content-2">
                            <div>
                                <h4>Cost</h4>
                                <p>LKR.<?php echo $cost; ?></p>
                                <h4>Payment Status</h4>
                                <p><?php echo $payment_status; ?></p>
                            </div>
                        </div>
                        <div class="history-details-3-content-3">
                            <div>
                                <h4>Payment Method</h4>
                                <p><?php echo $payment_method ?></p>

                                <p><?php if ($status == "start") {
                                        echo '<h4>Started Date & Time</h4>';
                                        echo "<p>" . $start_date . " " . $start_time . "</p>";
                                    } else if ($status == "finish") {
                                        echo '<h4>Finished Date & Time</h4>';
                                        echo "<p>" . $finished_date . " " . $finished_time . "</p>";
                                    } ?></p>
                            </div>
                        </div>
                    </div>
                    <form class="input-content" method="post">
                        <div class="right-button margin-top-30">
                            <!-- <input type="button" class="btn" onclick="contactUser(' . $user_id . ', ' . $booking_id . ')" value="Contact"> -->
                            <input type="button" class="btn" value="Location" onclick="redirectToMap(<?php echo $latitude; ?>, <?php echo $longitude; ?>)">
                            <?php

                            if ($status == "accept") {
                                echo '<input type="submit" value="Start" name="start" class="btn" >';
                            } else if ($status == "start") {
                                echo '<input type="submit" value="Finish" name="finish" class="btn" >';
                            } else if ($status == "finish") {
                                if ($payment_method == "cash") {
                                    if ($payment_status == "pending") {
                                        echo '<input type="submit" value="Paid" name="paid" class="btn" >';
                                    }
                                }
                            }

                            ?>

                        </div>
                    </form>
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
    </script>

    <script>
        function redirectToMap(latitude, longitude) {

            var url = "https://www.google.com/maps?q=" + latitude + "," + longitude;
            window.open(url, "_blank");
        }
    </script>
</body>

</html>