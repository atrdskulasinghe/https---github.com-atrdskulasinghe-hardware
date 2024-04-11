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

$currentDate = date("Y-m-d");
$currentTime = date("H:i:s");

$user_id = 2;
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

$delivery_boy_id = $bank_details_id = $bank_name = $branch = $holder_name = $account_no = $balance = $request_amount = "";
$delivery_boy_idError = $bank_details_idError = $bank_nameError = $branchError = $holder_nameError = $account_noError = $balanceError = $request_amountError = "";


$selectUserQuery = "SELECT * FROM `delivery_boy` WHERE `user_id` = $user_id";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $delivery_boy_id = $row['delivery_boy_id'];
    $balance = $row['balance'];
}

$selectUserQuery = "SELECT * FROM `bank_details` WHERE `user_id` = $user_id";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $bank_details_id = $row['bank_details_id'];
    $bank_name = $row['bank_name'];
    $branch = $row['branch'];
    $holder_name = $row['holder_name'];
    $account_no = $row['account_no'];
}

if (isset($_POST['request'])) {

    $bank_name = $_POST['bank_name'];
    $branch = $_POST['branch'];
    $holder_name = $_POST['holder_name'];
    $account_no = $_POST['account_no'];
    $request_amount = $_POST['request_amount'];

    $selectUserQuery = "SELECT * FROM `bank_details` WHERE `user_id` = $user_id";
    $result = $conn->query($selectUserQuery);

    if ($result->num_rows > 0) {

        if (empty($bank_name)) {
            $bank_nameError = "Please enter your bank name";
        }

        if (empty($branch)) {
            $branchError = "Please enter your branch";
        }

        if (empty($holder_name)) {
            $holder_nameError = "Please enter the account holder name";
        }

        if (empty($account_no)) {
            $account_noError = "Please enter your account number";
        }

        if ((float)$request_amount > (float)$balance) {
            $request_amountError = "Request amount cannot exceed the available balance";
        }

        if ((float)$request_amount < 100) {
            $request_amountError = "Minimum request amount is 100";
        }

        if (empty($request_amount)) {
            $request_amountError = "Please enter the request amount";
        }

        if (empty($bank_nameError) && empty($branchError) && empty($holder_nameError) && empty($account_noError) && empty($request_amountError)) {

            $now_balance = (float)$balance - (float)$request_amount;

            $updateCurrentBalanceQuery = "UPDATE `delivery_boy` SET 
                `balance`= '$now_balance'
                WHERE `user_id` = $user_id";

            if ($conn->query($updateCurrentBalanceQuery) === TRUE) {

                $updateBankDetailsQuery = "UPDATE `bank_details` SET 
                        `bank_name`='$bank_name',
                        `branch`='$branch',
                        `holder_name`='$holder_name',
                        `account_no`='$account_no'
                        WHERE `user_id` = $user_id";

                if ($conn->query($updateBankDetailsQuery) === TRUE) {


                    $paymentQuery = "INSERT INTO `payment`(`user_id`, `date`, `time`, `amount`, `status`) VALUES 
                    ('$user_id','$currentDate','$currentTime','$request_amount','pending')";

                    if ($conn->query($paymentQuery) === TRUE) {
                        header('location: wallet.php');
                    }
                }
            }
        }



        // request_amount
    } else {

        $bank_name = $_POST['bank_name'];
        $branch = $_POST['branch'];
        $holder_name = $_POST['holder_name'];
        $account_no = $_POST['account_no'];
        $request_amount = $_POST['request_amount'];

        if (empty($bank_name)) {
            $bank_nameError = "Please enter your bank name";
        }

        if (empty($branch)) {
            $branchError = "Please enter your branch";
        }

        if (empty($holder_name)) {
            $holder_nameError = "Please enter the account holder name";
        }

        if (empty($account_no)) {
            $account_noError = "Please enter your account number";
        }

        if ((float)$request_amount > (float)$balance) {
            $request_amountError = "Request amount cannot exceed the available balance";
        }

        if ((float)$request_amount < 100) {
            $request_amountError = "Minimum request amount is 100";
        }

        if (empty($request_amount)) {
            $request_amountError = "Please enter the request amount";
        }

        if (empty($bank_nameError) && empty($branchError) && empty($holder_nameError) && empty($account_noError) && empty($request_amountError)) {

            $updateBankDetailsQuery = "INSERT INTO `bank_details`(`user_id`, `bank_name`, `branch`, `holder_name`, `account_no`) VALUES 
            ('$user_id','$bank_name','$branch','$holder_name','$account_no')";

            if ($conn->query($updateBankDetailsQuery) === TRUE) {

                $now_balance = (float)$balance - (float)$request_amount;

                $updateCurrentBalanceQuery = "UPDATE `technician` SET 
                `balance`='$now_balance'
                WHERE `user_id` = $user_id";

                if ($conn->query($updateCurrentBalanceQuery) === TRUE) {

                    $paymentQuery = "INSERT INTO `payment`(`user_id`, `date`, `time`, `amount`, `status`) VALUES 
                    ('$user_id','$currentDate','$currentTime','$request_amount','pending')";

                    if ($conn->query($paymentQuery) === TRUE) {
                        header('location: wallet.php');
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
                        <div class="menu-link-button">
                            <a href="./wallet.php">
                                <p><img src="../assets/images/ui/Wallet.png" alt="">My Wallet</p>
                            </a>
                        </div>

                        <!-- menu link 1 -->
                        <div class="menu-link-button active">
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
                        <div class="menu-link-button">
                            <a href="./message.php">
                                <p><img src="../assets/images/ui/messages.png" alt="">Messages</p>
                            </a>
                        </div>

                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./history.php">
                                <p><img src="../assets/images/ui/history.png" alt="">History</p>
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
                <form class="profile" method="POST">
                    <div class="profile-content">
                        <div class="profile-content-1">
                            <h1>Technician & Bank Details</h1>
                            <p>Edit your account details and settings.</p>
                        </div>
                        <div class="profile-content-2">

                            <div class="input-content">
                                <div class="input-one-content">
                                    <!-- <div class="input-one-content-1"> -->
                                    <p>Current Amount</p>
                                    <input type="text" name="" disabled value="<?php echo "LKR." . $balance ?>">
                                    <p class="input-error"><?php echo $balanceError ?></p>
                                    <!-- </div> -->

                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>BANK NAME</p>
                                        <input type="text" name="bank_name" value="<?php echo $bank_name ?>">
                                        <p class="input-error"><?php echo $bank_nameError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>BRANCH</p>
                                        <input type="text" name="branch" value="<?php echo $branch ?>">
                                        <p class="input-error"><?php echo $branchError ?></p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>HOLDER NAME</p>
                                        <input type="text" name="holder_name" value="<?php echo $holder_name ?>">
                                        <p class="input-error"><?php echo $holder_nameError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>ACCOUNT NO</p>
                                        <input type="text" name="account_no" value="<?php echo $account_no ?>">
                                        <p class="input-error"><?php echo $account_noError ?></p>
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
                                        <p>Request amount (lkr)</p>
                                        <input type="text" name="request_amount" value="<?php echo $request_amount ?>">
                                        <p class="input-error"><?php echo $request_amountError ?></p>
                                    </div>

                                </div>

                                <div class="right-button margin-top-30">
                                    <!-- <input type="submit" value="Save Change"> -->
                                    <!-- <input type="submit" value="Reject"> -->
                                    <input type="submit" value="Request" name="request">
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