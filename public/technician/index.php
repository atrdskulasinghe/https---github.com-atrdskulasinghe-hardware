<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: ../index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ../cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        // header('location: ./technician/index.php');
        $user_id = $_SESSION['id'];
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

$technician_id;

$technician = "SELECT * FROM `technician` WHERE `user_id` = $user_id";
$resultTechnician = $conn->query($technician);

if ($resultTechnician->num_rows > 0) {
    $rowTechnician = $resultTechnician->fetch_assoc();

    $technician_id = $rowTechnician['technician_id'];
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
    <link rel="stylesheet" href="../assets/css/dashboard-wallet.css">
    <link rel="stylesheet" href="../assets/css/review.css">
    <link rel="stylesheet" href="../assets/css/dashboard-home.css">
    <link rel="stylesheet" href="../assets/css/dashboard-profile.css">
    <link rel="stylesheet" href="../assets/css/dashboard-review.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/card.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/review.css">
    <link rel="stylesheet" href="../assets/css/stars.css">
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
                        <div class="menu-link-button active">
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

        <?php

        $startDate = date('Y-m-d', strtotime('-7 days'));
        $endDate = date('Y-m-d');

        $startDateMonth = date('Y-m-d', strtotime('-30 days'));
        $endDateMonth = date('Y-m-d');

        $todayIcome = 0;
        $thisWeekIcome = 0;
        $monthIcome = 0;
        $totalIncome = 0;

        $booking = "SELECT * FROM `booking` WHERE `technician_id` = $technician_id";
        $resultBooking = $conn->query($booking);

        if ($resultBooking->num_rows > 0) {
            while ($rowBooking = $resultBooking->fetch_assoc()) {


                $technician_id = $rowBooking['technician_id'];
                $customer_id = $rowBooking['customer_id'];
                $status = $rowBooking['status'];
                $booked_date = $rowBooking['booked_date'];
                $booked_time = $rowBooking['booked_time'];
                $accept_date = $rowBooking['accept_date'];
                $accept_time = $rowBooking['accept_time'];
                $start_date = $rowBooking['start_date'];
                $start_time = $rowBooking['start_time'];
                $finished_date = $rowBooking['finished_date'];
                $finished_time = $rowBooking['finished_time'];
                $photo_url = $rowBooking['photo_url'];
                $payment_status = $rowBooking['payment_status'];
                $payment_method = $rowBooking['payment_method'];
                $cost = $rowBooking['cost'];
                $description = $rowBooking['description'];

                $currentDate = date("Y-m-d");

                if ($currentDate == $finished_date) {
                    $todayIcome += $cost;
                }

                if ($finished_date >= $startDate && $finished_date <= $endDate) {
                    $thisWeekIcome += $cost;
                }

                if ($finished_date >= $startDateMonth && $finished_date <= $endDateMonth) {
                    $monthIcome += $cost;
                }

                $totalIncome += $cost;
            }
        }

        ?>
        <section class="active section">
            <div class="wallet">
                <div class="content">
                    <div class="wallet-header">
                        <div class="wallet-header-card">
                            <div class="wallet-card-header">
                                <h4>Earned today</h4>
                            </div>
                            <div class="wallet-card-content">
                                <div>
                                    <div class="wallet-card-content-1">
                                        <h3>LRK.<?php echo $todayIcome; ?></h3>
                                    </div>
                                    <!-- <div class="wallet-card-content-2">
                                        <p>48% From Last 24 Hours</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="wallet-header-card">
                            <div class="wallet-card-header">
                                <h4>Earned this week</h4>
                            </div>
                            <div class="wallet-card-content">
                                <div>
                                    <div class="wallet-card-content-1">
                                        <h3>LRK.<?php echo $thisWeekIcome; ?></h3>
                                    </div>
                                    <!-- <div class="wallet-card-content-2">
                                        <p>48% From Last 24 Hours</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="wallet-header-card">
                            <div class="wallet-card-header">
                                <h4>Earned this month</h4>
                            </div>
                            <div class="wallet-card-content">
                                <div>
                                    <div class="wallet-card-content-1">
                                        <h3>LRK.<?php echo $monthIcome; ?></h3>
                                    </div>
                                    <!-- <div class="wallet-card-content-2">
                                        <p>33% From Last 30 Day</p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="wallet-review"> -->
                    <div class="wallet-history">
                        <div class="wallet-history-header-text">
                            <h2>Earning Report</h2>
                        </div>
                        <div class="wallet-history-header">
                            <div class="wallet-history-header-content-1">
                                <h4><?php echo date('W F Y'); ?></h4>
                                <p>Total Earning</p>
                            </div>
                            <div class="wallet-history-header-content-2">
                                <h2>LKR. <?php echo $totalIncome; ?></h2>
                            </div>
                        </div>
                        <div class="wallet-table">
                            <table>
                                <tr>
                                    <td>Booking id</td>
                                    <td>Date</td>
                                    <td>Time</td>
                                    <td>Earnings</td>
                                    <!-- <td>Status</td> -->
                                </tr>
                                <?php


                                $booking1 = "SELECT * FROM `booking` WHERE `technician_id` = $technician_id";
                                $resultBooking1 = $conn->query($booking1);

                                if ($resultBooking1->num_rows > 0) {
                                    
                                    while ($rowBooking = $resultBooking1->fetch_assoc()) {
                                        
                                        $booking_id = $rowBooking['booking_id'];
                                        $technician_id = $rowBooking['technician_id'];
                                        $customer_id = $rowBooking['customer_id'];
                                        $status = $rowBooking['status'];
                                        $booked_date = $rowBooking['booked_date'];
                                        $booked_time = $rowBooking['booked_time'];
                                        $accept_date = $rowBooking['accept_date'];
                                        $accept_time = $rowBooking['accept_time'];
                                        $start_date = $rowBooking['start_date'];
                                        $start_time = $rowBooking['start_time'];
                                        $finished_date = $rowBooking['finished_date'];
                                        $finished_time = $rowBooking['finished_time'];
                                        $photo_url = $rowBooking['photo_url'];
                                        $payment_status = $rowBooking['payment_status'];
                                        $payment_method = $rowBooking['payment_method'];
                                        $cost = $rowBooking['cost'];
                                        $description = $rowBooking['description'];


                                        if ($status == 'finish') {

                                            echo '
                                                <tr>
                                                    <td>' . $booking_id . '</td>
                                                    <td>' . $finished_date . '</td>
                                                    <td>' . $finished_time . '</td>
                                                    <td>' . $cost . '</td>
                                                </tr>
                                        ';
                                        }
                                    }
                                }


                                ?>
                            </table>
                        </div>
                    </div>
                    <?php

                    $starsC1 = 0;
                    $starsC2 = 0;
                    $starsC3 = 0;
                    $starsC4 = 0;
                    $starsC5 = 0;
                    $allStarCount = 0;

                    $percentageStar1 = "";
                    $percentageStar2 = "";
                    $percentageStar3 = "";
                    $percentageStar4 = "";
                    $percentageStar5 = "";
                    $averageRating = 0;

                    $feedbackT1 = "SELECT * FROM `booking` WHERE `technician_id` = $technician_id";
                    $resultFeedbackT1 = $conn->query($feedbackT1);

                    if ($resultFeedbackT1->num_rows > 0) {
                        while ($rowFeedbackT1 = $resultFeedbackT1->fetch_assoc()) {

                            $booking_id = $rowFeedbackT1['booking_id'];

                            $feedbackB1 = "SELECT * FROM `technician_feedback` WHERE `booking_id` = $booking_id";
                            $resultFeedback1 = $conn->query($feedbackB1);

                            if ($resultFeedback1->num_rows > 0) {

                                $rowFeedback1 = $resultFeedback1->fetch_assoc();

                                $descriptionF = $rowFeedback1['description'];
                                $dateF = $rowFeedback1['date'];

                                if ($rowFeedback1['number_of_stars'] == 1) {
                                    $starsC1 += 1;
                                }

                                if ($rowFeedback1['number_of_stars'] == 2) {
                                    $starsC2 += 1;
                                }

                                if ($rowFeedback1['number_of_stars'] == 3) {
                                    $starsC3 += 1;
                                }

                                if ($rowFeedback1['number_of_stars'] == 4) {
                                    $starsC4 += 1;
                                }

                                if ($rowFeedback1['number_of_stars'] == 5) {
                                    $starsC5 += 1;
                                }

                                $allStarCount += 1;
                            }
                        }

                        if ($allStarCount > 0) {
                            $percentageStar1 = ($starsC1 / $allStarCount) * 100;
                            $percentageStar2 = ($starsC2 / $allStarCount) * 100;
                            $percentageStar3 = ($starsC3 / $allStarCount) * 100;
                            $percentageStar4 = ($starsC4 / $allStarCount) * 100;
                            $percentageStar5 = ($starsC5 / $allStarCount) * 100;

                            $totalStars = ($starsC1 * 1) + ($starsC2 * 2) + ($starsC3 * 3) + ($starsC4 * 4) + ($starsC5 * 5);
                            $averageRating = $totalStars / $allStarCount;
                            $averageRating100 = ($averageRating * 20);
                        }
                    }
                    ?>

                    <div class="review">
                        <div class="review-content">
                            <h3>Ratings & Reviews</h3>
                            <div class="review-header">
                                <div class="review-header-content-1">
                                    <h1><?php echo $averageRating; ?>.0/<span>5</span></h1>

                                    <div class="stars large">
                                        <ul>
                                            <?php

                                            if ($averageRating100 <= 20 && $averageRating100 > 0) {
                                                echo '
    
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        
                                                        ';
                                            } else if ($averageRating100 <= 40 && $averageRating100 > 20) {
                                                echo '
    
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        
                                                        ';
                                            } else if ($averageRating100 <= 60 && $averageRating100 > 40) {
                                                echo '
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        
                                                        ';
                                            } else if ($averageRating100 <= 80 && $averageRating100 > 60) {
                                                echo '
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    
                                                    ';
                                            } else if ($averageRating100 <= 100 && $averageRating100 > 80) {
                                                echo '
                                                            <li class="active">
                                                                <i class="ri-star-fill"></i>
                                                            </li>
                                                            <li class="active">
                                                                <i class="ri-star-fill"></i>
                                                            </li>
                                                            <li class="active">
                                                                <i class="ri-star-fill"></i>
                                                            </li>
                                                            <li class="active">
                                                                <i class="ri-star-fill"></i>
                                                            </li>
                                                            <li class="active">
                                                                <i class="ri-star-fill"></i>
                                                            </li>
                                                            
                                                            ';
                                            } else {
                                                echo '
    
                                                        <li class="active">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        <li class="">
                                                            <i class="ri-star-fill"></i>
                                                        </li>
                                                        
                                                        ';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="reivew-header-content-1-rating">
                                        <p><?php echo $allStarCount; ?> Ratings</p>
                                    </div>
                                </div>
                                <div class="review-header-content-2">
                                    <div class="review-header-review-line">
                                        <div class="review-header-review-line-content">
                                            <div class="stars small margin-top-0">
                                                <ul>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="review-line-background">
                                                <div class="review-line" style="width:<?php echo $percentageStar5; ?>%;"></div>
                                            </div>
                                            <div class="review-count">
                                                <p><?php echo $starsC1; ?></p>
                                            </div>
                                        </div>
                                        <div class="review-header-review-line-content">
                                            <div class="stars small margin-top-0">
                                                <ul>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill visibility-hidden"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="review-line-background">
                                                <div class="review-line" style="width:<?php echo $percentageStar4; ?>%;"></div>
                                            </div>
                                            <div class="review-count">
                                                <p><?php echo $starsC2; ?></p>
                                            </div>
                                        </div>
                                        <div class="review-header-review-line-content">
                                            <div class="stars small margin-top-0">
                                                <ul>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active "></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active visibility-hidden"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill visibility-hidden"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="review-line-background">
                                                <div class="review-line" style="width:<?php echo $percentageStar3; ?>%;"></div>
                                            </div>
                                            <div class="review-count">
                                                <p><?php echo $starsC3; ?></p>
                                            </div>
                                        </div>
                                        <div class="review-header-review-line-content">
                                            <div class="stars small margin-top-0">
                                                <ul>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active visibility-hidden"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active visibility-hidden"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill visibility-hidden"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="review-line-background">
                                                <div class="review-line" style="width:<?php echo $percentageStar2; ?>%;"></div>
                                            </div>
                                            <div class="review-count">
                                                <p><?php echo $starsC4; ?></p>
                                            </div>
                                        </div>
                                        <div class="review-header-review-line-content">
                                            <div class="stars small margin-top-0">
                                                <ul>
                                                    <li>
                                                        <i class="ri-star-fill active"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active visibility-hidden"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active visibility-hidden"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill active visibility-hidden"></i>
                                                    </li>
                                                    <li>
                                                        <i class="ri-star-fill visibility-hidden"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="review-line-background">
                                                <div class="review-line" style="width:<?php echo $percentageStar1; ?>%;"></div>
                                            </div>
                                            <div class="review-count">
                                                <p><?php echo $starsC5; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-feedback">

                                <?php

                                $feedback = "SELECT * FROM `booking` WHERE `technician_id` = $technician_id";
                                $resultFeedback = $conn->query($feedback);

                                if ($resultFeedback->num_rows > 0) {
                                    while ($rowFeedback = $resultFeedback->fetch_assoc()) {

                                        $booking_id = $rowFeedback['booking_id'];

                                        $feedbackD = "SELECT * FROM `technician_feedback` WHERE `booking_id` = $booking_id";
                                        $resultFeedbackD = $conn->query($feedbackD);

                                        if ($resultFeedbackD->num_rows > 0) {
                                            $rowFeedbackD = $resultFeedbackD->fetch_assoc();

                                            $customer_id = $rowFeedbackD['customer_id'];
                                            $description = $rowFeedbackD['description'];
                                            $number_of_stars = $rowFeedbackD['number_of_stars'];
                                            $date = $rowFeedbackD['date'];

                                            $feedbackC = "SELECT * FROM `customer` WHERE `customer_id` = $customer_id";
                                            $resultFeedbackC = $conn->query($feedbackC);

                                            if ($resultFeedbackC->num_rows > 0) {
                                                $rowFeedbackC = $resultFeedbackC->fetch_assoc();

                                                $userCId = $rowFeedbackC['user_id'];

                                                $feedbackU = "SELECT * FROM `user` WHERE `user_id` = $userCId";
                                                $resultFeedbackU = $conn->query($feedbackU);

                                                if ($resultFeedbackU->num_rows > 0) {
                                                    $rowFeedbackU = $resultFeedbackU->fetch_assoc();

                                                    $userName = $rowFeedbackU['first_name'] . ' ' . $rowFeedbackU['last_name'];

                                                    echo '
                                                    <div class="feedback-content">
                                                <div class="feedback-content-1">
                                                    <div class="stars">
                                                        <ul>
                                                        ';
                                                    // for ($i = 0; $i < 5; $i++) {
                                                    if ($number_of_stars == 1) {
                                                        echo '<li>
                                                                                <i class="ri-star-fill active"></i>
                                                                            </li>';
                                                        echo '<li">
                                                                            <i class="ri-star-fill"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill"></i>
                                                                        </li>
                                                                        ';
                                                    } else if ($number_of_stars == 2) {
                                                        echo '<li>
                                                                                <i class="ri-star-fill active"></i>
                                                                            </li>';
                                                        echo '<li">
                                                                            <i class="ri-star-fill active"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill"></i>
                                                                        </li>
                                                                        ';
                                                    } else if ($number_of_stars == 3) {
                                                        echo '<li>
                                                                                <i class="ri-star-fill active"></i>
                                                                            </li>';
                                                        echo '<li">
                                                                            <i class="ri-star-fill active"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill active"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill"></i>
                                                                        </li>
                                                                        ';
                                                    } else if ($number_of_stars == 4) {
                                                        echo '<li>
                                                                                <i class="ri-star-fill active"></i>
                                                                            </li>';
                                                        echo '<li">
                                                                            <i class="ri-star-fill active"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill active"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill active"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill"></i>
                                                                        </li>
                                                                        ';
                                                    } else if ($number_of_stars == 5) {
                                                        echo '<li>
                                                                                <i class="ri-star-fill active"></i>
                                                                            </li>';
                                                        echo '<li">
                                                                            <i class="ri-star-fill active"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill active"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill active"></i>
                                                                        </li>
                                                                        ';
                                                        echo '<li">
                                                                            <i class="ri-star-fill active"></i>
                                                                        </li>
                                                                        ';
                                                    }
                                                    // }





                                                    echo '
                                                        </ul>
                                                    </div>
                                                    <p class="feedback-name">by ' . $userName . '</p>
                                                    <span style="margin-top:10px; display:block; font-family:sans-serif; font-size:12px;">' . $description . '</span>
                                                    
                                                </div>
                                                <div class="feedback-content-2">
                                                    <p>' . $date . '</p>
                                                </div>
                                            </div>
                                                ';

                                                    // <div class="feedback-images">
                                                    //     <img src="" alt="">
                                                    //     <img src="" alt="">
                                                    //     <img src="" alt="">
                                                    //     <img src="" alt="">
                                                    // </div>
                                                }
                                            }
                                        }
                                    }
                                }

                                ?>



                            </div>
                        </div>
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