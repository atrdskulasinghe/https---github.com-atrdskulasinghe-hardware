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
}

$technician_id = "";
$technician_id = $user_id = $category = $nic_number = $nic_photo_url = $work_experience = $cost_per_day = $cost_per_hour = $status = $balance = '';
$first_name = $last_name = $email = $phone_number = $dob = $house_no = $state = $city = $account_type = $profile_url = '';
$name = "";
$description = "";
$image_url = "";
$imageUrlCategory = "";

if (isset($_GET['technician_id'])) {
    if (!empty($_GET['technician_id'])) {
        $technician_id = $_GET['technician_id'];
    } else {
        header('location: technicians.php');
    }
} else {
    header('location: technicians.php');
}

$selectTechnicianQuery1 = "SELECT * FROM `technician` WHERE `technician_id`= '$technician_id'";
$resultTechnician = $conn->query($selectTechnicianQuery1);

if ($resultTechnician->num_rows > 0) {
    $technicianData = $resultTechnician->fetch_assoc();

    $technician_id = $technicianData['technician_id'];
    $user_id = $technicianData['user_id'];
    $category = $technicianData['category'];
    $nic_number = $technicianData['nic_number'];
    $nic_photo_url = $technicianData['nic_photo_url'];
    $work_experience = $technicianData['work_experience'];
    $cost_per_day = $technicianData['cost_per_day'];
    $cost_per_hour = $technicianData['cost_per_hour'];
    $status = $technicianData['status'];
    $balance = $technicianData['balance'];

    $selectUserQuery = "SELECT * FROM `user` WHERE `user_id` = '$user_id'";
    $resultUser = $conn->query($selectUserQuery);

    if ($resultUser->num_rows > 0) {
        $userData = $resultUser->fetch_assoc();

        $first_name = $userData['first_name'];
        $last_name = $userData['last_name'];
        $email = $userData['email'];
        $phone_number = $userData['phone_number'];
        $dob = $userData['dob'];
        $house_no = $userData['house_no'];
        $state = $userData['state'];
        $city = $userData['city'];
        $account_type = $userData['account_type'];
        $profile_url = $userData['profile_url'];

        $birthDateObj = new DateTime($dob);
        $currentDateObj = new DateTime();
        $age = $currentDateObj->diff($birthDateObj);
        $age = $age->y;
    }


    $selectTechnicianCategoryQuery1 = "SELECT * FROM `technician_category` WHERE `technician_category_id`= '$category'";
    $resultTechnicianCategory = $conn->query($selectTechnicianCategoryQuery1);

    if ($resultTechnicianCategory->num_rows > 0) {
        $technicianCategoryData = $resultTechnicianCategory->fetch_assoc();

        $technician_category_id = $technicianCategoryData['technician_category_id'];
        $name = $technicianCategoryData['name'];
        $description = $technicianCategoryData['description'];
        $imageUrlCategory = $technicianCategoryData['image_url'];
    }
} else {
    header('location: technicians.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./assets/css/user-nav-1.css">
    <link rel="stylesheet" href="./assets/css/user-nav-2.css">
    <link rel="stylesheet" href="./assets/css/user-menu.css">
    <link rel="stylesheet" href="./assets/css/user-search-bar.css">
    <link rel="stylesheet" href="./assets/css/user-footer.css">
    <link rel="stylesheet" href="./assets/css/user-technician-review.css">
    <link rel="stylesheet" href="./assets/css/user-technician.css">
    <link rel="stylesheet" href="./assets/css/user-style.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
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
            <div class="technician">
                <div class="box">
                    <div class="technician-url">
                        <ul>
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>/</li>
                            <li>
                                <a href="technicians.php">Technicians</a>
                            </li>
                            <li>/</li>
                            <li>
                                <a href=""><?php echo $first_name . ' ' . $last_name ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="technician-content">
                        <div class="technician-header">
                            <div class="technician-content-1">
                                <div class="technician-profile">
                                    <div class="technician-profile-content-1">
                                        <img src="./assets/images/technician/<?php echo $profile_url ?>" alt="">
                                    </div>
                                    <div class="technician-profile-content-2">
                                        <h1><?php echo $first_name . ' ' . $last_name ?></h1>
                                        <p>
                                            <img src="./assets/images/technician_category/<?php echo $imageUrlCategory ?>" alt="">
                                            <a href=""><?php echo $name ?></a>
                                        </p>
                                        <p>
                                            <!-- <img src="./assets/images/technician_category/<?php echo $category ?>1" alt=""> -->
                                            <a href=""><?php echo $city ?></a>
                                        </p>
                                        <div class="technician-profile-button">
                                            <!-- <button>Contact</button> -->
                                            <button onclick="window.location.href='technician-book.php?technician_id=<?php echo $technician_id ?>'">Book</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="technician-content-2">
                                <div class="technician-details">
                                    <div class="technician-details-content-1">
                                        <ul>
                                            <li>Age</li>
                                            <li>Cost per hours</li>
                                            <li>Cost per day</li>
                                            <li>Years of experience</li>
                                        </ul>
                                    </div>
                                    <div class="technician-details-content-2">
                                        <ul>
                                            <li>
                                                <a href=""><?php echo $age ?></a>
                                            </li>
                                            <li>
                                                <a href="">Rs.<?php echo $cost_per_hour ?></a>
                                            </li>
                                            <li>
                                                <a href="">Rs.<?php echo $cost_per_day ?></a>
                                            </li>
                                            <li>
                                                <a href=""><?php echo $work_experience ?> year</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                        $starsC1 = 0;
                        $starsC2 = 0;
                        $starsC3 = 0;
                        $starsC4 = 0;
                        $starsC5 = 0;
                        $allStarCount = 0;
                        $averageRating = 0;
                        $averageRating100 = 100;
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



                            $percentageStar1 = "";
                            $percentageStar2 = "";
                            $percentageStar3 = "";
                            $percentageStar4 = "";
                            $percentageStar5 = "";
                            

                            if ($allStarCount > 0) {
                                $percentageStar1 = ($starsC1 / $allStarCount) * 100;
                                $percentageStar2 = ($starsC2 / $allStarCount) * 100;
                                $percentageStar3 = ($starsC3 / $allStarCount) * 100;
                                $percentageStar4 = ($starsC4 / $allStarCount) * 100;
                                $percentageStar5 = ($starsC5 / $allStarCount) * 100;

                                $totalStars = ($starsC1 * 1) + ($starsC2 * 2) + ($starsC3 * 3) + ($starsC4 * 4) + ($starsC5 * 5);
                                $averageRating = number_format($totalStars / $allStarCount, 1);
                                $averageRating100 = ($averageRating * 20);
                            }
                        }

                        ?>

                        <div class="review">
                            <h4>Review</h4>
                            <div class="review-content">
                                <div class="review-content-1">
                                    <h1><?php echo $averageRating ?>/<span>5</span></h1>
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
                                                <li class="">
                                                    <i class="ri-star-fill"></i>
                                                </li>
                                                
                                                ';
                                        }
                                        ?>


                                    </ul>
                                    <p><?php echo $allStarCount ?> Ratings</p>
                                </div>
                                <div class="review-content-2">
                                    <div class="review-content-2-all">
                                        <div class="review-content-2-content">
                                            <div class="review-content-2-content-1">
                                                <ul>
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
                                                </ul>
                                            </div>
                                            <div class="review-content-2-content-2">
                                                <div class="review-bar">
                                                    <div class="review-line" style="width: <?php echo $percentageStar5 ?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="review-content-2-content-3">
                                                <p><?php echo $starsC5 ?></p>
                                            </div>
                                        </div>
                                        <div class="review-content-2-content">
                                            <div class="review-content-2-content-1">
                                                <ul>
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
                                                </ul>
                                            </div>
                                            <div class="review-content-2-content-2">
                                                <div class="review-bar">
                                                    <div class="review-line" style="width: <?php echo $percentageStar4 ?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="review-content-2-content-3">
                                                <p><?php echo $starsC4 ?></p>
                                            </div>
                                        </div>
                                        <div class="review-content-2-content">
                                            <div class="review-content-2-content-1">
                                                <ul>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="review-content-2-content-2">
                                                <div class="review-bar">
                                                    <div class="review-line" style="width: <?php echo $percentageStar3 ?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="review-content-2-content-3">
                                                <p><?php echo $starsC3 ?></p>
                                            </div>
                                        </div>
                                        <div class="review-content-2-content">
                                            <div class="review-content-2-content-1">
                                                <ul>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="review-content-2-content-2">
                                                <div class="review-bar">
                                                    <div class="review-line" style="width: <?php echo $percentageStar2 ?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="review-content-2-content-3">
                                                <p><?php echo $starsC2 ?></p>
                                            </div>
                                        </div>
                                        <div class="review-content-2-content">
                                            <div class="review-content-2-content-1">
                                                <ul>
                                                    <li class="active">
                                                        <i class="ri-star-fill"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="review-content-2-content-2">
                                                <div class="review-bar">
                                                    <div class="review-line" style="width: <?php echo $percentageStar1 ?>%;"></div>
                                                </div>
                                            </div>
                                            <div class="review-content-2-content-3">
                                                <p><?php echo $starsC1 ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user-review">
                                <h4>Product Reviews</h4>
                                <?php

                                $feedbackT = "SELECT * FROM `booking` WHERE `technician_id` = $technician_id";
                                $resultFeedbackT = $conn->query($feedbackT);

                                if ($resultFeedbackT->num_rows > 0) {
                                    while ($rowFeedbackT = $resultFeedbackT->fetch_assoc()) {
                                        $booking_id = $rowFeedbackT['booking_id'];

                                        $feedbackB = "SELECT * FROM `technician_feedback` WHERE `booking_id` = $booking_id";
                                        $resultFeedback = $conn->query($feedbackB);

                                        if ($resultFeedback->num_rows > 0) {
                                            $rowFeedback = $resultFeedback->fetch_assoc();

                                            $descriptionF = $rowFeedback['description'];
                                            $dateF = $rowFeedback['date'];

                                            echo '
                                        
                                        <div class="user-review-details">
                                        <div class="user-review-header">
                                            <div class="user-review-header-content-1">
                                                <ul>
                                                ';

                                            if ($rowFeedback['number_of_stars'] == 1) {
                                                for ($i = 0; $i < 1; $i++) {
                                                    echo '<li class="active">
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>';
                                                }
                                            } else if ($rowFeedback['number_of_stars'] == 2) {
                                                for ($i = 0; $i < 2; $i++) {
                                                    echo '<li class="active">
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>';
                                                }
                                            } else if ($rowFeedback['number_of_stars'] == 3) {
                                                for ($i = 0; $i < 3; $i++) {
                                                    echo '<li class="active">
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>';
                                                }
                                            } else if ($rowFeedback['number_of_stars'] == 4) {
                                                for ($i = 0; $i < 4; $i++) {
                                                    echo '<li class="active">
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>';
                                                }
                                            } else if ($rowFeedback['number_of_stars'] == 5) {
                                                for ($i = 0; $i < 5; $i++) {
                                                    echo '<li class="active">
                                                        <i class="bi bi-star-fill"></i>
                                                    </li>';
                                                }
                                            }

                                            echo '
                                                </ul>
                                            </div>
                                            
                                            <div class="user-review-header-content-2">
                                                <p>' . $dateF . '</p>
                                            </div>
                                        </div>
                                        <div class="user-review-content">
                                            <p>
                                                ' . $descriptionF . '
                                            </p>
                                        </div>
                                        
                                        <hr>
                                    </div>
                                        
                                        ';
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
        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>
</body>

</html>