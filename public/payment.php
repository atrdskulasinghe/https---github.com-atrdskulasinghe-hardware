<?php

session_start();
include "../config/database.php";
include "../template/user-data.php";

$booking_id = "";

if (isset($_SESSION['order_id'])) {
} else if (isset($_SESSION['booking_id'])) {
    $booking_id = $_SESSION['booking_id'];
} else {
    header('Location: ./order-history.php');
}



$cardholderNameError = "";
$cardNumberError = "";
$dateError = "";
$cvvError = "";

$user_id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardholderName = $_POST["cardholder_name"];
    $cardNumber = $_POST["card_number"];
    $expiryMonth = $_POST["expiry_month"];
    $expiryYear = $_POST["expiry_year"];
    $cvv = $_POST["cvv"];

    if (empty($cardholderName)) {
        $cardholderNameError = "Cardholder name is required";
    }

    if (empty($cardNumber) || !isValidCardNumber($cardNumber)) {
        $cardNumberError = "Invalid card number";
    }

    $currentYear = date("Y");
    $currentMonth = date("m");
    if ($expiryYear < $currentYear || ($expiryYear == $currentYear && $expiryMonth < $currentMonth)) {
        $dateError = "Card has expired";
    }

    if (empty($cvv) || !ctype_digit($cvv) || strlen($cvv) !== 3) {
        $cvvError = "Invalid CVV";
    }

    if (isset($_SESSION['order_id'])) {
        if (empty($cardholderNameError) && empty($cardNumberError) && empty($dateError) && empty($cvvError)) {

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

            $lastOrderId = $_SESSION['order_id'];
            $first_name = $_SESSION['first_name'];
            $last_name = $_SESSION['last_name'];
            $user_email = $_SESSION['email'];
            $phone_number = $_SESSION['phone_number'];
            $payment_method = $_SESSION['payment_method'];
            $house_no = $_SESSION['house_no'];
            $state = $_SESSION['state'];
            $city = $_SESSION['city'];
            $latitude = $_SESSION['latitude'];
            $longitude = $_SESSION['longitude'];

            $item_id = $_SESSION['item_id'];
            $quantityParam = $_SESSION['quantityParam'];

            if (isset($_SESSION['cart'])) {
                $currentDate = date("Y-m-d");
                $currentTime = date("H:i:s");

                $orderSql = "INSERT INTO `orders`(`customer_id`, `date`, `time`, `payment_method`, `payment_status`,`order_status`) 
                VALUES ('$user_id','$currentDate','$currentTime','$payment_method','paid','pending')";

                if ($conn->query($orderSql) === TRUE) {

                    // delivery insert

                    $deliverySql = "INSERT INTO `delivery`(`delivery_boy_id`, `order_id`,`first_name`, `last_name`, `phone_no`, `status`, `house_no`, `state`, 
                `city`,`latitude`,`longitude`,`delivery_cost`) VALUES ('$deliveryBoyId','$lastOrderId','$first_name','$last_name','$phone_number','pending','$house_no','$state','$city',
                '$latitude','$longitude','200')";

                    if ($conn->query($deliverySql) === TRUE) {

                        // if (isset($_GET['cart'])) {
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
                        // }
                    }
                }

                if ($order_success) {
                    $selectCartItemQuery1 = "SELECT * FROM `cart` WHERE `user_id`='$user_id'";
                    $resultCartItem = $conn->query($selectCartItemQuery1);

                    if ($resultCartItem->num_rows > 0) {
                        $itemCartData = $resultCartItem->fetch_assoc();

                        $deleteSql = "DELETE FROM `cart` WHERE `user_id` = '$user_id'";

                        if ($conn->query($deleteSql) === TRUE) {
                            unset(
                                $_SESSION['order_id'],
                                $_SESSION['first_name'],
                                $_SESSION['last_name'],
                                $_SESSION['email'],
                                $_SESSION['phone_number'],
                                $_SESSION['payment_method'],
                                $_SESSION['house_no'],
                                $_SESSION['state'],
                                $_SESSION['city'],
                                $_SESSION['latitude'],
                                $_SESSION['longitude'],
                                $_SESSION['item_id'],
                                $_SESSION['quantityParam']
                            );
                            header('location: ./order-history.php');
                        }
                    }
                }
            } else if (isset($_SESSION['one-item'])) {


                $currentDate = date("Y-m-d");
                $currentTime = date("H:i:s");

                $orderSql = "INSERT INTO `orders`(`customer_id`, `date`, `time`, `payment_method`, `payment_status`,`order_status`) 
            VALUES ('$user_id','$currentDate','$currentTime','$payment_method','paid','pending')";



                if ($conn->query($orderSql) === TRUE) {

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
                                    unset(
                                        $_SESSION['order_id'],
                                        $_SESSION['first_name'],
                                        $_SESSION['last_name'],
                                        $_SESSION['email'],
                                        $_SESSION['phone_number'],
                                        $_SESSION['payment_method'],
                                        $_SESSION['house_no'],
                                        $_SESSION['state'],
                                        $_SESSION['city'],
                                        $_SESSION['latitude'],
                                        $_SESSION['longitude'],
                                        $_SESSION['item_id'],
                                        $_SESSION['quantityParam']
                                    );
                                    header('location: ./order-history.php');
                                }
                            }
                        }
                    }
                }
            } else {
                unset(
                    $_SESSION['order_id'],
                    $_SESSION['first_name'],
                    $_SESSION['last_name'],
                    $_SESSION['email'],
                    $_SESSION['phone_number'],
                    $_SESSION['payment_method'],
                    $_SESSION['house_no'],
                    $_SESSION['state'],
                    $_SESSION['city'],
                    $_SESSION['latitude'],
                    $_SESSION['longitude'],
                    $_SESSION['item_id'],
                    $_SESSION['quantityParam']
                );
                header('location: ./order-history.php');
            }
        }
    }

    if (isset($_SESSION['booking_id'])) {
        if (empty($cardholderNameError) && empty($cardNumberError) && empty($dateError) && empty($cvvError)) {

            $selectTechnicianQuery1 = "SELECT * FROM `booking` WHERE `booking_id`= '$booking_id' AND `customer_id` = '$user_id'";
            $resultTechnician = $conn->query($selectTechnicianQuery1);

            if ($resultTechnician->num_rows > 0) {
                $row = $resultTechnician->fetch_assoc();

                // echo "hello";

                $updateQuery = "UPDATE `booking` SET 
                `payment_status` = 'paid'
                WHERE `booking_id` = $booking_id";

                if ($conn->query($updateQuery) === TRUE) {
                    header('Location: ./book-history-view.php?booking_id='.$booking_id.'');
                }
            }
        }
    }
}

function isValidCardNumber($cardNumber)
{
    $cardNumber = str_replace(' ', '', $cardNumber);
    $cardNumberLength = strlen($cardNumber);
    $parity = $cardNumberLength % 2;
    $sum = 0;
    for ($i = 0; $i < $cardNumberLength; $i++) {
        $digit = (int)$cardNumber[$i];
        if ($i % 2 == $parity) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }
        $sum += $digit;
    }
    return $sum % 10 == 0;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/payment.css">
</head>

<body>
    <div class="container">
        <form class="card" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="card-header">
                <h2>Payment Option</h2>
            </div>
            <div class="card-input-1">
                <p>Cardholder Name</p>
                <input type="text" name="cardholder_name" value="<?php if (isset($cardholderName)) echo htmlspecialchars($cardholderName); ?>">
                <p class="error"><?php echo $cardholderNameError; ?></p>
            </div>
            <div class="card-input-1">
                <p>Card Number</p>
                <input type="text" name="card_number" value="<?php if (isset($cardNumber)) echo htmlspecialchars($cardNumber); ?>">
                <p class="error"><?php echo $cardNumberError; ?></p>
            </div>

            <div class="card-input-2">
                <div class="card-input">
                    <p>Expiry Date</p>
                    <div class="card-input-2-content">
                        <input type="text" name="expiry_month" value="<?php if (isset($expiryMonth)) echo htmlspecialchars($expiryMonth); ?>" placeholder="MM">
                        <input type="text" name="expiry_year" value="<?php if (isset($expiryYear)) echo htmlspecialchars($expiryYear); ?>" placeholder="YY">
                    </div>
                    <!-- Display error for expiry date -->
                    <p class="error"><?php echo $dateError; ?></p>
                </div>
                <div class="card-input">
                    <p>CVV</p>
                    <input type="text" name="cvv" value="<?php if (isset($cvv)) echo htmlspecialchars($cvv); ?>">
                    <!-- Display error for CVV -->
                    <p class="error"><?php echo $cvvError; ?></p>
                </div>
            </div>
            <div class="card-pay">
                <button type="submit">Pay Now</button>
            </div>
        </form>
    </div>

</body>

</html>