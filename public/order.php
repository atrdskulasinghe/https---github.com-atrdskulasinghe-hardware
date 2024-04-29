<?php

session_start();

include "../config/database.php";
include "../template/user-data.php";


if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        // header('location: index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ./cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        header('location: ./technician/index.php');
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        header('location: ./delivery-boy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        header('location: ./admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ./technical-team/index.php');
    }
} else {
    header('location: ./login.php');
}

$item_id = "";
$quantityParam = "";

if (isset($_GET['cart']) || isset($_GET['item_id'])) {
    if (isset($_GET['item_id'])) {
        if (!empty($_GET['item_id'])) {
            if (isset($_GET['quantity'])) {
                if (!empty($_GET['quantity'])) {
                    $item_id = $_GET['item_id'];
                    $quantityParam = $_GET['quantity'];
                } else {
                    header('location: ./cart.php');
                }
            } else {
                header('location: ./cart.php');
            }
        } else {
            header('location: ./cart.php');
        }
    }
} else {
    header('location: ./cart.php');
}

$user_id = $_SESSION['id'];
$all_item_total_amount = 0;
$item_count = 0;

$first_name_error = '';
$last_name_error = '';
$email_error = '';
$phone_number_error = '';
$dob_error = '';
$house_no_error = '';
$state_error = '';
$city_error = '';
$account_type_error = '';
$profile_url_error = '';
$password_error = '';
$latitude_error = '';

if (isset($_POST['order'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $payment_method = $_POST['payment_method'];
    $house_no = $_POST['house_no'];
    $state = $_POST['state'];
    $city = $_POST['city'];

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    if (empty($first_name)) {
        $first_name_error = "Please enter your First name.";
    }

    if (empty($last_name)) {
        $last_name_error = "Please enter your Last name.";
    }

    if (empty($_POST['phone_number'])) {
        $phone_number_error = 'Please enter your phone number';
    }

    if (empty($_POST['house_no'])) {
        $house_no_error = 'Please enter your house number';
    }

    if (empty($_POST['state'])) {
        $state_error = 'Please enter your state';
    }

    if (empty($_POST['city'])) {
        $city_error = 'Please enter your city';
    }

    if (empty($_POST['latitude'])) {
        $latitude_error = 'Please select your location';
    }


    if (
        empty($first_name_error) && empty($last_name_error) && empty($phone_number_error)
        && empty($house_no_error) && empty($state_error) && empty($city_error)
        && empty($latitude_error)
    ) {

        $selectOrdersId = "SELECT `order_id` FROM `orders` ORDER BY `order_id` DESC LIMIT 1";
        $result = $conn->query($selectOrdersId);
        $lastOrderId = "1";
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastOrderId = $row['order_id'] + 1;
        }

        // card payment

        if ($payment_method == "card") {

            $_SESSION['order_id'] = $lastOrderId;
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $user_email;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['payment_method'] = $payment_method;
            $_SESSION['house_no'] = $house_no;
            $_SESSION['state'] = $state;
            $_SESSION['city'] = $city;
            $_SESSION['latitude'] = $latitude;
            $_SESSION['longitude'] = $longitude;

            $_SESSION['item_id'] = $item_id;
            $_SESSION['quantityParam'] = $quantityParam;

            if (isset($_GET['cart'])) {
                $_SESSION['cart'] = "true";
            } else {
                $_SESSION['one-item'] = "true";
            }


            header('location: ./payment.php');
        } else {

            $order_success = false;

            $deliveryBoyId = 1;

            $selectLastDeliveryBoyIdQuery = "SELECT `delivery_boy_id` FROM `delivery` ORDER BY `delivery_id` DESC LIMIT 1";
            $resultLastDeliveryBoyId = $conn->query($selectLastDeliveryBoyIdQuery);

            if ($resultLastDeliveryBoyId->num_rows > 0) {
                $lastDeliveryBoyIdData = $resultLastDeliveryBoyId->fetch_assoc();

                $lastDeliveryBoyId = $lastDeliveryBoyIdData['delivery_boy_id'];
                $lastDeliveryBoyId += 1;

                $selectCartItemQuery1 = "SELECT * FROM `delivery_boy` WHERE `delivery_boy_id` = '$lastDeliveryBoyId'";
                $resultCartItem = $conn->query($selectCartItemQuery1);

                if ($resultCartItem->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $deliveryBoyId = $lastDeliveryBoyId;
                } else {

                    $selectFirstDeliveryBoyIdQuery = "SELECT `delivery_boy_id` FROM `delivery` ORDER BY `delivery_id` ASC LIMIT 1";
                    $resultFirstDeliveryBoyId = $conn->query($selectFirstDeliveryBoyIdQuery);

                    if ($resultFirstDeliveryBoyId->num_rows > 0) {
                        $firstDeliveryBoyIdData = $resultFirstDeliveryBoyId->fetch_assoc();

                        $firstDeliveryBoyId = $firstDeliveryBoyIdData['delivery_boy_id'];
                        $deliveryBoyId = $firstDeliveryBoyId;
                    }
                }
            }

            if (isset($_GET['cart'])) {
                $currentDate = date("Y-m-d");
                $currentTime = date("H:i:s");

                $orderSql = "INSERT INTO `orders`(`customer_id`, `date`, `time`, `payment_method`, `payment_status`,`order_status`) 
                VALUES ('$user_id','$currentDate','$currentTime','$payment_method','pending','pending')";

                if ($conn->query($orderSql) === TRUE) {

                    // delivery insert

                    $deliverySql = "INSERT INTO `delivery`(`delivery_boy_id`, `order_id`,`first_name`, `last_name`, `phone_no`, `status`, `house_no`, `state`, 
                `city`,`latitude`,`longitude`,`delivery_cost`) VALUES ('$deliveryBoyId','$lastOrderId','$first_name','$last_name','$phone_number','pending','$house_no','$state','$city',
                '$latitude','$longitude','200')";

                    if ($conn->query($deliverySql) === TRUE) {

                        if (isset($_GET['cart'])) {
                            // select cart data

                            $selectCartItemQuery1 = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
                            $resultCartItem = $conn->query($selectCartItemQuery1);

                            if ($resultCartItem->num_rows > 0) {
                                while ($itemCartData = $resultCartItem->fetch_assoc()) {
                                    $cart_id = $itemCartData['cart_id'];
                                    $item_id = $itemCartData['item_id'];
                                    $quantity =  $itemCartData['quantity'];

                                    $orderDetailsSql = "INSERT INTO `order_details`(`order_id`, `item_id`, `order_type`, `quantity`) 
                                    VALUES ('$lastOrderId', '$item_id', '', '$quantity')";

                                    if ($conn->query($orderDetailsSql) === TRUE) {

                                        $selectItemQuery1 = "SELECT * FROM `item` WHERE `item_id` = '$item_id'";
                                        $resultItem = $conn->query($selectItemQuery1);

                                        if ($resultItem->num_rows > 0) {
                                            $itemData = $resultItem->fetch_assoc();
                                            $stock_quantity = $itemData['stock_quantity'];
                                            $new_stock_quantity = $stock_quantity - $quantity;

                                            $sql = "UPDATE item SET stock_quantity='$new_stock_quantity' WHERE item_id='$item_id'";

                                            // Execute the query
                                            if ($conn->query($sql) === TRUE) {
                                                $order_success = true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if ($order_success) {
                    $selectCartItemQuery1 = "SELECT * FROM `cart` WHERE `user_id`='$user_id'";
                    $resultCartItem = $conn->query($selectCartItemQuery1);

                    if ($resultCartItem->num_rows > 0) {
                        $itemCartData = $resultCartItem->fetch_assoc();

                        $deleteSql = "DELETE FROM `cart` WHERE `user_id` = '$user_id'";

                        if ($conn->query($deleteSql) === TRUE) {
                            header('location: ./order-history.php');
                        }
                    }
                } else {
                    header('location: cart.php');
                }
            } else {

                $currentDate = date("Y-m-d");
                $currentTime = date("H:i:s");

                $orderSql = "INSERT INTO `orders`(`customer_id`, `date`, `time`, `payment_method`, `payment_status`,`order_status`) 
                VALUES ('$user_id','$currentDate','$currentTime','$payment_method','pending','pending')";

                if ($conn->query($orderSql) === TRUE) {

                    // delivery insert

                    $deliverySql = "INSERT INTO `delivery`(`delivery_boy_id`, `order_id`,`first_name`, `last_name`, `phone_no`, `status`, `house_no`, `state`, 
                    `city`,`latitude`,`longitude`,`delivery_cost`) VALUES ('$deliveryBoyId','$lastOrderId','$first_name','$last_name','$phone_number','pending','$house_no','$state','$city',
                    '$latitude','$longitude','200')";

                    if ($conn->query($deliverySql) === TRUE) {

                        $orderDetailsSql = "INSERT INTO `order_details`(`order_id`, `item_id`, `order_type`, `quantity`) 
                            VALUES ('$lastOrderId', '$item_id', '', '$quantityParam')";

                        if ($conn->query($orderDetailsSql) === TRUE) {


                            $selectItemQuery1 = "SELECT * FROM `item` WHERE `item_id` = '$item_id'";
                            $resultItem = $conn->query($selectItemQuery1);

                            if ($resultItem->num_rows > 0) {

                                $itemData = $resultItem->fetch_assoc();

                                $stock_quantity = $itemData['stock_quantity'];

                                $new_stock_quantity = $stock_quantity - $quantityParam;

                                $sqlUpdate = "UPDATE item SET stock_quantity='$new_stock_quantity' WHERE item_id='$item_id'";

                                if ($conn->query($sqlUpdate) === TRUE) {
                                    header('location: ./order-history.php');
                                }
                            }
                        }
                    }
                }
            }

            if (isset($_GET['instore'])) {
                $currentDate = date("Y-m-d");
                $currentTime = date("H:i:s");

                $orderSql = "INSERT INTO `orders`(`customer_id`, `date`, `time`, `payment_method`, `payment_status`,`order_status`) 
                VALUES ('$user_id','$currentDate','$currentTime','$payment_method','pending','pending')";

                if ($conn->query($orderSql) === TRUE) {

                    // delivery insert

                    $deliverySql = "INSERT INTO `delivery`(`delivery_boy_id`, `order_id`,`first_name`, `last_name`, `phone_no`, `status`, `house_no`, `state`, 
                `city`,`latitude`,`longitude`,`delivery_cost`) VALUES ('$deliveryBoyId','$lastOrderId','$first_name','$last_name','$phone_number','pending','$house_no','$state','$city',
                '$latitude','$longitude','200')";

                    if ($conn->query($deliverySql) === TRUE) {


                        if (isset($_GET['instore'])) {
                            // select cart data

                            // $cart_id = $itemCartData['cart_id'];
                            // $item_id = $itemCartData['item_id'];
                            // $quantity =  $itemCartData['quantity'];

                            if (isset($_SESSION['items'])) {

                                foreach ($_SESSION['items'] as $item) {
                                    $itemId = $item['item_id'];
                                    $qty = $item['qty'];

                                    $orderDetailsSql = "INSERT INTO `order_details`(`order_id`, `item_id`, `order_type`, `quantity`) 
                                    VALUES ('$lastOrderId', '$itemId', '', '$qty')";

                                    if ($conn->query($orderDetailsSql) === TRUE) {

                                        $selectItemQuery1 = "SELECT * FROM `item` WHERE `item_id` = '$item_id'";
                                        $resultItem = $conn->query($selectItemQuery1);

                                        if ($resultItem->num_rows > 0) {
                                            $itemData = $resultItem->fetch_assoc();
                                            $stock_quantity = $itemData['stock_quantity'];
                                            $new_stock_quantity = $stock_quantity - $quantity;

                                            $sql = "UPDATE item SET stock_quantity='$new_stock_quantity' WHERE item_id='$item_id'";

                                            // Execute the query
                                            if ($conn->query($sql) === TRUE) {
                                                $order_success = true;
                                            }
                                        }
                                    }
                                }
                            } else {
                            }
                        }
                    }
                }

                if ($order_success) {
                    $selectCartItemQuery1 = "SELECT * FROM `cart` WHERE `user_id`='$user_id'";
                    $resultCartItem = $conn->query($selectCartItemQuery1);

                    if ($resultCartItem->num_rows > 0) {
                        $itemCartData = $resultCartItem->fetch_assoc();

                        $deleteSql = "DELETE FROM `cart` WHERE `user_id` = '$user_id'";

                        if ($conn->query($deleteSql) === TRUE) {
                            header('location: ./order-history.php');
                        }
                    }
                } else {
                    header('location: cart.php');
                }
            }
        }
    }
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
                <form class="order-content" method="post">
                    <div class="order-content-1">
                        <div class="input-content">
                            <div class="input-one-content">
                                <p>First Name</p>
                                <input type="text" name="first_name" value="<?php echo $user_first_name ?>">
                                <p class="input-error"><?php echo $first_name_error ?></p>
                            </div>
                            <div class="input-one-content">
                                <p>Last Name</p>
                                <input type="text" name="last_name" value="<?php echo $user_last_name ?>">
                                <p class="input-error"><?php echo $last_name_error ?></p>
                            </div>
                            <div class="input-one-content">
                                <p>Email Address</p>
                                <input type="text" name="email" disabled value="<?php echo $user_email ?>">
                                <p class="input-error"><?php echo $email_error ?></p>
                            </div>
                            <div class="input-one-content">
                                <p>Phone Number</p>
                                <input type="text" name="phone_number" value="<?php echo $user_phone_number ?>">
                                <p class="input-error"><?php echo $phone_number_error ?></p>
                            </div>

                            <div class="input-one-content">
                                <p>Method</p>
                                <select name="payment_method" id="">
                                    <option value="cash">Cash On Delivery</option>
                                    <option value="card">Card Payment</option>
                                </select>
                            </div>

                            <div class="input-one-content">
                                <p>House Number</p>
                                <input type="text" name="house_no" value="<?php echo $user_house_no ?>">
                                <p class="input-error"><?php echo $house_no_error ?></p>
                            </div>

                            <div class="input-one-content">
                                <p>state</p>
                                <input type="text" name="state" value="<?php echo $user_state ?>">
                                <p class="input-error"><?php echo $state_error ?></p>
                            </div>

                            <div class="input-one-content">
                                <p>city</p>
                                <input type="text" name="city" value="<?php echo $user_city ?>">
                                <p class="input-error"><?php echo $city_error ?></p>
                            </div>

                            <div class="input-one-content">
                                <p>Select Location</p>
                                <div id="map"></div>
                                <p class="input-error"><?php echo $latitude_error ?></p>
                                <input type="hidden" id="latitude" name="latitude" value="<?php echo $user_latitude ?>">
                                <input type="hidden" id="longitude" name="longitude" value="<?php echo $user_longitude ?>">
                            </div>

                        </div>
                    </div>
                    <div class="order-content-2">
                        <?php

                        if (isset($_GET['cart'])) {

                            $count = 1;

                            $selectCartItemQuery1 = "SELECT * FROM `cart` WHERE `user_id` = '$user_id'";
                            $resultCartItem = $conn->query($selectCartItemQuery1);

                            if ($resultCartItem->num_rows > 0) {
                                while ($itemCartData = $resultCartItem->fetch_assoc()) {
                                    $cart_id = $itemCartData['cart_id'];
                                    $item_id = $itemCartData['item_id'];
                                    $quantity =  $itemCartData['quantity'];

                                    $selectItemQuery1 = "SELECT * FROM `item` WHERE `item_id` = '$item_id'";
                                    $resultItem = $conn->query($selectItemQuery1);

                                    if ($resultItem->num_rows > 0) {
                                        $itemData = $resultItem->fetch_assoc();

                                        $name =  $itemData['name'];
                                        $price =  $itemData['price'];
                                        $stock_quantity =  $itemData['stock_quantity'];

                                        $total_amount_item = $price * $quantity;

                                        $selectItemImageQuery1 = "SELECT * FROM `item_image` WHERE `item_id` = '$item_id'";
                                        $resultItemImage = $conn->query($selectItemImageQuery1);

                                        if ($resultItemImage->num_rows > 0) {
                                            $itemImageData = $resultItemImage->fetch_assoc();

                                            $image_url =  $itemImageData['image_url'];

                                            $all_item_total_amount += $total_amount_item;

                                            echo '
                                                <div class="user-cart-product">
                                                    <div class="cart-product-1">
                                                        <div class="cart-product-1-1">
                                                            <img src="./assets/images/product/' . $image_url . '" alt="" style="object-fit:cover;">
                                                        </div>
                                                        <div class="cart-product-1-2">
                                                            <div class="cart-product-1-2-1">
                                                                <p>' . $name . '</p>
                                                            </div>
                                                            <div class="cart-product-1-2-2">
                                                                <div class="cart-q">
                                                                    <input type="button" value="-" onclick="dec(this, ' . $item_id . ',' . $price . ',' . $quantity . ')" style="width:20px">
                                                                    <input class="quantity" type="text" value="' . $quantity . '" disabled>
                                                                    <input type="button" value="+" onclick="inc(this, ' . $item_id . ',' . $price . ',' . $quantity . ',' . $stock_quantity . ')"style="width:20px">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart-product-2">
                                                        <div class="cart-product-1-2-1">
                                                            <p class="total-amount-item">LKR.' . $total_amount_item . '</p>
                                                        </div>
                                                        <div class="cart-product-1-2-2">
                                                            <p>
                                                                <a href="remove-cart.php?cart_id=' . $cart_id . '"><i class="ri-delete-bin-line"></i></a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    }
                                }
                            } else {
                                echo '<script>window.location.href = "./cart.php";</script>';
                            }
                        } else {


                            $quantity = $quantityParam;

                            $selectItemQuery1 = "SELECT * FROM `item` WHERE `item_id` = '$item_id'";
                            $resultItem = $conn->query($selectItemQuery1);

                            if ($resultItem->num_rows > 0) {
                                $itemData = $resultItem->fetch_assoc();

                                $name =  $itemData['name'];
                                $price =  $itemData['price'];
                                $stock_quantity =  $itemData['stock_quantity'];

                                $total_amount_item = $price * $quantity;

                                $selectItemImageQuery1 = "SELECT * FROM `item_image` WHERE `item_id` = '$item_id'";
                                $resultItemImage = $conn->query($selectItemImageQuery1);

                                if ($resultItemImage->num_rows > 0) {
                                    $itemImageData = $resultItemImage->fetch_assoc();

                                    $image_url =  $itemImageData['image_url'];

                                    $all_item_total_amount += $total_amount_item;

                                    echo '
                                        <div class="user-cart-product">
                                            <div class="cart-product-1">
                                                <div class="cart-product-1-1">
                                                    <img src="./assets/images/product/' . $image_url . '" alt="" style="object-fit:cover;">
                                                </div>
                                                <div class="cart-product-1-2">
                                                    <div class="cart-product-1-2-1">
                                                        <p>' . $name . '</p>
                                                    </div>
                                                    <div class="cart-product-1-2-2">
                                                        <div class="cart-q">
                                                            <input class="quantity" type="text" value="' . $quantity . '" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cart-product-2">
                                                <div class="cart-product-1-2-1">
                                                </div>
                                                <div class="cart-product-1-2-2">
                                                <p class="total-amount-item">LKR.' . $total_amount_item . '</p>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                }
                            }
                        }


                        ?>

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
                                    <p id="sub-total">LKR. <?php echo $all_item_total_amount ?>.00</p>
                                    <p>LKR. 200.00</p>
                                    <h4 id="total">LKR. <?php echo $all_item_total_amount + 200 ?>.00</h4>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>

                        <div class="input-content margin-top-20">
                            <div class="right-button">
                                <input type="submit" value="Place Order" name="order">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>
    <script>
        var map = L.map('map').setView([
            <?php
            if (isset($user_latitude)) {
                echo $user_latitude;
            } else {
                echo 6.9271;
            }
            ?>,
            <?php
            if (isset($user_longitude)) {
                echo $user_longitude;
            } else {
                echo 79.8612;
            }
            ?>
        ], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        var marker;
        <?php if (isset($user_latitude) && isset($user_longitude)) { ?>
            marker = new L.Marker([<?php echo $user_latitude; ?>, <?php echo $user_longitude; ?>]).addTo(map);
        <?php } ?>
        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = new L.Marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
        });
    </script>





    <script>
        function updateQuantity(item_id, newQuantity) {
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        console.log(xhr.responseText);
                    } else {
                        console.error("Error updating quantity");
                    }
                }
            };
            xhr.open("POST", "update_quantity.php", true); // Corrected path
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("item_id=" + encodeURIComponent(item_id) + "&newQuantity=" + encodeURIComponent(newQuantity));
        }

        function inc(element, item_id, price, quantity, stock_quantity) {
            let inputField = element.parentElement.querySelector(".quantity");
            let cartProduct = element.closest(".user-cart-product");
            let inputFieldPrice = cartProduct.querySelector(".total-amount-item");
            let subTotal = document.getElementById("sub-total");
            let total = document.getElementById("total");
            let count = parseInt(inputField.value);
            count += 1;
            if (count <= stock_quantity) {
                inputField.value = count;
                inputFieldPrice.innerHTML = 'LKR.' + (price * count);
                let currentSubTotal = parseFloat(subTotal.innerHTML.replace("LKR.", ""));
                subTotal.innerHTML = 'LKR.' + (currentSubTotal + price).toFixed(2);
                total.innerHTML = 'LKR.' + (currentSubTotal + price + 200).toFixed(2);
                updateQuantity(item_id, count);
            }
        }

        function dec(element, item_id, price, quantity) {
            let inputField = element.parentElement.querySelector(".quantity");
            let cartProduct = element.closest(".user-cart-product");
            let inputFieldPrice = cartProduct.querySelector(".total-amount-item");
            let subTotal = document.getElementById("sub-total");
            let total = document.getElementById("total");
            let count = parseInt(inputField.value);
            if (count > 1) {
                count -= 1;
                inputField.value = count;
                inputFieldPrice.innerHTML = 'LKR.' + (price * count);
                let currentSubTotal = parseFloat(subTotal.innerHTML.replace("LKR.", ""));
                subTotal.innerHTML = 'LKR.' + (currentSubTotal - price).toFixed(2);
                total.innerHTML = 'LKR.' + (currentSubTotal - price + 200).toFixed(2);
                updateQuantity(item_id, count);
            }
        }
    </script>





</body>

</html>