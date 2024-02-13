<?php

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: ../index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ../cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        // header('location: ./technician/index.php');
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        header('location: ../delivery-boy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        header('location: ../admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ../technical-team/index.php');
    }
} else {
    header('location: ../login.php');
}

include "../../config/database.php";
include "../../template/user-data.php";

$booking_id = "";
$user_id = 6;
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}

$technician_id = "";

$selectUserQuery = "SELECT * FROM `technician` WHERE `user_id` = $user_id";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $technician_id = $row['technician_id'];
}

if (isset($_GET['book_id'])) {
    $booking_id = $_GET['book_id'];

    $selectUserQuery = "SELECT * FROM `booking` WHERE `booking_id` = $booking_id";
    $result = $conn->query($selectUserQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $technician_idDB = $row['technician_id'];
        $customer_id = $row['customer_id'];
        $status = $row['status'];
        $booked_date = $row['booked_date'];
        $booked_time = $row['booked_time'];
        $accept_date = $row['accept_date'];
        $accept_time = $row['accept_time'];
        $start_date = $row['start_date'];
        $start_time = $row['start_time'];
        $photo_url = $row['photo_url'];
        $location_url = $row['location_url'];
        $house_no = $row['house_no'];
        $state = $row['state'];
        $city = $row['city'];
        $payment_status = $row['payment_status'];
        $payment_method = $row['payment_method'];
        $cost = $row['cost'];
        $description = $row['description'];

        $currentDate = date("Y-m-d");
        $currentTime = date("H:i:s");


        $updateAcceptQuery = "UPDATE `booking` SET 
            `status` = 'accept',
            `accept_date` = '$currentDate',
            `accept_time` = '$currentTime'
            WHERE `booking_id` = $booking_id";

        $updateCancelQuery = "UPDATE `booking` SET 
            `status` = 'cancel'
            WHERE `booking_id` = $booking_id";

        if ($technician_idDB == $technician_id) {

            if (isset($_GET['status'])) {
                if ($_GET['status'] == "accept") {

                    if ($conn->query($updateAcceptQuery) === TRUE) {
                        header('location: history.php');
                    } else {
                        header('location: booking.php');
                    }
                } else {
                    if ($conn->query($updateCancelQuery) === TRUE) {
                        header('location: booking.php');
                    } else {
                        header('location: booking.php');
                    }
                }
            }
        } else {
            header('location: booking.php');
        }
    }
} else {
    header('location: booking.php');
}
