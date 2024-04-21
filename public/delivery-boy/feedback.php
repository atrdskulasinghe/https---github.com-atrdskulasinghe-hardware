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
        $user_id = $_SESSION['id'];
        // header('location: ../delivery-doy/index.php');
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
                        <div class="menu-link-button active">
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

                $feedback1 = "SELECT * FROM `delivery` WHERE `delivery_boy_id` = $user_id";
                $resultFeedback1 = $conn->query($feedback1);

                if ($resultFeedback1->num_rows > 0) {
                    while ($rowFeedback1 = $resultFeedback1->fetch_assoc()) {

                        $delivery_id = $rowFeedback1['delivery_id'];

                        $feedbackD1 = "SELECT * FROM `delivery_boy_feedback` WHERE `delivery_id` = $delivery_id";
                        $resultFeedback11 = $conn->query($feedbackD1);

                        if ($resultFeedback11->num_rows > 0) {

                            $rowFeedback11 = $resultFeedback11->fetch_assoc();

                            $descriptionF = $rowFeedback11['description'];
                            $dateF = $rowFeedback11['date'];

                            if ($rowFeedback11['number_of_stars'] == 1) {
                                $starsC1 += 1;
                            }

                            if ($rowFeedback11['number_of_stars'] == 2) {
                                $starsC2 += 1;
                            }

                            if ($rowFeedback11['number_of_stars'] == 3) {
                                $starsC3 += 1;
                            }

                            if ($rowFeedback11['number_of_stars'] == 4) {
                                $starsC4 += 1;
                            }

                            if ($rowFeedback11['number_of_stars'] == 5) {
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

                            $feedback1 = "SELECT * FROM `delivery` WHERE `delivery_boy_id` = $user_id";
                            $resultFeedback11 = $conn->query($feedback1);

                            if ($resultFeedback11->num_rows > 0) {
                                while ($rowFeedback11 = $resultFeedback11->fetch_assoc()) {

                                    $delivery_id = $rowFeedback11['delivery_id'];

                                    $feedbackD11 = "SELECT * FROM `delivery_boy_feedback` WHERE `delivery_id` = $delivery_id";
                                    $resultFeedback111 = $conn->query($feedbackD11);

                                    if ($resultFeedback111->num_rows > 0) {
                                        $rowFeedbackD = $resultFeedback111->fetch_assoc();

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
        </section>
        <!-- </div> -->
    </div>

    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>