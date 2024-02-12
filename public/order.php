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
    <link rel="stylesheet" href="./assets/css/input.css">
    <link rel="stylesheet" href="./assets/css/user-order.css">

    <link rel="stylesheet" href="./assets/css/signup.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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
            <div class="box">
                <div class="order-content">
                    <div class="order-content-1">
                        <div class="input-content">
                            <div class="input-one-content">
                                <p>First Name</p>
                                <input type="text">
                                <p class="input-error">please enter your first name</p>
                            </div>
                            <div class="input-one-content">
                                <p>Last Name</p>
                                <input type="text">
                                <p class="input-error">please enter your first name</p>
                            </div>
                            <div class="input-one-content">
                                <p>Email Address</p>
                                <input type="text">
                                <p class="input-error">please enter your first name</p>
                            </div>
                            <div class="input-one-content">
                                <p>Phone Number</p>
                                <input type="text">
                                <p class="input-error">please enter your first name</p>
                            </div>

                            <div class="input-one-content">
                                <p>Payment Method</p>
                                <select name="" id="">
                                    <option value="">Cash On Delivery</option>
                                    <option value="">Card Payment</option>
                                </select>
                                <p class="input-error">please enter your first name</p>
                            </div>

                            <div class="input-one-content">
                                <p>House Number</p>
                                <input type="text">
                                <p class="input-error">please enter your first name</p>
                            </div>

                            <div class="input-one-content">
                                <p>House Number</p>
                                <input type="text">
                                <p class="input-error">please enter your first name</p>
                            </div>

                            <div class="input-one-content">
                                <p>state</p>
                                <input type="text">
                                <p class="input-error">please enter your first name</p>
                            </div>

                            <div class="input-one-content">
                                <p>city</p>
                                <input type="text">
                                <p class="input-error">please enter your first name</p>
                            </div>

                            <div class="input-one-content">
                                <p>Select Location</p>
                                <div id="map"></div>
                                <p class="input-error"><?php echo $latitudeError ?></p>
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                            </div>

                            <!-- <div class="input-one-content">
                                <p>Last Name</p>
                                <textarea name="" id="" cols="30" rows="10"></textarea>
                                <p class="input-error">please enter your first name</p>
                            </div> -->
                            <!-- <div class="right-button">
                                <input type="submit">
                            </div> -->
                        </div>
                    </div>
                    <div class="order-content-2">
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

                        <div class="summery">
                            <!-- <div class="user-cart-content-2"> -->
                            <!-- <h3>Order Summery</h3> -->
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
                            <!-- </div> -->
                        </div>

                        <div class="input-content margin-top-20">
                            <div class="right-button">
                                <input type="submit" value="Place Order">
                            </div>
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
    <script>
        var map = L.map('map').setView([<?php
                                        if (isset($_SESSION['latitude'])) {
                                            echo $_SESSION['latitude'];
                                        } else {
                                            echo 6.9271;
                                        } ?>, <?php
                                                if (isset($_SESSION['longitude'])) {
                                                    echo $_SESSION['longitude'];
                                                } else {
                                                    echo 79.8612;
                                                } ?>], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        var marker;
        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = new L.Marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
        });
    </script>
</body>

</html>