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
} else {
    header('location: ./login.php');
}

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
$payment_status1 = "";
$payment_method1 = "";
$cost = "";
$description = "";
$latitude = "";
$longitude = "";

$user_id = $_SESSION['id'];

if (isset($_GET['booking_id'])) {
    if (!empty($_GET['booking_id'])) {
        $booking_id = $_GET['booking_id'];
    } else {
        header('location: ./book-history.php');
    }
} else {
    header('location: ./book-history.php');
}

$selectTechnicianQuery1 = "SELECT * FROM `booking` WHERE `booking_id`= '$booking_id'";
$resultTechnician = $conn->query($selectTechnicianQuery1);

if ($resultTechnician->num_rows > 0) {
    while ($row = $resultTechnician->fetch_assoc()) {
        $booking_id = $row['booking_id'];
        $technician_id = $row['technician_id'];
        $photo_url = $row['photo_url'];
        $status1 = $row['status'];
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
        $payment_status1 = $row['payment_status'];
        $payment_method1 = $row['payment_method'];
        $cost = $row['cost'];
        $description = $row['description'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];

    }
} else {
    header('location: ./book-history.php');
}

if (isset($_POST['technician-feedback'])) {
    header("location: ./feedback.php?booking_id={$booking_id}");
}

if(isset($_POST['pay'])){
    $_SESSION['booking_id'] = $booking_id;
    header("location: ./payment.php?booking_id={$booking_id}");
}

?>

<!-- <?php echo $status1 . 'Hello'; ?> -->
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
    <!-- <link rel="stylesheet" href="./assets/css/dashboard-history.css"> -->

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
                            <p>Booked Date : <?php echo $booked_date ?></p>
                            <p>Booking ID: <?php echo $booking_id ?></p>
                            <p>Status: <?php echo ucfirst($status1) ?></p>
                        </div>

                        <div class="history-details-2">
                            <div class="line-content">
                                <div class="line-all-content">
                                    <div class="line-circle line-circle-1 active">
                                        <i class="ri-check-line"></i>
                                        <h4>Booking Confirmed</h4>
                                    </div>
                                    <div class="line line-1 <?php if ($status1 == "accept" || $status1 == "start" ||  $status1 == "finish") {
                                                                echo "active";
                                                            } ?>"></div>
                                    <div class="line-circle line-circle-2  <?php if ($status1 == "accept" || $status1 == "start" ||  $status1 == "finish") {
                                                                                echo "active";
                                                                            } ?>">
                                        <i class="ri-check-line"></i>
                                        <h4>Accepted</h4>
                                    </div>
                                    <div class="line  line-2 <?php if ($status1 == "start" || $status1 == "finish") {
                                                                    echo "active";
                                                                } ?>"></div>
                                    <div class="line-circle line-circle-3  <?php if ($status1 == "start" || $status1 == "finish") {
                                                                                echo "active";
                                                                            } ?>">
                                        <i class="ri-check-line"></i>
                                        <h4>Started</h4>
                                    </div>
                                    <div class="line  line-3 <?php if ($status1 == "finish") {
                                                                    echo "active";
                                                                } ?>"></div>
                                    <div class="line-circle line-circle-4  <?php if ($status1 == "finish") {
                                                                                echo "active";
                                                                            } ?>">
                                        <i class="ri-check-line "></i>
                                        <h4>Finished</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="history-details-image">
                            <img src="./assets/images/booking/<?php echo $photo_url ?>" alt="">
                        </div>
                        <div class="history-details-3">
                            <div class="history-details-3-content-1">
                                <h4>Booked Date & Time</h4>
                                <p><?php echo $booked_date . " / " . $booked_time; ?></p>
                                <h4>Accept Date & Time</h4>
                                <p><?php if ($accept_date != "") {
                                        echo $accept_date . " " . $accept_time;
                                    } else {
                                        echo "-";
                                    } ?></p>
                            </div>
                            <div class="history-details-3-content-2">
                                <div>
                                    <h4>Cost</h4>
                                    <p>LKR.<?php if ($cost != "") {
                                                echo $cost;
                                            } else {
                                                echo "-";
                                            } ?></p>
                                    <h4>Payment Status</h4>
                                    <p><?php echo $payment_status1; ?></p>
                                </div>
                            </div>
                            <div class="history-details-3-content-3">
                                <div>
                                    <h4>Payment Method</h4>
                                    <p><?php echo $payment_method1 ?></p>

                                    <p><?php if ($status1 == "start") {
                                            echo '<h4>Started Date & Time</h4>';
                                            echo "<p>" . $start_date . " " . $start_time . "</p>";
                                        } else if ($status1 == "finish") {
                                            echo '<h4>Finished Date & Time</h4>';
                                            echo "<p>" . $finished_date . " " . $finished_time . "</p>";
                                        } ?></p>
                                </div>
                            </div>
                        </div>

                        <form class="input-content" method="post">
                            <div class="right-button margin-top-30">
                                <?php

                                if ($status1 == "pending") {
                                    // echo '<input type="submit" value="Cancel" name="cancel" class="btn" >';
                                } else if ($status1 == "start") {
                                    // echo '<button type="button" class="btn" onclick="contactUser(' . $technician_id . ', ' . $booking_id . ')">Contact</button>';
                                } else if ($status1 == "finish") {

                                    $technician_feedback = "SELECT * FROM `technician_feedback` WHERE `booking_id` = $booking_id";
                                    $resultFeedback = $conn->query($technician_feedback);

                                    if ($resultFeedback->num_rows > 0) {
                                        $rowFeedback = $resultFeedback->fetch_assoc();
                                    } else {
                                        echo '<input type="submit" value="Technician Feedback" name="technician-feedback" class="btn" >';
                                    }

                                    // echo $payment_method1;

                                    if ($payment_method1 == "card" && $payment_status1 == "pending") {
                                        echo '<input type="submit" value="Pay Now" name="pay" class="btn" >';
                                    }
                                }
                                ?>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>
    <script>
        function contactUser(technician_id, booking_id) {
            // window.location.href = 'message.php?receiver_id=' + technician_id + '&delivery_id=' + booking_id;
        }

        function payment(booking_id) {
            // console.log('payment.php?booking_id=' + booking_id)
            window.location.href = 'payment.php?booking_id=' + booking_id;
        }
    </script>
</body>

</html>