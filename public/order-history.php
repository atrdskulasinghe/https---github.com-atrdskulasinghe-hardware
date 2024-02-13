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
                                    <td>Order ID</td>
                                    <td>Ordered Date</td>
                                    <td>Status</td>
                                    <td>Amount</td>
                                    <td>Delivery Fee</td>
                                    <td></td>
                                </tr>

                                <?php
                                $error = false;

                                $selectUserQuery = "SELECT * FROM `orders` WHERE `customer_id` = $user_id";
                                $resultOrder = $conn->query($selectUserQuery);

                                if ($resultOrder->num_rows > 0) {

                                    while ($rowOrder = $resultOrder->fetch_assoc()) {

                                        $order_id = $rowOrder['order_id'];
                                        $time = $rowOrder['time'];
                                        $date = $rowOrder['date'];
                                        $total_amount = 0;

                                        $selectDeliveryQuery = "SELECT * FROM `delivery` WHERE `order_id` = $order_id";
                                        $resultDelivery = $conn->query($selectDeliveryQuery);


                                        if ($resultDelivery->num_rows > 0) {


                                            $rowDelivery = $resultDelivery->fetch_assoc();

                                            $delivery_id = $rowDelivery['delivery_id'];
                                            $delivery_boy_idDB = $rowDelivery['delivery_boy_id'];
                                            $date_of_pickup = $rowDelivery['date_of_pickup'];
                                            $time_of_pickup = $rowDelivery['time_of_pickup'];
                                            $date_of_delivered = $rowDelivery['date_of_delivered'];
                                            $time_of_delivered = $rowDelivery['time_of_delivered'];
                                            $status = $rowDelivery['status'];
                                            $house_no = $rowDelivery['house_no'];
                                            $state = $rowDelivery['state'];
                                            $city = $rowDelivery['city'];
                                            // $location_url = $row['location_url'];
                                            $delivery_cost = $rowDelivery['delivery_cost'];
                                            $description = $rowDelivery['description'];

                                            // if ($delivery_boy_idDB == $delivery_boy_id) {

                                            $selectOrderDetailsQuery = "SELECT * FROM `order_details` WHERE `order_id` = $order_id";
                                            $resultOrderDetails = $conn->query($selectOrderDetailsQuery);

                                            if ($resultOrderDetails->num_rows > 0) {


                                                while ($rowOrderDetails = $resultOrderDetails->fetch_assoc()) {

                                                    $item_id = $rowOrderDetails['item_id'];
                                                    $quantity = $rowOrderDetails['quantity'];

                                                    $selectUserQuery = "SELECT * FROM `item` WHERE `item_id` = $item_id";
                                                    $result = $conn->query($selectUserQuery);

                                                    if ($result->num_rows > 0) {

                                                        $row = $result->fetch_assoc();
                                                        $price = $row['price'];

                                                        $total_amount += $quantity * $price;
                                                    }
                                                }
                                            }

                                            $total_amount += $delivery_cost;

                                            echo '
                                                <tr>
                                                    <td>' . $order_id . '</td>
                                                    <td>' . $date . ' / ' . $time . '</td>
                                                    <td>' . ucfirst($status) . '</td>
                                                    <td>LKR. ' . $total_amount . '</td>
                                                    <td>LKR. ' . $delivery_cost . '</td>
                                                    <td>
                                                    <button class="btn" onclick="window.location.href=\'order-history-view.php?order_id=' . $order_id . ' \'">View</button>
                                                    </td>
                                                </tr>
                                        ';
                                        }
                                        // }
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