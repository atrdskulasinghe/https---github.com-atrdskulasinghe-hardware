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

$user_id = $_SESSION['id'];

$item_id = $order_id = $delivery_id = $booking_id = "";

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    if (isset($_GET['item_id'])) {
        $item_id = $_GET['item_id'];

        $itemFeedback = "SELECT * FROM `item_feedback` WHERE `item_id` = $item_id";
        $resultFeedback = $conn->query($itemFeedback);

        if ($resultFeedback->num_rows > 0) {
            $rowFeedback = $resultFeedback->fetch_assoc();

            $orderFeedback = "SELECT * FROM `item_feedback` WHERE `order_id` = $order_id";
            $resultFeedback = $conn->query($orderFeedback);

            if ($resultFeedback->num_rows > 0) {
                $rowFeedbackOrder = $resultFeedback->fetch_assoc();
                header('location: order-history.php');
            } else {
                $feedback = true;
            }
        }
    } else if (isset($_GET['delivery_id'])) {

        $delivery_id = $_GET['delivery_id'];

        $delivery_boy_feedback = "SELECT * FROM `delivery_boy_feedback` WHERE `delivery_id` = $delivery_id";
        $resultFeedback = $conn->query($delivery_boy_feedback);
        if ($resultFeedback->num_rows > 0) {
            $rowFeedback = $resultFeedback->fetch_assoc();
            header('location: order-history.php');
        }
    } else {
        header('location: order-history.php');
    }
} else if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];
} else {
    header('location: index.php');
}

$starsError = $commentError = "";

if (isset($_POST['save'])) {
    $stars = $_POST["stars"];
    $comment = $_POST['comment'];
    $currentDate = date("Y-m-d");
    $currentTime = date("H:i:s");

    if (empty($stars)) {
        $starsError = "please select a stars";
    }
    echo "hello";
    if (!empty($order_id)) {

        if (!empty($item_id)) {
            $sql = "INSERT INTO `item_feedback`( `item_id`, `order_id`, `customer_id`, `description`, `number_of_stars`, `date`, `time`) 
            VALUES ('$item_id','$order_id','$user_id','$comment','$stars','$currentDate','$currentTime')";

            if ($conn->query($sql) === TRUE) {
                header('location: order-history.php');
            }
        } else if (!empty($delivery_id)) {
            $sql = "INSERT INTO `delivery_boy_feedback`(`delivery_id`, `customer_id`, `description`, `number_of_stars`, `date`, `time`) 
            VALUES ('$delivery_id','$user_id','$comment','$stars','$currentDate','$currentTime')";

            if ($conn->query($sql) === TRUE) {
                header('location: order-history.php');
            }
        }
    } else if (!empty($booking_id)) {

        $selectTechnicianQuery1 = "SELECT * FROM `booking` WHERE `booking_id`= '$booking_id'";
        $resultTechnician = $conn->query($selectTechnicianQuery1);

        if ($resultTechnician->num_rows > 0) {
            $row = $resultTechnician->fetch_assoc();
            $technician_id = $row['technician_id'];

            if ($row['technician_id'] !== $user_id) {
                header('location: book-history.php');
            }
        }

        $sql = "INSERT INTO `technician_feedback`(`booking_id`, `customer_id`, `number_of_stars`, `description`, `date`, `time`) 
        VALUES ('$booking_id','$user_id','$stars','$comment','$currentDate','$currentTime')";

        if ($conn->query($sql) === TRUE) {
            header('location: book-history.php');
        }
    }
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
    <link rel="stylesheet" href="./assets/css/button.css">
    <link rel="stylesheet" href="./assets/css/user-contact.css">
    <link rel="stylesheet" href="./assets/css/input.css">
    <link rel="stylesheet" href="./assets/css/feedback.css">
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
            <div class="box">
                <div class="feedback">

                    <form class="feedback-content" method="post">
                        <div class="feedback-title">
                            <h4>Rate your experince</h4>
                        </div>
                        <!-- <p>How to your overall experince today ?</p>
                        <div class="feedback-images">
                            <div class="feedback-image">
                                <img src="./assets/images/ui/camera.png" alt="">
                                <input type="file" name="image-1" id="">
                            </div>
                            <div class="feedback-image">
                                <img src="./assets/images/ui/camera.png" alt="">
                                <input type="file" name="image-2" id="">
                            </div>
                            <div class="feedback-image">
                                <img src="./assets/images/ui/camera.png" alt="">
                                <input type="file" name="image-3" id="">
                            </div>
                            <div class="feedback-image">
                                <img src="./assets/images/ui/camera.png" alt="">
                                <input type="file" name="image-4" id="">
                            </div>
                            <div class="feedback-image">
                                <img src="./assets/images/ui/camera.png" alt="">
                                <input type="file" name="image-5" id="">
                            </div>
                        </div> -->
                        <p>How to your overall experince today ?</p>
                        <div class="feedback-stars">
                            <ul>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                                <li><i class="ri-star-fill"></i></li>
                            </ul>
                        </div>
                        <input type="hidden" id="stars" name="stars">
                        <p>Do you have any thoughts you'd like to share</p>
                        <div class="feedback-comments">
                            <textarea name="comment" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="feedback-button">
                            <input type="submit" class="btn" name="save">
                        </div>
                    </form>
                </div>
        </section>
        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="assets/js/user-script.js"></script>
    <script src="./assets/js/feedback.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const feedbackImages = document.querySelectorAll('.feedback-image');

            feedbackImages.forEach(function(feedbackImage) {
                const img = feedbackImage.querySelector('img');
                const input = feedbackImage.querySelector('input[type="file"]');

                img.addEventListener('click', function() {
                    input.click();
                });

                input.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            img.src = reader.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>
</body>

</html>