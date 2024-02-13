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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
    <?php
        include "../../config/database.php";
        include "../../template/user-data.php";

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
                    <div class="menu-header">
                        <h1>Logo</h1>
                        <div class="menu-close">
                            <i class="ri-close-line " id="menu-header-icon"></i>
                        </div>
                    </div>
                    <div class="menu-content">
                        <div class="menu-links">
                            <!-- menu link 1 -->
                            <div class="menu-link-button active">
                                <a href="./index.php">
                                    <p><img src="../assets/images/ui/dashboard.png" alt="">Dashboard</p>
                                </a>
                            </div>
                            <!-- menu link 2 -->
                            <div class="menu-link-button-2">
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
                            <!-- menu link 1
                            <div class="menu-link-button">
                                <a href="./index.php">
                                    <p><img src="../assets/images/ui/admin.png" alt="">Admin</p>
                                </a>
                            </div> -->
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
                
            </section>
        <!-- </div> -->
    </div>

    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>