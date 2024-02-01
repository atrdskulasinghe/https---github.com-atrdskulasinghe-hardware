<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard-menu.css">
    <link rel="stylesheet" href="../assets/css/dashboard-nav.css">
    <link rel="stylesheet" href="../assets/css/dashboard-delivery-request.css">
    <link rel="stylesheet" href="../assets/css/button.css">
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
                         <div class="menu-link-button active">
                            <a href="./booking.php">
                                <p><img src="../assets/images/ui/booking.png" alt="">Booking</p>
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
                <div class="request">
                    <form class="request-content">
                        <div class="request-content-1">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.58638705265!2d79.77380226425713!3d6.922001982789133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!5e0!3m2!1sen!2slk!4v1706353312772!5m2!1sen!2slk" frameborder="0"></iframe>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad quos porro cumque ab
                                voluptatem ipsa quidem repudiandae, fuga ullam aperiam? Pariatur voluptates
                                nobis quibusdam suscipit nesciunt doloribus dignissimos sunt fuga enim? Earum
                                ipsa quasi ducimus quod quisquam! Dolorem, culpa possimus, itaque officia odit
                                ad aliquid impedit molestias quasi inventore quia!</p>
                        </div>
                        <div class="request-content-2">
                            <div class="request-profile">
                                <div class="request-profile-content-1">
                                    <img src="../assets/images/ui/booking.png" alt="">
                                    
                                </div>
                                <div class="request-profile-content-2">
                                    <h4>Tharindu Ruchiranga</h4>
                                </div>
                            </div>
                            <div class="request-details">
                                <div class="request-details-content-1">
                                    <p>Date</p>
                                </div>
                                <div class="request-details-content-2">
                                    <p>2023/08/24</p>
                                </div>
                            </div>
                            <div class="request-details">
                                <div class="request-details-content-1">
                                    <p>Time</p>
                                </div>
                                <div class="request-details-content-2">
                                    <p>10.24am</p>
                                </div>
                            </div>
                            <div class="request-details">
                                <div class="request-details-content-1">
                                    <p>Phone Number</p>
                                </div>
                                <div class="request-details-content-2">
                                    <p>0775200106</p>
                                </div>
                            </div>
                            <div class="request-details">
                                <div class="request-details-content-1">
                                    <p>Address</p>
                                </div>
                                <div class="request-details-content-2">
                                    <p>Abillawatta, <br>Boralasgamuwa, <br>Colombo</p>
                                </div>
                            </div>
                            
                            <div class="request-button">
                                <button type="submit" class="btn">Contact</button>
                                <button type="submit" class="btn">Accept</button>
                                <button type="submit" class="btn">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <form class="request-content">
                        <div class="request-content-1">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.58638705265!2d79.77380226425713!3d6.922001982789133!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!5e0!3m2!1sen!2slk!4v1706353312772!5m2!1sen!2slk" frameborder="0"></iframe>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad quos porro cumque ab
                                voluptatem ipsa quidem repudiandae, fuga ullam aperiam? Pariatur voluptates
                                nobis quibusdam suscipit nesciunt doloribus dignissimos sunt fuga enim? Earum
                                ipsa quasi ducimus quod quisquam! Dolorem, culpa possimus, itaque officia odit
                                ad aliquid impedit molestias quasi inventore quia!</p>
                        </div>
                        <div class="request-content-2">
                            <div class="request-profile">
                                <div class="request-profile-content-1">
                                    <img src="../assets/images/ui/booking.png" alt="">
                                    
                                </div>
                                <div class="request-profile-content-2">
                                    <h4>Tharindu Ruchiranga</h4>
                                </div>
                            </div>
                            <div class="request-details">
                                <div class="request-details-content-1">
                                    <p>Date</p>
                                </div>
                                <div class="request-details-content-2">
                                    <p>2023/08/24</p>
                                </div>
                            </div>
                            <div class="request-details">
                                <div class="request-details-content-1">
                                    <p>Time</p>
                                </div>
                                <div class="request-details-content-2">
                                    <p>10.24am</p>
                                </div>
                            </div>
                            <div class="request-details">
                                <div class="request-details-content-1">
                                    <p>Phone Number</p>
                                </div>
                                <div class="request-details-content-2">
                                    <p>0775200106</p>
                                </div>
                            </div>
                            <div class="request-details">
                                <div class="request-details-content-1">
                                    <p>Address</p>
                                </div>
                                <div class="request-details-content-2">
                                    <p>Abillawatta, <br>Boralasgamuwa, <br>Colombo</p>
                                </div>
                            </div>
                            
                            <div class="request-button">
                                <button type="submit" class="btn">Contact</button>
                                <button type="submit" class="btn">Accept</button>
                                <button type="submit" class="btn">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- </div> -->
    </div>

    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>