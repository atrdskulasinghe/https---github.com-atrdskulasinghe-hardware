<?php
include "../config/database.php";

session_start();

$booking_id = "";
$photo_url = "";
$status = "";
$booked_date = "";
$booked_time = "";
$accept_date = "";
$accept_time = "";
$start_date = "";
$start_time = "";
$finished_date = "";
$finished_time = "";
$house_no = "";
$state = "";
$city = "";
$payment_status = "";
$payment_method = "";
$cost = "";
$description = "";
$latitude = "";
$longitude = "";

$user_id = $_SESSION['id'];

$selectTechnicianQuery1 = "SELECT * FROM `booking` WHERE `customer_id`= '$user_id'";
$resultTechnician = $conn->query($selectTechnicianQuery1);

if ($resultTechnician->num_rows > 0) {
    while ($row = $resultTechnician->fetch_assoc()) {
        $booking_id = $row['booking_id'];
        $photo_url = $row['photo_url'];
        $status = $row['status'];
        $booked_date = $row['booked_date'];
        $booked_time = $row['booked_time'];
        $accept_date = $row['accept_date'];
        $accept_time = $row['accept_time'];
        $start_date = $row['start_date'];
        $start_time = $row['start_time'];
        $finished_date = $row['finished_date'];
        $finished_time = $row['finished_time'];
        $house_no = $row['house_no'];
        $state = $row['state'];
        $city = $row['city'];
        $payment_status = $row['payment_status'];
        $payment_method = $row['payment_method'];
        $cost = $row['cost'];
        $description = $row['description'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
    }
}

if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        // header('location: index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ./cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        header('location: ./technician/index.php');
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        header('location: ./delivery-doy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        header('location: ./admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ./technical-team/index.php');
    }
} else {
    header('location: ./login.php');
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
    <link rel="stylesheet" href="./assets/css/user-cart.css">
    <link rel="stylesheet" href="./assets/css/button.css">
    <link rel="stylesheet" href="./assets/css/dashboard-history-view.css">
    <link rel="stylesheet" href="./assets/css/line-2.css">
    <link rel="stylesheet" href="./assets/css/dashboard-history.css">
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
            <div class="user-cart">
                <div class="box">
                    <div class="history">
                        <div class="history-details-1">
                            <p>Date : <?php echo $booked_date ?></p>
                            <p>Delivery ID: <?php echo $booked_date ?></p>
                            <p>Status: <?php echo $booked_date ?></p>
                        </div>
                        <div class="history-details-2">
                            <div class="line-content">
                                <div class="line-all-content">
                                    <div class="line-circle line-circle-1 active">
                                        <i class="ri-check-line"></i>
                                        <h4>Booking Confirmed</h4>
                                    </div>
                                    <div class="line line-1 active"></div>
                                    <div class="line-circle line-circle-2 active">
                                        <i class="ri-check-line"></i>
                                        <h4>Accept</h4>
                                    </div>
                                    <div class="line  line-2 active"></div>
                                    <div class="line-circle line-circle-3 active">
                                        <i class="ri-check-line"></i>
                                        <h4>Started</h4>
                                    </div>
                                    <div class="line  line-3 active"></div>
                                    <div class="line-circle line-circle-4 active">
                                        <i class="ri-check-line"></i>
                                        <h4>Finished</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="history-details-3">
                            <div class="history-details-3-content-1">
                                <h4>Date</h4>
                                <p>14 Dec 2023</p>
                                <h4>Total Amount</h4>
                                <p>LKR. 2000</p>
                            </div>
                            <div class="history-details-3-content-2">
                                <div>
                                    <h4>Payment Status</h4>
                                    <p>pending</p>
                                    <h4>Delivery Fee</h4>
                                    <p>LKR. 2000</p>
                                </div>
                            </div>
                            <div class="history-details-3-content-3">
                                <div>
                                    <h4>Payment Method</h4>
                                    <p>Card</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-content">
                            <div class="right-button margin-top-30">
                                <input type="submit" value="Contact">
                                <input type="submit" value="Location">
                                <input type="submit" value="Finish">
                            </div>
                        </div>
                    </div>
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