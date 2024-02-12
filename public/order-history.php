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
}else{
    header('location: ./login.php');
}

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
                                <tr>
                                    <td>
                                        <img src="../assets/images/ui/Wallet.png" alt="">
                                    </td>
                                    <td>#234324</td>
                                    <td>14 Dec 2023 10.25am</td>
                                    <td>Processing</td>
                                    <td>-</td>
                                    <td>
                                        <button class="btn">View</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="../assets/images/ui/Wallet.png" alt="">
                                    </td>
                                    <td>#234324</td>
                                    <td>14 Dec 2023 10.25am</td>
                                    <td>Processing</td>
                                    <td>-</td>
                                    <td>
                                        <button class="btn">View</button>
                                    </td>
                                </tr>
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