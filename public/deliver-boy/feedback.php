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
                        <div class="menu-link-button active">
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

                <div class="review">
                    <div class="review-content">
                        <h3>Ratings & Reviews</h3>
                        <div class="review-header">
                            <div class="review-header-content-1">
                                <h1>5.0/<span>5</span></h1>
                                <div class="stars large">
                                    <ul>
                                        <li>
                                            <i class="ri-star-fill active"></i>
                                        </li>
                                        <li>
                                            <i class="ri-star-fill active"></i>
                                        </li>
                                        <li>
                                            <i class="ri-star-fill active"></i>
                                        </li>
                                        <li>
                                            <i class="ri-star-fill active"></i>
                                        </li>
                                        <li>
                                            <i class="ri-star-fill"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="reivew-header-content-1-rating">
                                    <p>3 Ratings</p>
                                </div>
                            </div>
                            <div class="review-header-content-2">
                                <div class="review-header-review-line">
                                    <div class="review-header-review-line-content">
                                        <div class="stars small margin-top-0">
                                            <ul>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="review-line-background">
                                            <div class="review-line"></div>
                                        </div>
                                        <div class="review-count">
                                            <p>120</p>
                                        </div>
                                    </div>
                                    <div class="review-header-review-line-content">
                                        <div class="stars small margin-top-0">
                                            <ul>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill visibility-hidden"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="review-line-background">
                                            <div class="review-line"></div>
                                        </div>
                                        <div class="review-count">
                                            <p>120</p>
                                        </div>
                                    </div>
                                    <div class="review-header-review-line-content">
                                        <div class="stars small margin-top-0">
                                            <ul>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active "></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active visibility-hidden"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill visibility-hidden"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="review-line-background">
                                            <div class="review-line"></div>
                                        </div>
                                        <div class="review-count">
                                            <p>120</p>
                                        </div>
                                    </div>
                                    <div class="review-header-review-line-content">
                                        <div class="stars small margin-top-0">
                                            <ul>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active visibility-hidden"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active visibility-hidden"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill visibility-hidden"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="review-line-background">
                                            <div class="review-line"></div>
                                        </div>
                                        <div class="review-count">
                                            <p>120</p>
                                        </div>
                                    </div>
                                    <div class="review-header-review-line-content">
                                        <div class="stars small margin-top-0">
                                            <ul>
                                                <li>
                                                    <i class="ri-star-fill active"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active visibility-hidden"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active visibility-hidden"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill active visibility-hidden"></i>
                                                </li>
                                                <li>
                                                    <i class="ri-star-fill visibility-hidden"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="review-line-background">
                                            <div class="review-line"></div>
                                        </div>
                                        <div class="review-count">
                                            <p>120</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="review-feedback">
                            <div class="feedback-content">
                                <div class="feedback-content-1">
                                    <div class="stars">
                                        <ul>
                                            <li>
                                                <i class="ri-star-fill active"></i>
                                            </li>
                                            <li>
                                                <i class="ri-star-fill active"></i>
                                            </li>
                                            <li>
                                                <i class="ri-star-fill active"></i>
                                            </li>
                                            <li>
                                                <i class="ri-star-fill active"></i>
                                            </li>
                                            <li>
                                                <i class="ri-star-fill"></i>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="feedback-name">by Dinusha S.</p>
                                    <div class="feedback-images">
                                        <img src="" alt="">
                                        <img src="" alt="">
                                        <img src="" alt="">
                                        <img src="" alt="">
                                    </div>
                                </div>
                                <div class="feedback-content-2">
                                    <p>1 Year Ago</p>
                                </div>
                            </div>
                            <div class="feedback-content">
                                <div class="feedback-content-1">
                                    <div class="stars">
                                        <ul>
                                            <li>
                                                <i class="ri-star-fill active"></i>
                                            </li>
                                            <li>
                                                <i class="ri-star-fill active"></i>
                                            </li>
                                            <li>
                                                <i class="ri-star-fill active"></i>
                                            </li>
                                            <li>
                                                <i class="ri-star-fill active"></i>
                                            </li>
                                            <li>
                                                <i class="ri-star-fill"></i>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="feedback-name">by Dinusha S.</p>
                                    <div class="feedback-images">
                                        <img src="" alt="">
                                        <img src="" alt="">
                                        <img src="" alt="">
                                        <img src="" alt="">
                                    </div>
                                </div>
                                <div class="feedback-content-2">
                                    <p>1 Year Ago</p>
                                </div>
                            </div>
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