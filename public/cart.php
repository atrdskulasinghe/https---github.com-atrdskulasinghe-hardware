<?php
include "../config/database.php";

session_start();

$user_id = $_SESSION['id'];

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
} else {
    header('location: ./login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $item_id = $_POST['item_id'];
    $newQuantity = $_POST['newQuantity'];

    $updateSql = "UPDATE cart SET quantity = '$newQuantity' WHERE item_id = '$item_id'";

    if ($conn->query($updateSql) === TRUE) {
        echo "Quantity updated successfully";
    } else {
        echo "Error updating quantity: " . $conn->error;
    }

    $conn->close();
    exit;
}

$all_item_total_amount = 0;


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


                            <?php
                            // Assuming $count is defined somewhere in your PHP code
                            $count = 1; // For demonstration purposes

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
                                                                    <input type="button" value="+" onclick="inc(this, ' . $item_id . ',' . $price . ',' . $quantity . ')"style="width:20px">
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
                            }
                            ?>




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
                                    <p id="sub-total">LKR. <?php echo $all_item_total_amount ?>.00</p>
                                    <p>LKR. 200.00</p>
                                    <h4 id="total">LKR. <?php echo $all_item_total_amount + 200 ?>.00</h4>
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
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("item_id=" + encodeURIComponent(item_id) + "&newQuantity=" + encodeURIComponent(newQuantity));
        }

        function inc(element, item_id, price, quantity) {
            let inputField = element.parentElement.querySelector(".quantity");
            let cartProduct = element.closest(".user-cart-product");
            let inputFieldPrice = cartProduct.querySelector(".total-amount-item");
            let subTotal = document.getElementById("sub-total");
            let total = document.getElementById("total");
            let count = parseInt(inputField.value);
            count += 1;
            inputField.value = count;
            inputFieldPrice.innerHTML = 'LKR.' + (price * count);
            let currentSubTotal = parseFloat(subTotal.innerHTML.replace("LKR.", ""));
            subTotal.innerHTML = 'LKR.' + (currentSubTotal + price).toFixed(2);
            total.innerHTML = 'LKR.' + (currentSubTotal + price + 200).toFixed(2);
            updateQuantity(item_id, count);
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