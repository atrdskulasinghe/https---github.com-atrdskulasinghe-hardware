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
}

$user_id = "";
$code = "";

if (isset($_GET['id'])) {
    if (!empty($_GET['id'])) {
        if (isset($_GET['code'])) {
            if (!empty($_GET['code'])) {
                $user_id = $_GET['id'];
                $code = $_GET['code'];

                $selectUserEmailQuery = "SELECT * FROM `user` WHERE `user_id`= '$user_id'";
                $resultUserEmail = $conn->query($selectUserEmailQuery);

                if ($resultUserEmail->num_rows > 0) {
                    $userData = $resultUserEmail->fetch_assoc();

                    $user_Activation_code = $userData['activation_code'];

                    if ($user_Activation_code == $code) {
                        $updateUserQuery = "UPDATE `user` SET 
                            `status` = 'active'
                            WHERE `user_id` = $user_id";

                        if ($conn->query($updateUserQuery) === TRUE) {
                            echo "Hello";
                            header('location: ./login.php');
                        }
                    } else {
                        header('location: ./login.php');
                    }
                } else {
                    header('location: ./login.php');
                }
            } else {
                header('location: ./login.php');
            }
        } else {
            header('location: ./login.php');
        }
    } else {
        header('location: ./login.php');
    }
} else {
    header('location: ./login.php');
}
