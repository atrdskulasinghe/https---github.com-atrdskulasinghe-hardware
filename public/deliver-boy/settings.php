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
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./delivery-request.php">
                                <p><img src="../assets/images/ui/Product.png" alt="">Delivery Request</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./calender.php">
                                <p><img src="../assets/images/ui/Calendar.png" alt="">Calendar</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./wallet.php">
                                <p><img src="../assets/images/ui/Wallet.png" alt="">My Wallet</p>
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
                                    <h2>AVATAR</h2>
                                    <img src="./images/profile.jpg" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="">
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="submit" class="btn" value="Choose Photo" id="file-button" name="">
                                </div>
                            </div>
                            <div class="input-content">
                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>First Name</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your first name</p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>Last Name</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your first name</p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>DATE OF BIRTH</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your date of birth</p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>NIC NUMBER</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your nic number</p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>PHONE NUMBER</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your phone number</p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>EMAIL</p>
                                        <input type="text">
                                        <p class="input-error">Please enter your email</p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>HOUSE NUMBER</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your house number</p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>STATE</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your state</p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>CITY</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your city</p>
                                    </div>
                                </div>

                                <div class="input-one-content">
                                    <p>BIO / DESCRIPTION</p>
                                    <textarea name="" id="" cols="30" rows="10"></textarea>
                                    <p class="input-error">Please enter your first name</p>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="profile-content margin-top-20">
                        <div class="profile-content-1">
                            <h1>Personal Information</h1>
                            <p>Edit your account details and settings.</p>
                        </div>
                        <div class="profile-content-2">

                            <div class="input-content">
                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>NIC NUMBER</p>
                                        <input type="text" name="">
                                        <p class="input-error">Please enter your first name</p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>NIC PHOTO</p>
                                        <div class="profile-nic">
                                            <img src="" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="right-button margin-top-30">
                                    <input type="submit" value="Contact" name="">
                                    <input type="submit" value="Suspend Account" name="">
                                    <input type="submit" value="Save Change" name="">
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