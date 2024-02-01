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
                        <div class="menu-link-button-2 active">
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

                                <div class="menu-link-button menu-hidden-button active">
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
        <section class="active section" style="padding-bottom: 60px">
            <div class="content">
                <form class="search-2 margin-top-40" method="GET" action="./technician-category.html">
                    <div class="search-content-1">
                        <select name="type" id="">
                            <option value="emp">By Category No</option>
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

            </div>
            <div class="content margin-top-40">

                <form class="profile-content">
                    <div class="profile-content-1">
                        <h1>Basic Information</h1>
                        <p>Edit your account details and settings.</p>
                    </div>
                    <div class="profile-content-2">
                        <div class="input-content">

                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>CATEGORY IMAGE</h2>
                                    <img src="./images/profile.jpg" alt="" id="preview-image">
                                    <input type="file" id="file-input">
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button">
                                </div>
                            </div>

                            <div class="input-one-content">
                                <p>NAME</p>
                                <input type="text" value="">
                                <p class="input-error">please enter your first name</p>
                            </div>

                            <div class="input-one-content margin-top-20">
                                <p>Description</p>
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                                <p class="input-error">please enter your first name</p>
                            </div>
                            <div class="right-button">
                                <!-- <input type="submit"> -->
                                <input type="submit" value="Delete">
                                <input type="submit" value="Save Change">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="content margin-top-40">
                <!-- <h4 style="font-family: var(--main-font-family); color:var(--text-color)">Add New Category</h4> -->
                <form class="profile-content margin-top-20">

                    <div class="profile-content-1">
                        <h1>Add New Category</h1>
                        <p>Edit your account details and settings.</p>
                    </div>
                    <div class="profile-content-2">

                        <div class="input-content">

                            <div class="input-one-content">
                                <p>Category ID</p>
                                <input type="text" value="">
                                <p class="input-error">please enter your first name</p>
                            </div>

                            <div class="input-one-content">
                                <p>Name</p>
                                <input type="text" value="">
                                <p class="input-error">please enter your first name</p>
                            </div>

                            <div class="input-one-content">
                                <p>Description</p>
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                                <p class="input-error">please enter your first name</p>
                            </div>
                            <div class="right-button">
                                <!-- <input type="submit"> -->
                                <!-- <input type="submit"> -->
                                <input type="submit" value="Save">
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