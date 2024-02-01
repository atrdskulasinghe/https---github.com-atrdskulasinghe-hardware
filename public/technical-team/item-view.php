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
                                <div class="menu-link-button menu-hidden-button active">
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
                <form class="profile">
                    <div class="profile-content">
                        <div class="profile-content-1">
                            <h1>Basic Information</h1>
                            <p>Edit your account details and settings.</p>
                        </div>
                        <div class="profile-content-2">
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>MAIN IMAGE</h2>
                                    <img src="./images/profile.jpg" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="">
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button" name="">
                                </div>
                            </div>
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>IMAGE 2</h2>
                                    <img src="./images/profile.jpg" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="">
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button" name="">
                                </div>
                            </div>
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>IMAGE 3</h2>
                                    <img src="./images/profile.jpg" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="">
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button" name="">
                                </div>
                            </div>
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>IMAGE 4</h2>
                                    <img src="./images/profile.jpg" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="">
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button" name="">
                                </div>
                            </div>
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>IMAGE 5</h2>
                                    <img src="./images/profile.jpg" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="">
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button" name="">
                                </div>
                            </div>
                            <div class="input-content">
                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>ITEM NAME</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your first name</p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>ITEM CATEGORY</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your first name</p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>PRICE</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your date of birth</p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>QUANTITY</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your nic number</p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>CREATION DATE</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your phone number</p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>EXPIRATION DATE</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your email</p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>BRAND</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your house number</p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>DISCOUNT</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your state</p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>WATTANTY</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your city</p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>WEIGHT</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your state</p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>MANUFACTURER</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your city</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-content margin-top-20">
                        <div class="profile-content-1">
                            <h1>Profile Information</h1>
                            <p>Edit your account details and settings.</p>
                        </div>
                        <div class="profile-content-2">
                            <div class="input-content " style="margin: 0 !important;">
                                <div class="input-one-content ">
                                    <p>DESCRIPTION</p>
                                    <textarea name="" id="" cols="30" rows="10"></textarea>
                                    <p class="input-error">Please enter your first name</p>
                                </div>
                                <!-- <div class="input-one-content">
                                    <p>KEYWORDS</p>
                                    <input type="text">
                                    <p class="input-error">please enter your first name</p>
                                </div>
                                 -->
                                 <div class="input-content">
                                    <div class="right-button margin-top-30">
                                        <input type="submit" value="Save Change" name="">
                                        <input type="submit" value="Delete" name="">
                                        <!-- <input type="submit" value="Approve"> -->
                                    </div>
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