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

$email = "";
$emailError = "";
$passwordError = "";

$user_id = $first_name = $last_name = $email = $phone_number = $dob = $house_no = $state = $city = $account_type = $profile_url = $passwordDB = $security_question = $question_answer = $status = $latitude = $longitude = "";
$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $emailError = "Please enter your email";
    }

    if (empty($password)) {
        $passwordError = "Please enter your password";
    }

    if (empty($emailError) && empty($passwordError)) {
        $selectUserEmailQuery = "SELECT * FROM `user` WHERE `email`= '$email'";
        $resultUserEmail = $conn->query($selectUserEmailQuery);

        if ($resultUserEmail->num_rows > 0) {
            $userData = $resultUserEmail->fetch_assoc();

            $user_id = $userData['user_id'];
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
            $passwordDB = $userData['password'];
            $security_question = $userData['security_question'];
            $question_answer = $userData['question_answer'];
            $status = $userData['status'];
            $latitude = $userData['latitude'];
            $longitude = $userData['longitude'];

            if (password_verify($password, $userData['password'])) {
                if ($status == "active" || $status == "") {

                    $_SESSION['id'] = $user_id;
                    $_SESSION['account_type'] = $account_type;

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
                } elseif ($status == "pending") {
                    $error = "Your account is pending activation. Please check your email and confirm your email address to proceed.";
                } elseif ($status == "reject") {
                    $error = "Your account has been suspended. Please contact support for further assistance.";
                }
            } else {
                $error = "Invalid email or password. Please check your credentials and try again.";
            }
        } else {
            $error = "Invalid email or password. Please check your credentials and try again.";
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
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/css/user-style.css">
    <link rel="stylesheet" href="./assets/css/input.css">

    <style>
        .message {
            width: calc(100% - 40px);
            min-height: 50px;
            background-color: maroon;
            display: flex;
            align-items: center;
            padding: 5px 20px;
            margin-top: 20px;
            font-family: sans-serif;
            font-size: 14px;
            color: white;
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
            <form class="login-content" method="post">
                <div class="login-box">
                    <div class="login-logo">
                        <img src="./assets/images/ui/login.jpg" alt="">
                    </div>
                    <div class="login-header">
                        <h1>Login Now</h1>
                    </div>
                    <?php if (!empty($error)) {
                        echo '
                    <div class="message">
                        <p>' . $error . '</p>
                    </div>';
                    }
                    ?>
                    <div class="login-details">
                        <div class="login-input">
                            <input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>">
                            <div class="login-input-icon">
                                <i class="ri-mail-line"></i>
                            </div>
                        </div>
                        <p class="input-error" style="font-family:sans-serif; font-size: 12px; margin-top:-10px; margin-bottom:20px;"><?php echo $emailError ?></p>
                        <div class="login-input">
                            <input type="password" placeholder="Password" name="password">
                            <div class="login-input-icon">
                                <i class="ri-lock-line"></i>
                            </div>
                        </div>
                        <p class="input-error" style="font-family:sans-serif; font-size: 12px; margin-top:-10px; margin-bottom:20px;"><?php echo $passwordError ?></p>
                        <div class="forget-password">
                            <div class="forget-content-1">
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember me</label>
                            </div>
                            <div class="forget-content-2">
                                <a href="">Forget password</a>
                            </div>
                        </div>
                        <div class="login-button">
                            <input type="submit" value="Login" name="login">
                        </div>
                        <div class="signup-link">
                            <a href="./signup.php">Don't have an account ?</a>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>
</body>

</html>