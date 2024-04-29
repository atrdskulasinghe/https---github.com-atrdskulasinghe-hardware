<?php
// session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $image1 = $_POST['image'];
    $item_id = $_POST['item_id'];
    $name = $_POST['name'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];

    $item_data = array(
        'image' => $image1,
        'item_id' => $item_id,
        'name' => $name,
        'qty' => $qty,
        'price' => $price
    );

     // Start session if not already started

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array($item_data);
    } else {
        $_SESSION['cart'][] = $item_data;
    }

    echo json_encode($item_data);
    exit;
}
