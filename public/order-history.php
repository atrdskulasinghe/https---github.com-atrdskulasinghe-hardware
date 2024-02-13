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

// if (isset($_GET['technician_id'])) {
//     if (!empty($_GET['technician_id'])) {
//         $technician_id = $_GET['technician_id'];
//     } else {
//         header('location: technicians.php');
//     }
// } else {
//     header('location: technicians.php');
// }


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
    <link rel="stylesheet" href="./assets/css/dashboard-history.css">
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



                    <div class="history">
                        <div class="history-table">
                            <table>
                                <tr>
                                    <td></td>
                                    <td>Book Id</td>
                                    <td>Date</td>
                                    <td>Status</td>
                                    <td>Cost</td>
                                    <td>Action</td>
                                </tr>
                                <?php

                                $selectTechnicianQuery1 = "SELECT * FROM `booking` WHERE `customer_id`= '$user_id'";
                                $resultTechnician = $conn->query($selectTechnicianQuery1);


                                if ($resultTechnician->num_rows > 0) {
                                    while ($row = $resultTechnician->fetch_assoc()) {

                                        $booking_id = $row['booking_id'];
                                        $photo_url = $row['photo_url'];
                                        $status = $row['status'];
                                        $booked_date = $row['booked_date'];
                                        $booked_time = $row['booked_time'];
                                        $accept_date = $row['accept_date'];
                                        $accept_time = $row['accept_time'];
                                        $start_date = $row['start_date'];
                                        $start_time = $row['start_time'];
                                        $finished_date = $row['finished_date'];
                                        $finished_time = $row['finished_time'];
                                        $house_no = $row['house_no'];
                                        $state = $row['state'];
                                        $city = $row['city'];
                                        $payment_status = $row['payment_status'];
                                        $payment_method = $row['payment_method'];
                                        $cost = $row['cost'];
                                        $description = $row['description'];
                                        $latitude = $row['latitude'];
                                        $longitude = $row['longitude'];

                                        echo '
                                            <tr>
                                                <td>
                                                    <img src="./assets/images/' . $photo_url . '" alt="">
                                                </td>
                                                <td>' . $booking_id . '</td>
                                                <td>' . $booked_date . ' ' . $booked_time . '</td>
                                                <td>' . $status . '</td>
                                                <td>' . $cost . '</td>
                                                <td>
                                                    <button class="btn" onclick="window.location.href=\'order-history-view.php?booking_id=' . $booking_id . '\'">View</button>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                }

                                ?>
                            </table>
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
</body>

</html>