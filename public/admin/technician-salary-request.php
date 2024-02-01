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
                            <a href="">
                                <p><img src="../assets/images/ui/Exit.png" alt="">Logout</p>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
            <section class="active section">
                <div class="content">
                
                    <div class="technician">
                        <form class="search-2" method="GET" action="./technicians.html">
                            <div class="search-content-1">
                                <select name="type" id="">
                                    <option value="emp">By Employee No</option>
                                </select>
                            </div>
                            <div class="search-content-2">
                                <input type="text" name="search">
                            </div>
                            <div class="search-content-3">
                                <input type="submit" class="btn" value="Search">
                                <button type="submit" class="btn-icon btn">
                                    <i class="ri-search-line"></i>
                                </button>
                            </div>
                        </form>
                        <div class="card-content  margin-top-40">
                            <div class="card-list">
                                <a href="" class="card">
                                    <div class="technician-image">
                                        <img src="./images/profile.jpg" alt="">
                                    </div>
                                    <div class="technician-name">
                                        <h3>Nimal Sankalpa</h3>
                                    </div>
                                    <div class="technician-details">
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>City</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>Colombo</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Age</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>20</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Years of experience</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>2 year</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Vehicle</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>Bike</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="card">
                                    <div class="technician-image">
                                        <img src="./images/profile.jpg" alt="">
                                    </div>
                                    <div class="technician-name">
                                        <h3>Nimal Sankalpa</h3>
                                    </div>
                                    <div class="technician-details">
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>City</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>Colombo</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Age</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>20</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Years of experience</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>2 year</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Vehicle</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>Bike</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="card">
                                    <div class="technician-image">
                                        <img src="./images/profile.jpg" alt="">
                                    </div>
                                    <div class="technician-name">
                                        <h3>Nimal Sankalpa</h3>
                                    </div>
                                    <div class="technician-details">
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>City</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>Colombo</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Age</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>20</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Years of experience</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>2 year</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Vehicle</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>Bike</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="card">
                                    <div class="technician-image">
                                        <img src="./images/profile.jpg" alt="">
                                    </div>
                                    <div class="technician-name">
                                        <h3>Nimal Sankalpa</h3>
                                    </div>
                                    <div class="technician-details">
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>City</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>Colombo</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Age</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>20</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Years of experience</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>2 year</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Vehicle</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>Bike</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="" class="card">
                                    <div class="technician-image">
                                        <img src="./images/profile.jpg" alt="">
                                    </div>
                                    <div class="technician-name">
                                        <h3>Nimal Sankalpa</h3>
                                    </div>
                                    <div class="technician-details">
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>City</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>Colombo</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Age</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>20</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Years of experience</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>2 year</p>
                                            </div>
                                        </div>
                                        <div class="technician-details-content">
                                            <div class="technician-details-content-1">
                                                <p>Vehicle</p>
                                            </div>
                                            <div class="technician-details-content-2">
                                                <p>Bike</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!-- </div> -->
    </div>

    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>