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


if (!isset($_SESSION['password'])) {
    header('location: signup-s.php');
}

if (isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: signup-s.php');
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        header('location: signup-delivery-boy.php');
    }
}

$category = $nic_number = $work_experience = $cost_per_day = $cost_per_hour = "";
$categoryError = $nic_numberError = $work_experienceError = $cost_per_dayError = $cost_per_hourError = $nicImageError = "";

if (isset($_POST['previos'])) {
    header('location: signup-s.php');
}

if (isset($_POST['finish'])) {

    $category = $_POST['category'];
    $nic_number = $_POST['nic_number'];
    $work_experience = $_POST['work_experience'];
    $cost_per_day = $_POST['cost_per_day'];
    $cost_per_hour = $_POST['cost_per_hour'];

    if (!isset($_FILES["nic_image"]["name"]) || $_FILES["nic_image"]["size"] == 0) {
        $nicImageError = "Please choose a NIC image file.";
    }

    if (!preg_match('/^\d{9}[Vv]$/',$nic_number)) {
        $nic_numberError =  "Invalid NIC number";
    }

    if (empty($nic_number)) {
        $nic_numberError = "Please enter your nic number";
    }

    if (empty($work_experience)) {
        $work_experienceError = "Please enter work experience";
    }

    if (empty($cost_per_day)) {
        $cost_per_dayError = "Please enter cost per day";
    }

    if (empty($cost_per_hour)) {
        $cost_per_hourError = "Please enter your cost per hour";
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
    $password = $_SESSION['password'];
    $confirm_password = $_SESSION['confirm_password'];
    $security_question = $_SESSION['security_question'];
    $answer = $_SESSION['answer'];

    $emailError = "";

    $selectUserEmailQuery = "SELECT * FROM `user` WHERE `email`= '$email'";
    $resultUserEmail = $conn->query($selectUserEmailQuery);

    if ($resultUserEmail->num_rows > 0) {
        $userData = $resultUserEmail->fetch_assoc();
        if (!empty($userData['email'])) {
            $emailError = "Email already exists. Please choose a different email.";
        }
    }

    if (empty($emailError) && empty($nic_numberError) && empty($work_experienceError) && empty($cost_per_dayError) && empty($cost_per_hourError) && empty($nicImageError)) {
        $_SESSION['category'] = $category;
        $_SESSION['nic_number'] = $nic_number;
        $_SESSION['work_experience'] = $work_experience;
        $_SESSION['cost_per_day'] = $cost_per_day;
        $_SESSION['cost_per_hour'] = $cost_per_hour;

        // get session data 



        // 

        $category = $_SESSION['category'];
        $nic_number = $_SESSION['nic_number'];
        $work_experience = $_SESSION['work_experience'];
        $cost_per_day = $_SESSION['cost_per_day'];
        $cost_per_hour = $_SESSION['cost_per_hour'];

        $targetDirectory = "./assets/images/technician/";

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
                    VALUES ('$first_name','$last_name','$email','$phone_number','$dob','$house_no','$state','$city','technician','$profileUrl','$hashedPassword','$security_question','$answer','pending','$activationCode','$latitude','$longitude')";

        $nic_photo_url = $lastUserId . '_nic.jpg';

        $technicianSql = "INSERT INTO `technician`(`user_id`, `category`, `nic_number`, `nic_photo_url`, `work_experience`, `cost_per_day`, `cost_per_hour`, `status`, `balance`) 
        VALUES ('$lastUserId','$category','$nic_number','$nic_photo_url','$work_experience','$cost_per_day','$cost_per_hour','pending','0')";

        if ($conn->query($sql) === TRUE) {

            if ($conn->query($technicianSql) === TRUE) {

                $newFileName = $lastUserId . "_profile.jpg";
                $targetFile = $targetDirectory . $newFileName;

                // echo "Ok";

                // nic image save
                if (!empty($_FILES["nic_image"]["name"]) && $_FILES["nic_image"]["error"] == UPLOAD_ERR_OK) {
                    $newFileName = $lastUserId . "_nic.jpg";
                    $targetFile = $targetDirectory . $newFileName;
                    if (move_uploaded_file($_FILES["nic_image"]["tmp_name"], $targetFile)) {
                        

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
            }
            session_destroy();
            header('location: login.php');
        }else{
            echo "error";
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
                        <div class="line-content " id="line-content-1">
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
                        <div class="line-content active" id="line-content-2">
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
                                <div class="line  line-3 active"></div>
                                <div class="line-circle line-circle-4 active">
                                    <p>4</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="signup-content" method="post" enctype="multipart/form-data">
                        <div class="input-content">
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>Category</p>
                                    <select name="category" id="user_type">
                                        <?php
                                        $selectSecurityQuestionQuery = "SELECT * FROM `technician_category` WHERE 1";
                                        $resultSecurityQuestion = $conn->query($selectSecurityQuestionQuery);

                                        if ($resultSecurityQuestion->num_rows > 0) {
                                            while ($securityQuestion = $resultSecurityQuestion->fetch_assoc()) {

                                                $securityQuestionId = $securityQuestion['technician_category_id'];
                                                $question = $securityQuestion['name'];

                                                echo '<option value="' . $securityQuestionId . '">' . $question . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>

                                    <p class="input-error"><?php echo $categoryError ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>work experience</p>
                                    <input type="text" name="work_experience" value="<?php
                                                                                        if (isset($_SESSION['work_experience'])) {
                                                                                            echo $_SESSION['work_experience'];
                                                                                        } else {
                                                                                            echo $work_experience;
                                                                                        } ?>">
                                    <p class="input-error"><?php echo $work_experienceError ?></p>
                                </div>
                            </div>
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>Cost per day</p>
                                    <input type="text" name="cost_per_day" value="<?php
                                                                                    if (isset($_SESSION['cost_per_day'])) {
                                                                                        echo $_SESSION['cost_per_day'];
                                                                                    } else {
                                                                                        echo $cost_per_day;
                                                                                    } ?>">
                                    <p class="input-error"><?php echo $cost_per_dayError ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>Cost per hour</p>
                                    <input type="text" name="cost_per_hour" value="<?php
                                                                                    if (isset($_SESSION['cost_per_hour'])) {
                                                                                        echo $_SESSION['cost_per_hour'];
                                                                                    } else {
                                                                                        echo $cost_per_hour;
                                                                                    } ?>">
                                    <p class="input-error"><?php echo $cost_per_hourError ?></p>
                                </div>
                            </div>

                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>Nic Number</p>
                                    <input type="text" name="nic_number" value="<?php
                                                                                if (isset($_SESSION['nic_number'])) {
                                                                                    echo $_SESSION['nic_number'];
                                                                                } else {
                                                                                    echo $nic_number;
                                                                                } ?>">
                                    <p class="input-error"><?php echo $nic_numberError ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <div class="profile-image">
                                        <div class="profile-image-content-1">
                                            <h2>NIC IMAGE</h2>
                                            <img src="../assets/images/technician/" alt="" id="preview-image">
                                            <input type="file" id="file-input" name="nic_image">
                                        </div>
                                        <div class="profile-image-content-2">
                                            <input type="button" class="btn" value="Choose Photo" id="file-button" name="">
                                        </div>
                                    </div>
                                    <p class="input-error" style="margin-top:-20px;"><?php echo $nicImageError ?></p>
                                </div>
                            </div>

                            <div class="right-button margin-top-40">
                                <input type="submit" value="Previos" name="previos">
                                <input type="submit" value="Finish" name="finish">
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
    <script src="./assets/js/profile.js"></script>
</body>

</html>