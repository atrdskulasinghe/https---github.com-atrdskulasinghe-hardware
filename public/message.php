<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="./assets/css/style.css"> -->
    <!-- <link rel="stylesheet" href="./assets/css/style/dashboard-menu.css"> -->
    <!-- <link rel="stylesheet" href="./assets/css/style/dashboard-nav.css"> -->
    <!-- <link rel="stylesheet" href="./assets/css/style/card.css"> -->
    <!-- <link rel="stylesheet" href="./assets/css/style/button.css"> -->
    <!-- <link rel="stylesheet" href="./assets/css/style/search.css"> -->
    <!-- <link rel="stylesheet" href="./assets/css/style/stars.css"> -->
    <!-- <link rel="stylesheet" href="./assets/css/style/review.css"> -->
    <link rel="stylesheet" href="./assets/css/dashboard-message.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />



    <link rel="stylesheet" href="./assets/css/user-nav-1.css">
    <link rel="stylesheet" href="./assets/css/user-nav-2.css">
    <link rel="stylesheet" href="./assets/css/user-menu.css">
    <link rel="stylesheet" href="./assets/css/user-search-bar.css">
    <link rel="stylesheet" href="./assets/css/user-footer.css">
    <link rel="stylesheet" href="./assets/css/user-style.css">
    <link rel="stylesheet" href="./assets/css/button.css">
    <link rel="stylesheet" href="./assets/css/user-contact.css">
    <link rel="stylesheet" href="./assets/css/input.css"> 
</head>

<body>
    <div class="container">
        <!-- navigation -->
         <?php

        include "../template/user-nav.php";

        ?>
        <?php
        include "../template/user-menu.php";
        ?>
        <!-- <div class="content"> -->
        
        <section class=" section active" style="margin:0; position:relative; top:-80px; z-index:1;">
            <!-- <div class="content"> -->
            <div class="message">
                <form class="message-content active" method="GET" style="width: calc(100% - 440px);">
                    <div class="message-content-1">
                        <div class="message-list-button" style="display: none;">
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
                                    <input type="file" id="file-input">
                                </div>
                                <div class="message-input-content-2">
                                    <input type="text" placeholder="Type your message here">
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
            <!-- </div> -->
        </section>
        <!-- </div> -->
    </div>

    <script src="./components/javascript/dashboard-menu.js"></script>
    <script src="./components/javascript/script.js"></script>
    <script src="./components/javascript/message.js"></script>
</body>

</html>