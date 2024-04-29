<?php
include "../config/database.php";
session_start();

include "../config/email.php";

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

if (!isset($_SESSION['phone_number'])) {
    header('location: signup-c.php');
}

$password = $confirm_password = $security_question = $answer = "";
$passwordError = $confirm_passwordError = $security_questionError = $answerError = "";

if (isset($_POST['previos'])) {
    header('location: signup-c.php');
}

if (isset($_POST['next']) || isset($_POST['finish'])) {

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $security_question = $_POST['security_question'];
    $answer = $_POST['answer'];

    if ($confirm_password !== $password) {
        $confirm_passwordError = "Passwords do not match";
    }

    if (empty($password)) {
        $passwordError = "Please enter your phone number";
    }

    if (empty($confirm_password)) {
        $confirm_passwordError = "Please enter your house no";
    }

    if (empty($security_question)) {
        $security_questionError = "Please enter your state";
    }

    if (empty($answer)) {
        $answerError = "Please enter your city";
    }

    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $dob = $_SESSION['dob'];
    $account_type = $_SESSION['account_type'];
    $email = $_SESSION['email'];
    $phone_number = $_SESSION['phone_number'];
    $house_no = $_SESSION['house_no'];
    $state = $_SESSION['state'];
    $city = $_SESSION['city'];
    $latitude = $_SESSION['latitude'];
    $longitude = $_SESSION['longitude'];

    $emailError = "";

    $selectUserEmailQuery = "SELECT * FROM `user` WHERE `email`= '$email'";
    $resultUserEmail = $conn->query($selectUserEmailQuery);

    if ($resultUserEmail->num_rows > 0) {
        $userData = $resultUserEmail->fetch_assoc();
        if (!empty($userData['email'])) {
            $emailError = "Email already exists. Please choose a different email.";
        }
    }

    if (empty($emailError) && empty($passwordError) && empty($confirm_passwordError) && empty($security_questionError) && empty($answerError)) {
        $_SESSION['password'] = $password;
        $_SESSION['confirm_password'] = $confirm_password;
        $_SESSION['security_question'] = $security_question;
        $_SESSION['answer'] = $answer;


        if (isset($_SESSION['account_type'])) {
            if ($_SESSION['account_type'] == "customer") {

                // get session data 

                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $selectLastUserId = "SELECT `user_id` FROM `user` ORDER BY `user_id` DESC LIMIT 1";
                $result = $conn->query($selectLastUserId);
                $lastUserId = "1";
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $lastUserId = $row['user_id'] + 1;
                }

                function generateActivationCode($length = 6)
                {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $activationCode = '';
                    for ($i = 0; $i < $length; $i++) {
                        $activationCode .= $characters[rand(0, strlen($characters) - 1)];
                    }
                    return $activationCode;
                }

                $activationCode = generateActivationCode();

                $profileUrl = $lastUserId . '_profile.jpg';

                $sql = "INSERT INTO `user`(`first_name`, `last_name`, `email`, `phone_number`, `dob`, `house_no`, `state`, `city`, `account_type`, `profile_url`, `password`,`security_question`,`question_answer`,`status`,`activation_code`,`latitude`,`longitude`) 
                    VALUES ('$first_name','$last_name','$email','$phone_number','$dob','$house_no','$state','$city','customer','$profileUrl','$hashedPassword','$security_question','$answer','pending','$activationCode','$latitude','$longitude')";

                $nic_photo_url = $lastUserId . '_nic.jpg';

                $customerSql = "INSERT INTO `customer`(`user_id`) 
                    VALUES ('$lastUserId')";

                if ($conn->query($sql) === TRUE) {
                    if ($conn->query($customerSql) === TRUE) {

                        $mail->setFrom('yasirusamarasekara2000@gmail.com', 'Hardware');
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->Subject = 'Activation Code for Your Account.';
                        $mail->Body = 'Dear User,<br><br>'
                            . 'Please click this button and activate your account.<br>'
                            . '<a href="http://localhost/hardware/public/activate.php?id=' . $lastUserId . '&code=' . $activationCode . '" style="display:inline-block;background-color:#007bff;color:#ffffff;font-size:16px;padding:10px 20px;text-decoration:none;border-radius:5px;">Activate Account</a><br><br>'
                            . 'Thank you!<br>';

                        if ($mail->send()) {
                            session_destroy();
                            header('location: ./login.php');
                        }
                    }
                }
            } else if ($_SESSION['account_type'] == "technician") {
                header('location: ./signup-technician.php');
            } else if ($_SESSION['account_type'] == "delivery_boy") {
                header('location: ./signup-delivery-boy.php');
            }
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
                        <div class="line-content <?php if (isset($_SESSION['account_type'])) {
                                                        if ($_SESSION['account_type'] == "customer") {
                                                            echo "active";
                                                        }
                                                    } ?>" id="line-content-1">
                            <div class="line-all-content-1">
                                <div class="line-circle line-circle-1 active">
                                    <p>1</p>
                                </div>
                                <div class="line line-1 active"></div>
                                <div class="line-circle line-circle-2 active">
                                    <p>2</p>
                                </div>
                                <div class="line  line-2 active"></div>
                                <div class="line-circle line-circle-3 active">
                                    <p>3</p>
                                </div>
                            </div>
                        </div>
                        <div class="line-content <?php if (isset($_SESSION['account_type'])) {
                                                        if ($_SESSION['account_type'] !== "customer") {
                                                            echo "active";
                                                        }
                                                    } ?>" id="line-content-2">
                            <div class="line-all-content-2">
                                <div class="line-circle line-circle-1 active">
                                    <p>1</p>
                                </div>
                                <div class="line line-1 active"></div>
                                <div class="line-circle line-circle-2 active">
                                    <p>2</p>
                                </div>
                                <div class="line  line-2 active"></div>
                                <div class="line-circle line-circle-3 active">
                                    <p>3</p>
                                </div>
                                <div class="line  line-3 "></div>
                                <div class="line-circle line-circle-4 ">
                                    <p>4</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="signup-content" method="post">
                        <div class="input-content">
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>Password</p>
                                    <input type="password" name="password">
                                    <p class="input-error"><?php echo $passwordError ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>Confirm Password</p>
                                    <input type="password" name="confirm_password">
                                    <p class="input-error"><?php echo $confirm_passwordError ?></p>
                                </div>
                            </div>

                            <div class="input-one-content">
                                <p>Select your questions</p>
                                <select name="security_question" id="security_question">
                                    <?php
                                    $selectSecurityQuestionQuery = "SELECT * FROM `security_question` WHERE 1";
                                    $resultSecurityQuestion = $conn->query($selectSecurityQuestionQuery);

                                    if ($resultSecurityQuestion->num_rows > 0) {
                                        while ($securityQuestion = $resultSecurityQuestion->fetch_assoc()) {

                                            $securityQuestionId = $securityQuestion['security_question_id'];
                                            $question = $securityQuestion['question'];

                                            echo '<option value="' . $securityQuestionId . '">' . $question . '</option>';
                                        }
                                    }
                                    ?>

                                </select>
                                <!-- <p class="input-error">Please enter your first name</p> -->
                            </div>

                            <div class="input-one-content-2">
                                <p>Enter your Answer</p>
                                <input type="text" name="answer" value="<?php
                                                                        if (isset($_SESSION['answer'])) {
                                                                            echo $_SESSION['answer'];
                                                                        } else {
                                                                            echo $answer;
                                                                        } ?>">
                                <p class="input-error"><?php echo $answerError ?></p>
                            </div>

                            <div class="right-button margin-top-40">
                                <input type="submit" value="Previos" name="previos">
                                <?php if (isset($_SESSION['account_type'])) {
                                    if ($_SESSION['account_type'] !== "customer") {
                                        echo '<input type="submit" value="Next" name="next">';
                                    } else {
                                        echo '<input type="submit" value="Finish" name="finish">';
                                    }
                                } ?>

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
</body>

</html>