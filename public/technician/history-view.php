<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard-menu.css">
    <link rel="stylesheet" href="../assets/css/dashboard-nav.css">
    <link rel="stylesheet" href="../assets/css/dashboard-history-view.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/line-2.css">
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
                         <div class="menu-link-button">
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
                        <div class="menu-link-button active">
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
                <div class="history">
                    <div class="history-details-1">
                        <p>Date : Dec 30, 2023</p>
                        <p>Delivery ID: #234324</p>
                        <p>Status: Accept</p>
                    </div>
                    <div class="history-details-2">
                        <div class="line-content">
                            <div class="line-all-content">
                                <div class="line-circle line-circle-1 active">
                                    <i class="ri-check-line"></i>
                                    <h4>Booking Confirmed</h4>
                                </div>
                                <div class="line line-1 active"></div>
                                <div class="line-circle line-circle-2 active">
                                    <i class="ri-check-line"></i>
                                    <h4>Accept</h4>
                                </div>
                                <div class="line  line-2 active"></div>
                                <div class="line-circle line-circle-3 active">
                                    <i class="ri-check-line"></i>
                                    <h4>Started</h4>
                                </div>
                                <div class="line  line-3 active"></div>
                                <div class="line-circle line-circle-4 active">
                                    <i class="ri-check-line"></i>
                                    <h4>Finished</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="history-details-3">
                        <div class="history-details-3-content-1">
                            <h4>Date</h4>
                            <p>14 Dec 2023</p>
                            <h4>Total Amount</h4>
                            <p>LKR. 2000</p>
                        </div>
                        <div class="history-details-3-content-2">
                            <div>
                                <h4>Payment Status</h4>
                                <p>pending</p>
                                <h4>Delivery Fee</h4>
                                <p>LKR. 2000</p>
                            </div>
                        </div>
                        <div class="history-details-3-content-3">
                            <div>
                                <h4>Payment Method</h4>
                                <p>Card</p>
                            </div>
                        </div>
                    </div>
                    <div class="input-content">
                        <div class="right-button margin-top-30">
                            <input type="submit" value="Contact" name="">
                            <input type="submit" value="Location" name="">
                            <input type="submit" value="Finish" name="">
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