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
                <div class="contact">
                    <div class="contact-content-1">

                        <div class="input-content">
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>Your Name</p>
                                    <input type="text">
                                    <p class="input-error">please enter your first name</p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>Your email</p>
                                    <input type="text">
                                    <p class="input-error">please enter your first name</p>
                                </div>
                            </div>
                            <div class="input-one-content">
                                <p>Subject</p>
                                <input type="text">
                                <p class="input-error">please enter your first name</p>
                            </div>
                            <div class="input-one-content">
                                <p>Message</p>
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                                <p class="input-error">please enter your first name</p>
                            </div>


                            <div class="right-button">
                                <input type="submit">
                            </div>
                        </div>
                    </div>
                    <div class="contact-content-2">
                        <div class="location-content-info">
                            <div class="location-content">
                                <div class="location-content-icon">
                                    <i class="ri-home-4-fill"></i>
                                </div>
                                <p>
                                    2/14 Majestic City 10 <br> Station Road, 04 <br> Colombo
                                </p>
                            </div>
                            <div class="location-content">
                                <div class="location-content-icon">
                                    <i class="ri-phone-fill"></i>
                                </div>
                                <p>
                                    011 2200 022
                                </p>
                            </div>
                            <div class="location-content">
                                <div class="location-content-icon">
                                    <i class="ri-mail-fill"></i>
                                </div>
                                <p>
                                    example@gmail.com
                                </p>
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