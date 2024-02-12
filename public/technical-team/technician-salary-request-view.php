<?php
include "../../config/database.php";


$payment_id = $_GET['payment_id'];

$first_name = $last_name = "";

$bank_details_id = $bank_name =  $branch = $holder_name = $account_no = "";
$technician_id = $date = $time =  $amount = $user_id = "";

$selectBankQuery = "SELECT * FROM `payment` WHERE `payment_id` = '$payment_id' AND `status` = 'pending'";
$result = $conn->query($selectBankQuery);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $date = $row['date'];
    $user_id = $row['user_id'];
    $time = $row['time'];
    $amount = $row['amount'];
} else {
    header('location: technician-salary-request.php');
}


$selectUserQuery = "SELECT * FROM `user` WHERE `user_id` = $user_id";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $user_type = $row['account_type'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];

    if ($user_type !== 'technician') {
        header('location: technician-salary-request.php');
    }
} else {
    header('location: technician-salary-request.php');
}


$selectBankQuery = "SELECT * FROM `bank_details` WHERE `user_id` = '$user_id'";
$result = $conn->query($selectBankQuery);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $bank_name = $row['bank_name'];
    $branch = $row['branch'];
    $holder_name = $row['holder_name'];
    $account_no = $row['account_no'];
}

$selectBankQuery = "SELECT * FROM `technician` WHERE `user_id` = '$user_id'";
$result = $conn->query($selectBankQuery);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $technician_id = $row['technician_id'];
}


if (isset($_POST['paid'])) {

    $updateUserQuery = "UPDATE `payment` SET 
    `status` = 'paid'
    WHERE `payment_id` = $payment_id";

    if ($conn->query($updateUserQuery) === TRUE) {
        header('location: technician-salary-request.php');
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
                <div class="menu-header">
                    <h1>Logo</h1>
                    <div class="menu-close">
                        <i class="ri-close-line " id="menu-header-icon"></i>
                    </div>
                </div>
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
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./new-technician.php">
                                        <p><img src="../assets/images/ui/new technicians.png" alt="">New Technicians</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technician-category.php">
                                        <p><img src="../assets/images/ui/category.png" alt="">Technician Category</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button active">
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
                        <div class="menu-link-button-2 ">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/item.png" alt="">Item</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list ">
                                <div class="menu-link-button menu-hidden-button ">
                                    <a href="./items.php">
                                        <p><img src="../assets/images/ui/all items.png" alt="">All Items</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button ">
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
                            <a href="./settings.php">
                                <p><img src="../assets/images/ui/Settings.png" alt="">Settings</p>
                            </a>
                        </div>
                    </div>
                    <div class="menu-logout">
                        <a href="">
                            <p><img src="../assets/images/ui/Exit.png" alt="">Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
        <section class="active section">
            <div class="content">
                <form class="profile" method="POST">
                    <div class="profile-content">
                        <div class="profile-content-1">
                            <h1>Technician & Bank Details</h1>
                            <p>Edit your account details and settings.</p>
                        </div>
                        <div class="profile-content-2">

                            <div class="input-content">
                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>technician ID</p>
                                        <input type="text" name="" disabled value="<?php echo $technician_id ?>">
                                        <!-- <p class="input-error">Please enter your first name</p> -->
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>TECHNICIAN NAME</p>
                                        <input type="text" name="" disabled value="<?php echo $first_name . " " . $last_name ?>">
                                        <!-- <p class="input-error">Please enter your first name</p> -->
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>BANK NAME</p>
                                        <input type="text" name="" disabled value="<?php echo $bank_name ?>">
                                        <!-- <p class="input-error">Please enter your date of birth</p> -->
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>BRANCH</p>
                                        <input type="text" name="" disabled value="<?php echo $branch ?>">
                                        <!-- <p class="input-error">Please enter your nic number</p> -->
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>HOLDER NAME</p>
                                        <input type="text" name="" disabled value="<?php echo $holder_name ?>">
                                        <!-- <p class="input-error">Please enter your phone number</p> -->
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>ACCOUNT NO</p>
                                        <input type="text" name="" disabled value="<?php echo $account_no ?>">
                                        <!-- <p class="input-error">Please enter your email</p> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="profile-content margin-top-20">
                        <div class="profile-content-1">
                            <h1>Payout details</h1>
                            <p>Edit your account details and settings.</p>
                        </div>
                        <div class="profile-content-2">
                            <div class="input-content">
                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>AMOUNT</p>
                                        <input type="text" name="" disabled value="<?php echo $amount ?>">
                                        <!-- <p class="input-error">Please enter your category</p> -->
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>REQUESTED DATE</p>
                                        <input type="text" name="" disabled value="<?php echo $date ?>">
                                        <!-- <p class="input-error">Please enter your cost per day</p> -->
                                    </div>

                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>REQUESTED TIME</p>
                                        <input type="text" name="" disabled value="<?php echo $time ?>">
                                        <!-- <p class="input-error">Please enter your work experience</p> -->
                                    </div>
                                </div>

                                <div class="right-button margin-top-30">
                                    <!-- <input type="submit" value="Save Change"> -->
                                    <!-- <input type="submit" value="Reject"> -->
                                    <input type="submit" value="Paid" name="paid">
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
</body>

</html>