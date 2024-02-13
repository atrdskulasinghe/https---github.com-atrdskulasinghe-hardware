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
}

$user_id = $_SESSION['id'];

$cart_id = "";

if (isset($_GET['cart_id'])) {
    if (!empty($_GET['cart_id'])) {
        $cart_id = $_GET['cart_id'];
    } else {
        header('location: cart.php');
    }
} else {
    header('location: cart.php');
}


$selectCartItemQuery1 = "SELECT * FROM `cart` WHERE `cart_id` = '$cart_id' AND `user_id`='$user_id'";
$resultCartItem = $conn->query($selectCartItemQuery1);

if ($resultCartItem->num_rows > 0) {
    $itemCartData = $resultCartItem->fetch_assoc();

    $deleteSql = "DELETE FROM `cart` WHERE `cart_id` = '$cart_id'";

    if ($conn->query($deleteSql) === TRUE) {
        header('location: ./cart.php');
    } else {
        header('location: cart.php');
    }
} else {
    header('location: cart.php');
}
