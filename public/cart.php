<?php
include "../config/database.php";

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        // header('location: index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ./cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        header('location: ./technician/index.php');
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        header('location: ./delivery-doy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        header('location: ./admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ./technical-team/index.php');
    }
}else{
    header('location: ./login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="./assets/css/user-nav-1.css">
    <link rel="stylesheet" href="./assets/css/user-nav-2.css">
    <link rel="stylesheet" href="./assets/css/user-menu.css">
    <link rel="stylesheet" href="./assets/css/user-search-bar.css">
    <link rel="stylesheet" href="./assets/css/user-footer.css">
    <link rel="stylesheet" href="./assets/css/user-style.css">
    <link rel="stylesheet" href="./assets/css/user-cart.css">
    <link rel="stylesheet" href="./assets/css/button.css">
</head>

<body>
    <div class="container">
        <?php

        include "../template/user-nav.php";

        ?>
                <?php
            include "../template/user-menu.php";
        ?>
        <section>
            <div class="user-cart">
                <div class="box">
                    <div class="user-cart-content">
                        <div class="user-cart-content-1">
                            <h3>My Cart</h3>
                            <div class="user-cart-product">
                                <div class="cart-product-1">
                                    <div class="cart-product-1-1">
                                        <img src="./assets/images/ui/admin.png" alt="">
                                    </div>
                                    <div class="cart-product-1-2">
                                        <div class="cart-product-1-2-1">
                                            <p>16 Color Changing B22 RGB LED Magic Light Bulb with Remote</p>
                                        </div>
                                        <div class="cart-product-1-2-2">
                                            <div class="cart-q">
                                                <input type="submit" value="-">
                                                <input type="text" value="1" disabled>
                                                <input type="submit" value="+">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-product-2">
                                    <div class="cart-product-1-2-1">
                                        <p>2500LKR</p>
                                    </div>
                                    <div class="cart-product-1-2-2">
                                        <p>
                                            <a href="f"><i class="ri-delete-bin-line"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="user-cart-product">
                                <div class="cart-product-1">
                                    <div class="cart-product-1-1">
                                        <img src="./assets/images/ui/admin.png" alt="">
                                    </div>
                                    <div class="cart-product-1-2">
                                        <div class="cart-product-1-2-1">
                                            <p>16 Color Changing B22 RGB LED Magic Light Bulb with Remote</p>
                                        </div>
                                        <div class="cart-product-1-2-2">
                                            <div class="cart-q">
                                                <input type="submit" value="-">
                                                <input type="text" value="1" disabled>
                                                <input type="submit" value="+">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-product-2">
                                    <div class="cart-product-1-2-1">
                                        <p>2500LKR</p>
                                    </div>
                                    <div class="cart-product-1-2-2">
                                        <p>
                                            <a href="f"><i class="ri-delete-bin-line"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="user-cart-content-2">
                            <h3 style="font-family: sans-serif">Order Summery</h3>
                            <div class="cart-order">
                                <div class="cart-order-content-1">
                                    <p>Subtotal</p>
                                    <p>Delivery Fee</p>
                                    <h4>Total</h4>
                                </div>
                                <div class="cart-order-content-2">
                                    <p>2500LKR</p>
                                    <p>2500LKR</p>
                                    <h4>2500LKR</h4>
                                </div>
                            </div>
                            <input type="submit" class="btn" value="Checkout">
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>
</body>

</html>