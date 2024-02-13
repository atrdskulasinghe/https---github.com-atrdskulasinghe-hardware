<?php

include "../config/database.php";
session_start();

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $item_id = $_POST['item_id'];
        $newQuantity = $_POST['newQuantity'];

        $updateSql = "UPDATE cart SET quantity = '$newQuantity' WHERE item_id = '$item_id' AND user_id = '$user_id'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Quantity updated successfully";
        } else {
            echo "Error updating quantity: " . $conn->error;
        }

        $conn->close();
        exit;
    }
} else {
    echo "Error: User ID not set";
    exit;
}
