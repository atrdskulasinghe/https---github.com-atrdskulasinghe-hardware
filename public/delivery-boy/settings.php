<?php

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: ../index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ../cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        header('location: ../technician/index.php');
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        // header('location: ../delivery-doy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        header('location: ../admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ../technical-team/index.php');
    }
} else {
    header('location: ../login.php');
}

include "../../config/database.php";
include "../../template/user-data.php";


$user_id = 2;
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}

$firstName = $lastName = $dob = $nicNumber = $phoneNumber = $email = $houseNumber = $state = $city = $profileUrl = $nicImageUrl = $old_password = $password = $passwordDB = $old_passwordDB = "";

$selectUserQuery = "SELECT * FROM `user` WHERE `user_id` = $user_id";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $dob = $row['dob'];
    $phoneNumber = $row['phone_number'];
    $email = $row['email'];
    $houseNumber = $row['house_no'];
    $state = $row['state'];
    $city = $row['city'];

    $profileUrl = $row['profile_url'];

    $passwordDB = $row['password'];
    // $old_passwordDB = $row['old_password'];
}

$selectUserQuery1 = "SELECT * FROM `delivery_boy` WHERE `user_id` = $user_id";
$result1 = $conn->query($selectUserQuery1);

if ($result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
    $nicNumber = $row['nic_number'];
    $nicImageUrl = $row['nic_image_url'];
}

$firstNameError = $lastNameError = $dobError = $nicNumberError = $phoneNumberError = $emailError = $houseNumberError = $stateError = $cityError = $nicImageError = $passwordError = $confirmPasswordError =  $oldPsswordError =  $passwordError = "";

if (isset($_POST['save_change'])) {

    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $dob = $_POST["dob"];
    // $nicNumber = $_POST["nic_number"];
    $phoneNumber = $_POST["phone_number"];
    // $email = $_POST["email"];
    $houseNumber = $_POST["house_number"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $password = $_POST['password'];
    $old_password = $_POST['old_password'];

    if (empty($firstName)) {
        $firstNameError = "Please enter your first name";
    }

    if (empty($lastName)) {
        $lastNameError = "Please enter your last name";
    }

    if (empty($dob)) {
        $dobError = "Please enter your date of birth";
    }

    if (empty($nicNumber)) {
        $nicNumberError = "Please enter your NIC number";
    }

    if (empty($phoneNumber)) {
        $phoneNumberError = "Please enter your phone number";
    }

    if (empty($houseNumber)) {
        $houseNumberError = "Please enter your house number";
    }

    if (empty($state)) {
        $stateError = "Please enter your state";
    }

    if (empty($city)) {
        $cityError = "Please enter your city";
    }


    if (!empty($old_password)) {
        if ($passwordDB !== $old_password) {
            $oldPsswordError = "Your old password is incorrect";
        } else {
            if (empty($password)) {
                $passwordError = "Please enter your password";
            } else {
                $updateUserQuery = "UPDATE `user` SET 
                `password` = '$password'
                WHERE `user_id` = $user_id";

                if ($conn->query($updateUserQuery) === TRUE) {
                    // login code
                }
            }
        }
    }



    // last user id

    $lastUserId = $user_id;

    // sql code

    $profileUrl = $lastUserId . '_profile.jpg';
    $nicUrl = $lastUserId . '_nic.jpg';

    $updateUserQuery = "UPDATE `user` SET 
    `first_name` = '$firstName', 
    `last_name` = '$lastName', 
    -- `email` = '$email', 
    `phone_number` = '$phoneNumber', 
    `dob` = '$dob', 
    `house_no` = '$houseNumber', 
    `state` = '$state', 
    `city` = '$city'
    WHERE `user_id` = $user_id";

    // image path

    $targetDirectory = "../assets/images/delivery-boy/";

    if (empty($firstNameError) && empty($lastNameError) && empty($dobError) && empty($nicNumberError) && empty($phoneNumberError) && empty($emailError) && empty($houseNumberError) && empty($stateError) && empty($cityError) && empty($nicImageError)) {

        // user save
        if ($conn->query($updateUserQuery) === TRUE) {
            // admin save
            if ($conn->query($updateUserQuery) === TRUE) {
                // profile image save
                if (!empty($_FILES["profile_image"]["name"]) && $_FILES["profile_image"]["error"] == UPLOAD_ERR_OK) {
                    $newFileName = $lastUserId . "_profile.jpg";
                    $targetFile = $targetDirectory . $newFileName;
                    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
                        // nic image save
                        // echo "Hello";

                    }
                }

                // if (!empty($_FILES["nic_image"]["name"]) && $_FILES["nic_image"]["error"] == UPLOAD_ERR_OK) {
                //     $newFileName = $lastUserId . "_nic.jpg";
                //     $targetFile = $targetDirectory . $newFileName;
                //     if (move_uploaded_file($_FILES["nic_image"]["tmp_name"], $targetFile)) {
                //         header('location: cashier-view.php?user=' . $lastUserId . '');
                //     }
                // } else {
                //     header('location: cashier-view.php?user=' . $lastUserId . '');
                // }
            }
        }
    }
}

$conn->close();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard-menu.css">
    <link rel="stylesheet" href="../assets/css/dashboard-nav.css">
    <link rel="stylesheet" href="../assets/css/dashboard-profile.css">
    <link rel="stylesheet" href="../assets/css/dashboard-review.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/card.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/review.css">
    <link rel="stylesheet" href="../assets/css/stars.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <!-- navigation -->
        <?php
        include "../../template/dashboard-nav.php";
        ?>
        <!-- <div class="content"> -->
        <aside class="active aside">
            <!-- menu -->
            <div class="menu">
            <?php
                include "../../template/dashboard-menu.php";
                ?>
                <div class="menu-content">
                    <div class="menu-links">
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./index.php">
                                <p><img src="../assets/images/ui/dashboard.png" alt="">Dashboard</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./delivery-request.php">
                                <p><img src="../assets/images/ui/Product.png" alt="">Delivery Request</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <!-- <div class="menu-link-button">
                            <a href="./calender.php">
                                <p><img src="../assets/images/ui/Calendar.png" alt="">Calendar</p>
                            </a>
                        </div> -->
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./wallet.php">
                                <p><img src="../assets/images/ui/Wallet.png" alt="">My Wallet</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./salary-request.php">
                                <p><img src="../assets/images/ui/salary-request.png" alt="">Salary Request</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./feedback.php">
                                <p><img src="../assets/images/ui/Feedback.png" alt="">Feedback</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <!-- <div class="menu-link-button">
                            <a href="./message.php">
                                <p><img src="../assets/images/ui/messages.png" alt="">Messages</p>
                            </a>
                        </div> -->
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./history.php">
                                <p><img src="../assets/images/ui/history.png" alt="">History</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button active">
                            <a href="./settings.php">
                                <p><img src="../assets/images/ui/Settings.png" alt="">Settings</p>
                            </a>
                        </div>
                    </div>
                    <div class="menu-logout">
                        <a href="../logout.php">
                            <p><img src="../assets/images/ui/Exit.png" alt="">Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
        <section class="active section">
            <div class="content">
                <form class="profile" method="POST" enctype="multipart/form-data">
                    <div class="profile-content">
                        <div class="profile-content-1">
                            <h1>Basic Information</h1>
                            <p>Edit your account details and settings.</p>
                        </div>
                        <div class="profile-content-2">
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>AVATAR</h2>
                                    <img src="../assets/images/delivery-boy/<?php echo $profileUrl ?>" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="profile_image" value="../assets/images/delivery-boy/<?php echo $profileUrl ?>">
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button" name="">
                                </div>
                            </div>
                            <div class="input-content">
                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>First Name</p>
                                        <input type="text" name="first_name" value="<?php echo $firstName ?>">
                                        <p class="input-error"><?php echo $firstNameError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>Last Name</p>
                                        <input type="text" name="last_name" value="<?php echo $lastName ?>">
                                        <p class="input-error"><?php echo $lastNameError ?></p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>DATE OF BIRTH</p>
                                        <input type="date" name="dob" value="<?php echo $dob ?>">
                                        <p class="input-error"><?php echo $dobError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>NIC NUMBER</p>
                                        <input type="text" name="nic_number" value="<?php echo $nicNumber ?> " disabled>
                                        <p class="input-error"><?php echo $nicNumberError ?></p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>PHONE NUMBER</p>
                                        <input type="text" name="phone_number" value="<?php echo $phoneNumber ?>">
                                        <p class="input-error"><?php echo $phoneNumberError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>EMAIL</p>
                                        <input type="text" name="email" style="user-select: none;" value="<?php echo $email ?>" disabled>
                                        <p class="input-error"><?php echo $emailError ?></p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>HOUSE NUMBER</p>
                                        <input type="text" name="house_number" value="<?php echo $houseNumber ?>">
                                        <p class="input-error"><?php echo $houseNumberError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>STATE</p>
                                        <input type="text" name="state" value="<?php echo $state ?>">
                                        <p class="input-error"><?php echo $stateError ?></p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>CITY</p>
                                        <input type="text" name="city" value="<?php echo $city ?>">
                                        <p class="input-error"><?php echo $cityError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>NIC Photo</p>
                                        <div class="profile-nic">
                                            <img src="../assets/images/delivery-boy/<?php echo $nicImageUrl; ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-content">
                        <div class="profile-content-1">
                            <h1>Security Information</h1>
                            <p>Edit your account details and settings.</p>
                        </div>
                        <div class="profile-content-2">
                            <div class="input-content">
                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>old password</p>
                                        <input type="password" name="old_password" value="">
                                        <p class="input-error"><?php echo $oldPsswordError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>password</p>
                                        <input type="password" name="password" value="">
                                        <p class="input-error"><?php echo $passwordError ?></p>
                                    </div>
                                </div>

                                <div class="right-button ">
                                    <!-- <input type="submit" value="Remove" name="remove"> -->
                                    <input type="submit" value="Save Change" name="save_change">
                                    <!-- <input type="submit" value="Save" name="save"> -->
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </section>
        <!-- </div> -->
    </div>

    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/profile.js"></script>
</body>

</html>