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
        header('location: ./delivery-boy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        header('location: ./admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ./technical-team/index.php');
    }
} else {
    header('location: ./login.php');
}

$first_name = "";
$last_name = "";
$phone_number = "";
$email = "";
$payment_method = "";
$house_no = "";
$state = "";
$city = "";
$latitude = "";
$longitude = "";
$lastOrderId = "";

if (isset($_SESSION['first_name'])) {
    $lastOrderId = $_SESSION['order_id'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $phone_number = $_SESSION['phone_number'];
    $email = $_SESSION['email'];
    $payment_method = $_SESSION['payment_method'];
    $house_no = $_SESSION['house_no'];
    $state = $_SESSION['state'];
    $city = $_SESSION['city'];
    $latitude = $_SESSION['latitude'];
    $longitude = $_SESSION['longitude'];
}

$cart = false;
$all_item_total_amount = 200;

if (isset($_GET['cart'])) {

    $cart = true;

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
                }
            }
        }
    }
} else {
}


?>

<html>

<body>
    <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
        <input type="hidden" name="merchant_id" value="1223400">
        <input type="hidden" name="return_url" value="http://sample.com/return">
        <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
        <input type="hidden" name="notify_url" value="http://sample.com/notify">
        </br></br>Item Details</br>
        <input type="text" name="order_id" value="<?php echo $lastOrderId ?>">
        <input type="text" name="items" value="-">
        <input type="text" name="currency" value="LKR">
        <input type="text" name="amount" value="<?php echo $all_item_total_amount ?>">
        </br></br>Customer Details</br>
        <input type="text" name="first_name" value="<?php echo $first_name ?>">
        <input type="text" name="last_name" value="<?php echo $last_name ?>">
        <input type="text" name="email" value="<?php echo $email ?>">
        <input type="text" name="phone" value="<?php echo $phone_number ?>">
        <input type="text" name="address" value="<?php echo $house_no . ',' . $state ?>">
        <input type="text" name="city" value="<?php echo $city ?>">
        <input type="hidden" name="country" value="Sri Lanka">
        <input type="hidden" name="hash" value="098F6BCD4621D373CADE4E832627B4F6">
        <input type="submit" value="Buy Now">
    </form>
</body>

</html>