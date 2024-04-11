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
    } else if ($_SESSION['account_type'] == "technician") {
        header('location: signup-technician.php');
    }
}

$nic_number  = $vehicle_type = $vehicle_number = $vehicle_model = "";
$nic_numberError = $nicImageError = $vehicle_typeError = $vehicle_numberError = $vehicle_modelError = "";

if (isset($_POST['previos'])) {
    header('location: signup-s.php');
}

if (isset($_POST['finish'])) {

    $nic_number = $_POST['nic_number'];
    $vehicle_type = $_POST['vehicle_type'];
    $vehicle_number = $_POST['vehicle_number'];
    $vehicle_model = $_POST['vehicle_model'];

    if (empty($nic_number)) {
        $nic_numberError = "Please enter your nic number";
    }

    if (empty($vehicle_type)) {
        $vehicle_typeError = "Please enter your vehicle type";
    }

    if (empty($vehicle_number)) {
        $vehicle_numberError = "Please enter your vehicle number";
    }

    if (empty($vehicle_model)) {
        $vehicle_modelError = "Please enter your vehicle model";
    }

    if (!isset($_FILES["nic_image"]["name"]) || $_FILES["nic_image"]["size"] == 0) {
        $nicImageError = "Please choose a NIC image file.";
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

    if (empty($emailError) && empty($nic_numberError) && empty($vehicle_typeError) && empty($vehicle_numberError) && empty($vehicle_modelError)  && empty($nicImageError)) {
        $_SESSION['nic_number'] = $nic_number;
        $_SESSION['vehicle_type'] = $vehicle_type;
        $_SESSION['vehicle_number'] = $vehicle_number;
        $_SESSION['vehicle_model'] = $vehicle_model;
        
        $targetDirectory = "./assets/images/delivery-boy/";

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
                    VALUES ('$first_name','$last_name','$email','$phone_number','$dob','$house_no','$state','$city','delivery_boy','$profileUrl','$hashedPassword','$security_question','$answer','pending','100','$latitude','$longitude')";

        $nic_photo_url = $lastUserId . '_nic.jpg';

        $deliveryBoySql = "INSERT INTO `delivery_boy`(`user_id`, `nic_number`, `nic_image_url`, `vehicle_type`, `status`, `vehicle_number`, `vehicle_model`, `balance`) 
        VALUES ('$lastUserId','$nic_number','$nic_photo_url','$vehicle_type','pending','$vehicle_number','$vehicle_model','0')";

        if ($conn->query($sql) === TRUE) {

            if ($conn->query($deliveryBoySql) === TRUE) {

                $newFileName = $lastUserId . "_profile.jpg";
                $targetFile = $targetDirectory . $newFileName;

                // nic image save
                if (!empty($_FILES["nic_image"]["name"]) && $_FILES["nic_image"]["error"] == UPLOAD_ERR_OK) {
                    $newFileName = $lastUserId . "_nic.jpg";
                    $targetFile = $targetDirectory . $newFileName;
                    if (move_uploaded_file($_FILES["nic_image"]["tmp_name"], $targetFile)) {

                        $mail->setFrom('tharinduruchiranga252@gmail.com', 'Hardware');
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
                        };

                    }
                }

                
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
                                    <p>vehicle type</p>
                                    <select name="vehicle_type" id="user_type">
                                        <option value="car">Car</option>
                                        <option value="bike">Bike</option>
                                        <option value="tricycles">Tricycles</option>
                                        <option value="truck">Truck</option>
                                    </select>
                                    <p class="input-error"><?php echo $vehicle_typeError ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>vehicle number</p>
                                    <input type="text" name="vehicle_number" value="<?php
                                                                                    if (isset($_SESSION['vehicle_number'])) {
                                                                                        echo $_SESSION['vehicle_number'];
                                                                                    } else {
                                                                                        echo $vehicle_number;
                                                                                    } ?>">
                                    <p class="input-error"><?php echo $vehicle_numberError ?></p>
                                </div>
                            </div>
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>vehicle model</p>
                                    <input type="text" name="vehicle_model" value="<?php
                                                                                    if (isset($_SESSION['vehicle_model'])) {
                                                                                        echo $_SESSION['vehicle_model'];
                                                                                    } else {
                                                                                        echo $vehicle_model;
                                                                                    } ?>">
                                    <p class="input-error"><?php echo $vehicle_modelError ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>Nic number</p>
                                    <input type="text" name="nic_number" value="<?php
                                                                                if (isset($_SESSION['nic_number'])) {
                                                                                    echo $_SESSION['nic_number'];
                                                                                } else {
                                                                                    echo $nic_number;
                                                                                } ?>">
                                    <p class="input-error"><?php echo $nic_numberError ?></p>
                                </div>
                            </div>

                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>NIC NUMBER</h2>
                                    <img src="../assets/images/admin/" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="nic_image">
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button" name="">
                                </div>
                            </div>
                            <p class="input-error" style="margin-top:-20px;"><?php echo $nicImageError ?></p>

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