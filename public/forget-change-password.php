<?php

session_start();
include "../config/database.php";


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

if (!isset($_SESSION['forget-code'])) {
    header('location: ./forget-password.php');
}

$email = "";

if (!isset($_SESSION['email'])) {
    header('location: ./forget-password.php');
} else {
    $email = $_SESSION['email'];
}

$resetCodeError = $newPasswordError = $confirmPasswordError = "";
$resetCode = $newPassword = $confirmPassword = "";

if (isset($_POST['change'])) {

    $resetCode = $_POST['reset-code'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($resetCode !== $_SESSION['forget-code']) {
        $resetCodeError = "The reset code you entered is incorrect. Please check your email for the reset code and enter it here.";
    }

    if (empty($resetCode)) {
        $resetCodeError = "Please check your email for the reset code and enter it here.";
    }

    if ($newPassword !== $confirmPassword) {
        $confirmPasswordError = "Your new password and confirm password entries do not match.";
    }

    if (empty($newPassword)) {
        $newPasswordError = "Please enter your new password.";
    }

    if (empty($confirmPassword)) {
        $confirmPasswordError = "Please confirm your password.";
    }

    if (empty($resetCodeError) && empty($newPasswordError) && empty($confirmPasswordError)) {

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updateUserQuery = "UPDATE `user` SET 
                            `password` = '$hashedPassword'
                            WHERE `email` = '$email'";

        if ($conn->query($updateUserQuery) === TRUE) {
            header('location: ./login.php');
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
                    <div class="login-header margin-top-40" style="justify-content: left; margin-left:20px;">
                        <h1>Forget your password</h1>
                    </div>
                    <div class="login-details">
                        <p style="font-family: sans-serif; color:#707070; font-size: 14px;">Please enter the email
                            address you'd like your password reset information send to</p>
                        <div class="login-input margin-top-20">
                            <input type="text" placeholder="Enter reset code" name="reset-code" value="<?php echo $resetCode ?>" style="text-align: center;" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            <div class="login-input-icon">
                                <i class="ri-refresh-line"></i>
                            </div>
                        </div>
                        <p class="input-error" style="font-family: sans-serif;"><?php echo $resetCodeError ?></p>
                        <div class="login-input margin-top-20">
                            <input type="password" placeholder="Create new password" name="password"">
                            <div class=" login-input-icon">
                            <i class="ri-git-repository-private-line"></i>
                        </div>
                    </div>
                    <p class="input-error" style="font-family: sans-serif;"><?php echo $newPasswordError ?></p>
                    <div class="login-input margin-top-20">
                        <input type="password" placeholder="Confirm you password" name="confirm-password">
                        <div class="login-input-icon">
                            <i class="ri-git-repository-private-line"></i>
                        </div>
                    </div>
                    <p class="input-error" style="font-family: sans-serif;"><?php echo $confirmPasswordError ?></p>
                    <div class="login-button">
                        <input type="submit" value="Change Password" name="change">
                    </div>
                </div>
    </div>
    </form>
    </section>
    <?php
    include "../template/user-footer.php";
    ?>
    </div>
    <script src="components/js/script.js"></script>
</body>

</html>