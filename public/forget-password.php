<?php

session_start();
include "../config/database.php";
include "../config/email.php";

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

$email_error = "";

if (isset($_POST['request'])) {

    function generateActivationCode($length = 6)
    {
        $characters = '0123456789';
        $activationCode = '';
        for ($i = 0; $i < $length; $i++) {
            $activationCode .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $activationCode;
    }

    $activationCode = generateActivationCode();


    $email = $_POST['email'];

    if (empty($email)) {
        $email_error = "Please enter your email";
    }

    $selectUserQuery = "SELECT * FROM `user` WHERE `email` = '$email'";
    $resultUserEmail = $conn->query($selectUserQuery);

    if ($resultUserEmail->num_rows > 0) {
        $userData = $resultUserEmail->fetch_assoc();

    }else{
        $email_error = "This email does not have an associated account.";

    }
    

    if (empty($email_error)) {
        $mail->setFrom('tharinduruchiranga252@gmail.com', 'Hardware');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your Account Reset code.';
        $mail->Body = 'Dear User,<br><br>'
            . 'This is your reset code: <strong>' . $activationCode . '</strong><br><br>'
            . 'Thank you!<br>';

        if ($mail->send()) {
            $_SESSION['forget-code'] = $activationCode;
            $_SESSION['email'] = $email;
            header('location: ./forget-change-password.php');
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
                            <input type="text" placeholder="Enter your Email" name="email">
                            <div class="login-input-icon">
                                <i class="ri-mail-line"></i>
                            </div>
                        </div>
                        <p class="input-error" style="font-family: sans-serif;"><?php echo $email_error ?></p>
                        <div class="login-button">
                            <input type="submit" value="Request Reset Link" name="request">
                        </div>
                        <div class="signup-link">
                            <a href="./login.php">Back To Login</a>
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