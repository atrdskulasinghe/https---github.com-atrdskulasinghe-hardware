<?php
include "../config/database.php";
include "../template/user-data.php";

$searchData = "";

if(isset($_GET['product_name'])){
    if($_GET['product_name'] !== ""){
        $searchData = $_GET['product_name'];
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <menu class="menu">
        <div class="menu-header">
            <div class="menu-header-content-1">
                <?php

                if (isset($_SESSION['id'])) {
                    echo '
                    <a href="./profile.php" class="menu-profile">
                    <div class="menu-header-profile">
                        <img src="./assets/images/customer/' . $user_profile_url . '" alt="">
                    </div>
                    <div class="menu-header-details">
                        <h4>' . $user_first_name . ' ' . $user_last_name . '</h4>
                        <p>' . $user_email . '</p>
                    </div>
                </a>
                    ';
                } else {
                    echo '
                    <div class="menu-login-button">
                        <a href="./login.php">Login</a>
                        <a href="./signup.php">Signup</a>
                    </div>
                    ';
                }


                ?>
            </div>
            <div class="menu-header-content-2">
                <i class="bi bi-x" id="menu-close"></i>
            </div>
        </div>
        <div class="menu-content">
            <ul>
                <li>
                    <a href="./index.php"><img src="./assets/images/ui/dashboard.png">home</a>
                </li>
                <li>
                    <a href="./technician.php"><img src="./assets/images/ui/booking.png">sevices</a>
                </li>
                <li>
                    <a href="./products.php"><img src="./assets/images/ui/item.png">products</a>
                </li>
                <li>
                    <a href="./contact.php"><img src="./assets/images/ui/technical team.png">contact us</a>
                </li>
                <li>
                    <a href=""><img src="./assets/images/ui/messages.png">Messages</a>
                </li>
                <li>
                    <a href="order-history.php"><img src="./assets/images/ui/history.png">Order History</a>
                </li>
                <li>
                    <a href="./book-history.php"><img src="./assets/images/ui/Calendar.png">Booked History</a>
                </li>
                <li>
                    <a href="./cart.php"><img src="./assets/images/ui/all items.png">cart</a>
                </li>
                <!-- <li>
                    <a href="./about.php"><img src="./assets/images/ui/Feedback.png">about us</a>
                </li> -->
            </ul>
            <div class="menu-logout">
                <a href="./logout.php"><img src="./assets/images/ui/Exit.png">Logout</a>
            </div>
        </div>
    </menu>
    <div class="search-bar">
        <div class="box">
            <form class="search-input-box"  method="get" action="./products.php">
                <input type="text" placeholder="Search" name="product_name" value="<?php echo $searchData;?>">
                <button type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>
</body>

</html>