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
        header('location: ../delivery-boy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        // header('location: ../admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ../technical-team/index.php');
    }
} else {
    header('location: ../login.php');
}

include "../../config/database.php";
include "../../template/user-data.php";

$user_id = $_GET['user'];

$firstName = $lastName = $dob = $nicNumber = $phoneNumber = $email = $houseNumber = $state = $city = $password = $profileUrl = $nicImageUrl = $category = $work_experience = $cost_per_day = $cost_per_hour = $technicianCategoryName = "";

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
    $password = $row['password'];
    $profileUrl = $row['profile_url'];
} else {
    header('location: new-technician.php');
}

$selectUserQuery1 = "SELECT * FROM `technician` WHERE `user_id` = $user_id";
$result1 = $conn->query($selectUserQuery1);

if ($result1->num_rows > 0) {
    $row = $result1->fetch_assoc();
    $nicNumber = $row['nic_number'];
    $nicImageUrl = $row['nic_photo_url'];
    $category = $row['category'];
    $work_experience = $row['work_experience'];
    $cost_per_day = $row['cost_per_day'];
    $cost_per_hour = $row['cost_per_hour'];
}

if (isset($_POST['reject'])) {
    $updateCashierQuery = "UPDATE `technician` SET 
    `status` = 'reject'
    WHERE `user_id` = $user_id";

    if ($conn->query($updateCashierQuery) === TRUE) {
        header('location: new-technician.php');
    }
}

if (isset($_POST['approve'])) {
    $updateCashierQuery = "UPDATE `technician` SET 
    `status` = 'approved'
    WHERE `user_id` = $user_id";

    if ($conn->query($updateCashierQuery) === TRUE) {
        header('location: new-technician.php');
    }
}


$firstNameError = $lastNameError = $dobError = $nicNumberError = $phoneNumberError = $emailError = $houseNumberError = $stateError = $cityError = $nicImageError = $passwordError = $confirmPasswordError = $vehicleTypeError = $vehicleNumberError = $vehicleModelError = "";

if (isset($_POST['save_change'])) {

    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $dob = $_POST["dob"];
    $nicNumber = $_POST["nic_number"];
    $phoneNumber = $_POST["phone_number"];
    // $email = $_POST["email"];
    $houseNumber = $_POST["house_number"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $category = $_POST['category'];
    $work_experience = $_POST['work_experience'];
    $cost_per_day = $_POST['cost_per_day'];
    $cost_per_hour = $_POST['cost_per_hour'];

    if (empty($firstName)) {
        $firstNameError = "Please enter first name";
    }

    if (empty($lastName)) {
        $lastNameError = "Please enter last name";
    }

    if (empty($dob)) {
        $dobError = "Please enter date of birth";
    }

    if (empty($nicNumber)) {
        $nicNumberError = "Please enter NIC number";
    }

    if (empty($phoneNumber)) {
        $phoneNumberError = "Please enter phone number";
    }


    if (empty($houseNumber)) {
        $houseNumberError = "Please enter house number";
    }

    if (empty($state)) {
        $stateError = "Please enter state";
    }

    if (empty($city)) {
        $cityError = "Please enter city";
    }

    if (empty($work_experience)) {
        $vehicleTypeError = "Please enter work experience";
    }

    if (empty($cost_per_day)) {
        $vehicleNumberError = "Please enter cost per day";
    }

    if (empty($cost_per_hour)) {
        $vehicleModelError = "Please enter cost per hour";
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


    $updateCashierQuery = "UPDATE `technician` SET 
    `nic_number` = '$nicNumber',
    `category` = '$category',
    `work_experience` = '$work_experience',
    `cost_per_day` = '$cost_per_day',
    `cost_per_hour` = '$cost_per_hour'
    WHERE `user_id` = $user_id";

    // image path

    $targetDirectory = "../assets/images/technician/";

    if (empty($firstNameError) && empty($lastNameError) && empty($dobError) && empty($nicNumberError) && empty($phoneNumberError) && empty($emailError) && empty($houseNumberError) && empty($stateError) && empty($cityError)  && empty($vehicleTypeError) && empty($vehicleNumberError) && empty($vehicleModelError)) {
        // user save
        if ($conn->query($updateUserQuery) === TRUE) {
            // cashier save
            if ($conn->query($updateCashierQuery) === TRUE) {
                // profile image save
                if (!empty($_FILES["profile_image"]["name"]) && $_FILES["profile_image"]["error"] == UPLOAD_ERR_OK) {
                    $newFileName = $lastUserId . "_profile.jpg";
                    $targetFile = $targetDirectory . $newFileName;
                    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
                        // nic image save
                        echo "Hello";
                    }
                }

                header('location: new-technician.php');
                // if (!empty($_FILES["nic_image"]["name"]) && $_FILES["nic_image"]["error"] == UPLOAD_ERR_OK) {
                //     $newFileName = $lastUserId . "_nic.jpg";
                //     $targetFile = $targetDirectory . $newFileName;
                //     if (move_uploaded_file($_FILES["nic_image"]["tmp_name"], $targetFile)) {
                //         header('location: delivery-boy-view.php?user=' . $lastUserId . '');
                //     }
                // } else {
                //     header('location: delivery-boy-view.php?user=' . $lastUserId . '');
                // }
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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard-menu.css">
    <link rel="stylesheet" href="../assets/css/dashboard-nav.css">
    <link rel="stylesheet" href="../assets/css/dashboard-technician.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/card.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/dashboard-profile.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
    <?php
    include "../../config/database.php";
    ?>
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
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2 active">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/booking.png" alt="">Technician</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technicians.php">
                                        <p><img src="../assets/images/ui/booking.png" alt="">Technicians</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button active">
                                    <a href="./new-technician.php">
                                        <p><img src="../assets/images/ui/new technicians.png" alt="">New Technicians</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technician-category.php">
                                        <p><img src="../assets/images/ui/category.png" alt="">Technician Category</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technician-salary-request.php">
                                        <p><img src="../assets/images/ui/salary-request.png" alt="">Salary Request</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/delivery-boy.png" alt="">Delivery Boy</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./delivery-boys.php">
                                        <p><img src="../assets/images/ui/Courier.png" alt="">All Delivery Boys</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./new-delivery-boy.php">
                                        <p><img src="../assets/images/ui/new delivery boy.png" alt="">New Delivery Boys</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./delivery-boy-salary-request.php">
                                        <p><img src="../assets/images/ui/salary-request.png" alt="">Salary Request</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/employee.png" alt="">Employee</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./add-technical-team.php">
                                        <p><img src="../assets/images/ui/technical team.png" alt="">Add Technical Team</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technical-team.php">
                                        <p><img src="../assets/images/ui/technical team.png" alt="">Technical Team</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./add-cashiers.php">
                                        <p><img src="../assets/images/ui/Cashiers.png" alt="">Add Cashiers</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./cashiers.php">
                                        <p><img src="../assets/images/ui/Cashiers.png" alt="">Cashiers</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./orders.php">
                                <p><img src="../assets/images/ui/add item.png" alt="">Orders</p>
                            </a>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/item.png" alt="">Item</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./items.php">
                                        <p><img src="../assets/images/ui/all items.png" alt="">All Items</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./add-item.php">
                                        <p><img src="../assets/images/ui/add item.png" alt="">Add Item</p>
                                    </a>
                                </div>

                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./item-category.php">
                                        <p><img src="../assets/images/ui/category.png" alt="">Item Category</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./customers.php">
                                <p><img src="../assets/images/ui/customer.png" alt="">Customer</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./income.php">
                                <p><img src="../assets/images/ui/income.png" alt="">Income Report</p>
                            </a>
                        </div>

                        <!-- menu link 1 -->
                        <div class="menu-link-button">
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
                                    <img src="../assets/images/technician/<?php echo $profileUrl ?>" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="profile_image" value="../assets/images/technician/<?php echo $profileUrl ?>">
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
                                        <input type="text" name="nic_number" value="<?php echo $nicNumber ?>">
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
                                            <img src="../assets/images/technician/<?php echo $nicImageUrl; ?>" alt="">
                                        </div>
                                    </div>
                                </div>

                               

                            </div>
                        </div>
                    </div>

                    <div class="profile-content">
                        <div class="profile-content-1">
                            <h1>Technician Information</h1>
                            <p>Edit your account details and settings.</p>
                        </div>
                        <div class="profile-content-2">
                            <div class="input-content">
                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>TECHNICIAN CATEGORY</p>
                                        <select name="category" id="">

                                            <?php

                                            $selectUserQuery1 = "SELECT * FROM `technician_category` WHERE 1";

                                            if ($conn->query($selectUserQuery1)->num_rows > 0) {
                                                $result = $conn->query($selectUserQuery1);

                                                while ($row = $result->fetch_assoc()) {
                                                    $categoryID = $row['technician_category_id'];
                                                    $categoryName = $row['name'];

                                                    if ($categoryID == $category) {
                                                        echo '<option value="' . $categoryID . '" selected>' . $categoryName . '</option>';
                                                    } else {
                                                        echo '<option value="' . $categoryID . '">' . $categoryName . '</option>';
                                                    }
                                                }
                                            } else {
                                                echo '<option value="-1">No categories found</option>';
                                            }

                                            ?>
                                        </select>
                                        <p class="input-error"><?php echo $vehicleTypeError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>work Experience</p>
                                        <input type="text" name="work_experience" value="<?php echo $work_experience ?>">
                                        <p class="input-error"><?php echo $vehicleNumberError ?></p>
                                    </div>
                                </div>
                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>cost Per Day</p>
                                        <input type="text" name="cost_per_day" value="<?php echo $cost_per_day ?>">
                                        <p class="input-error"><?php echo $vehicleModelError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>cost Per hour</p>
                                        <input type="text" name="cost_per_hour" value="<?php echo $cost_per_hour ?>">
                                        <p class="input-error"><?php echo $stateError ?></p>
                                    </div>
                                </div>
                                <div class="right-button ">
                                    <input type="submit" value="Reject" name="reject">
                                    <input type="submit" value="Approve" name="approve">
                                    <input type="submit" value="Save Change" name="save_change">
                                   
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