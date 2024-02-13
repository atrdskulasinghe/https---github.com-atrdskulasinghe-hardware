<?php

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: ../index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ../cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        header('location: ../technician/index.php');
    } else if ($_SESSION['account_type'] == "delivery_boy") {
        // header('location: ../delivery-doy/index.php');
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

$user_id = 2;
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}
$delivery_id = "";

if (isset($_GET['delivery_id'])) {

    if ($_GET['delivery_id'] !== "") {

        $delivery_id = $_GET['delivery_id'];

        $selectUserQuery = "SELECT * FROM `delivery_boy` WHERE `user_id` = $user_id";
        $result = $conn->query($selectUserQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $delivery_boy_id = $row['delivery_boy_id'];

            $selectUserQuery = "SELECT * FROM `delivery` WHERE `delivery_id` = $delivery_id";
            $result = $conn->query($selectUserQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $delivery_boy_idDB = $row['delivery_boy_id'];
                $status = $row['status'];

                if ($status == 'pending') {

                    if ($delivery_boy_idDB == $delivery_boy_id) {

                        $currentDate = date("Y-m-d");
                        $currentTime = date("H:i:s");

                        if (isset($_GET['status'])) {
                            if (!empty($_GET['status'])) {
                                if ($_GET['status'] == "accept") {

                                    $updateAcceptQuery = "UPDATE `delivery` SET 
                                    `status` = 'accept'
                                    WHERE `delivery_id` = $delivery_id";

                                    if ($conn->query($updateAcceptQuery) === TRUE) {
                                        header('location: history.php');
                                    } else {
                                        header('location: delivery-request.php');
                                    }
                                // } else if ($_GET['status'] == "cancel") {
                                //     $updateAcceptQuery = "UPDATE `delivery` SET 
                                //     `status` = 'cancel'
                                //     WHERE `delivery_id` = $delivery_id";

                                //     if ($conn->query($updateAcceptQuery) === TRUE) {
                                //         header('location: history.php');
                                //     } else {
                                //         header('location: delivery-request.php');
                                //     }
                                } else {
                                    header('location: delivery-request.php');
                                }
                            } else {
                                header('location: delivery-request.php');
                            }
                        } else {
                            header('location: delivery-request.php');
                        }
                    } else {
                        header('location: delivery-request.php');
                    }
                } else {
                    header('location: delivery-request.php');
                }
            }else {
                header('location: delivery-request.php');
            }
        }
    } else {
        header('location: delivery-request.php');
    }
} else {
    header('location: delivery-request.php');
}
