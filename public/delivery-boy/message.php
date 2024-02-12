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
    <link rel="stylesheet" href="../assets/css/dashboard-message.css">
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
                        <div class="menu-link-button ">
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
                        <div class="menu-link-button active">
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
            <div class="message">
                <form class="message-content" method="GET">
                    <div class="message-content-1">
                        <div class="message-list-button">
                            <button id="message-list-button" type="button">
                                <i class="ri-arrow-right-s-line"></i>
                            </button>
                        </div>
                        <div class="message-list">
                            <a href=""  class="message-list-content active">
                                <div class="message-list-content-1">
                                    <img src="./images/profile.jpg" alt="">
                                </div>
                                <div class="message-list-content-2">
                                    <h3>Tharindu Kulasinghe</h3>
                                    <p>hello, how can...</p>
                                    <p>12.00pm</p>
                                </div>
                            </a>
                            <a href="" class="message-list-content ">
                                <div class="message-list-content-1">
                                    <img src="./images/profile.jpg" alt="">
                                </div>
                                <div class="message-list-content-2">
                                    <h3>Tharindu Kulasinghe</h3>
                                    <p>hello, how can...</p>
                                    <p>12.00pm</p>
                                </div>
                            </a>
                            <a href="" class="message-list-content ">
                                <div class="message-list-content-1">
                                    <img src="./images/profile.jpg" alt="">
                                </div>
                                <div class="message-list-content-2">
                                    <h3>Tharindu Kulasinghe</h3>
                                    <p>hello, how can...</p>
                                    <p>12.00pm</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="message-content-2">
                        <div class="message-input">
                            <div class="message-input-content">
                                <div class="message-input-content-1">
                                    <img src="./images/ui/image.png" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="">
                                </div>
                                <div class="message-input-content-2">
                                    <input type="text" placeholder="Type your message here" name="">
                                </div>
                                <div class="message-input-content-3">
                                    <button type="submit">
                                        <img src="./images/ui/send-plane-fill 2.png" alt="">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="all-message">
                            <div class="content">
                                <div class="all-message-content">
                                    <div class="message-receiver">
                                        <div class="message-receiver-content">
                                            <img src="./images/profile.jpg" alt="">
                                            <p>
                                                fasdf
                                            </p>

                                        </div>
                                    </div>
                                    <div class="message-send">
                                        <div class="message-send-content">
                                            <p>
                                                fasdf
                                            </p>
                                            <img src="./images/profile.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="message-send">
                                        <div class="message-send-content">
                                            <p>
                                                fasdf
                                            </p>
                                            <img src="./images/profile.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="message-send">
                                        <div class="message-send-content">
                                            <p>
                                                fasdf
                                            </p>
                                            <img src="./images/profile.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="message-receiver">
                                        <div class="message-receiver-content">
                                            <img src="./images/profile.jpg" alt="">
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi
                                                architecto distinctio quisquam vel nihil. Facere repellat eligendi
                                                praesentium omnis tenetur.
                                            </p>
                                        </div>
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
    <script src="../assets/js/message.js"></script>
</body>

</html>