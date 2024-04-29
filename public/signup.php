<?php
include "../config/database.php";
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: index.php');
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



$first_name = $last_name = $dob = $account_type = $email = "";
$first_nameError = $last_nameError = $dobError = $account_typeError = $emailError = "";

if (isset($_POST['next'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $account_type = $_POST['account_type'];
    $email = $_POST['email'];

    if (empty($first_name)) {
        $first_nameError = "Please enter your first name";
    }

    if (empty($last_name)) {
        $last_nameError = "Please enter your last name";
    }

    if (empty($dob)) {
        $dobError = "Please enter your date of birth";
    }

    if (empty($email)) {
        $emailError = "Please enter your email";
    }

    if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        $emailError = "Invalid email address.";
    }

    $selectUserEmailQuery = "SELECT * FROM `user` WHERE `email`= '$email'";
    $resultUserEmail = $conn->query($selectUserEmailQuery);

    if ($resultUserEmail->num_rows > 0) {
        $userData = $resultUserEmail->fetch_assoc();

        if (!empty($userData['email'])) {
            $emailError = "Email already exists. Please choose a different email.";
        }
    }

    if (empty($first_nameError) && empty($last_nameError) && empty($dobError) && empty($emailError)) {


        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['dob'] = $dob;
        $_SESSION['account_type'] = $account_type;
        $_SESSION['email'] = $email;

        header('location: signup-c.php');
    }
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
    <link rel="stylesheet" href="./assets/css/user-style.css">
    <link rel="stylesheet" href="./assets/css/signup.css">
    <link rel="stylesheet" href="./assets/css/signup.css">
    <!-- <link rel="stylesheet" href="./assets/css/line-1.css"> -->
    <link rel="stylesheet" href="./assets/css/button.css">
    <link rel="stylesheet" href="./assets/css/input.css">
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

        <!-- section -->

        <section>
            <div class="all-signup">
                <div class="signup-box">
                    <div class="signup-line">
                        <div class="line-content active" id="line-content-1">
                            <div class="line-all-content-1">
                                <div class="line-circle line-circle-1 active">
                                    <p>1</p>
                                </div>
                                <div class="line line-1 "></div>
                                <div class="line-circle line-circle-2 ">
                                    <i class="ri-check-line"></i>
                                    <p>2</p>
                                </div>
                                <div class="line  line-2 "></div>
                                <div class="line-circle line-circle-3 ">
                                    <i class="ri-check-line"></i>
                                    <p>3</p>
                                </div>
                            </div>
                        </div>
                        <div class="line-content" id="line-content-2">
                            <div class="line-all-content-2">
                                <div class="line-circle line-circle-1 active">
                                    <p>1</p>
                                </div>
                                <div class="line line-1 "></div>
                                <div class="line-circle line-circle-2 ">
                                    <p>2</p>
                                </div>
                                <div class="line  line-2 "></div>
                                <div class="line-circle line-circle-3 ">
                                    <p>3</p>
                                </div>
                                <div class="line  line-3 "></div>
                                <div class="line-circle line-circle-4 ">
                                    <p>4</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="signup-content" method="POST">
                        <div class="input-content">
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>First Name</p>
                                    <input type="text" name="first_name" value="<?php
                                                                                if (isset($_SESSION['first_name'])) {
                                                                                    echo $_SESSION['first_name'];
                                                                                } else {
                                                                                    echo $first_name;
                                                                                } ?>">
                                    <p class="input-error"><?php echo $first_nameError ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>Last Name</p>
                                    <input type="text" name="last_name" value="<?php
                                                                                if (isset($_SESSION['last_name'])) {
                                                                                    echo $_SESSION['last_name'];
                                                                                } else {
                                                                                    echo $last_name;
                                                                                } ?>">
                                    <p class="input-error"><?php echo $last_nameError ?></p>
                                </div>
                            </div>
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>Date of birth</p>
                                    <input type="date" name="dob" value="<?php
                                                                            if (isset($_SESSION['dob'])) {
                                                                                echo $_SESSION['dob'];
                                                                            } else {
                                                                                echo $dob;
                                                                            } ?>">
                                    <p class="input-error"><?php echo $dobError ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>Account Type</p>
                                    <select name="account_type" id="user_type">
                                        <option value="customer">Customer</option>
                                        <option value="technician">Technician</option>
                                        <option value="delivery_boy">Delivery Boy</option>
                                    </select>
                                    <p class="input-error"><?php echo $account_typeError ?></p>
                                </div>
                            </div>
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>Email</p>
                                    <input type="text" name="email" value="<?php
                                                                            if (isset($_SESSION['email'])) {
                                                                                echo $_SESSION['email'];
                                                                            } else {
                                                                                echo $email;
                                                                            } ?>">
                                    <p class="input-error"><?php echo $emailError ?></p>
                                </div>
                            </div>
                            <div class="right-button margin-top-40">
                                <input type="submit" value="Next" name='next'>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>
        <!-- footer -->

        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>
    <script>
        let userType = document.getElementById("user_type");

        userType.addEventListener("click", () => {
            if (userType.value == 'customer') {
                document.getElementById("line-content-1").classList.add("active");
                document.getElementById("line-content-2").classList.remove("active");
            } else {
                document.getElementById("line-content-1").classList.remove("active");
                document.getElementById("line-content-2").classList.add("active");
            }

        })
    </script>
</body>

</html>