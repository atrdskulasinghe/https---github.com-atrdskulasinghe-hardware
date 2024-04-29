<?php

session_start();

include "../../config/database.php";
include "../../template/user-data.php";


if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: ../index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        // header('location: ./cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        header('location: ../technician/index.php');
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['search'])) {


        if ($_POST['search'] == "true") {

            $item_id = $conn->real_escape_string($_POST['item_id']);

            $nameArray = array();

            $selectItem = "SELECT * FROM `item` WHERE item_id = '$item_id'";
            $resultItem = $conn->query($selectItem);

            if ($resultItem->num_rows > 0) {

                while ($rowItem = $resultItem->fetch_assoc()) {
                    $name = $rowItem['name'];
                    $price = $rowItem['price'];

                    if (!isset($nameArray[$name])) {
                        $nameArray[$name] = array();
                    }

                    $nameArray[$name][] = array(
                        'item_id' => $rowItem['item_id'],
                        'price' => $price,
                        'image_url' => array()
                    );

                    $selectItemImg = "SELECT * FROM `item_image` WHERE item_id = '{$rowItem['item_id']}'";
                    $resultItemImg = $conn->query($selectItemImg);

                    if ($resultItemImg->num_rows > 0) {
                        while ($rowItemImg = $resultItemImg->fetch_assoc()) {
                            $nameArray[$name][count($nameArray[$name]) - 1]['image_url'][] = $rowItemImg['image_url'];
                        }
                    }
                }
            }

            echo json_encode($nameArray);
        }
        exit;
    }
}

if (isset($_POST['add-button'])) {

    if (!empty($_POST['item-id'])) {
        if (!empty($_POST['qty'])) {
            $itemId = $_POST['item-id'];
            $qty = $_POST['qty'];

            $selectItem = "SELECT * FROM `item` WHERE item_id = '$itemId'";
            $resultItem = $conn->query($selectItem);

            if ($resultItem->num_rows > 0) {
                $rowItem = $resultItem->fetch_assoc();
                if (isset($_SESSION['items'])) {
                    $_SESSION['items'][] = array('item_id' => $itemId, 'qty' => $qty);
                } else {
                    $_SESSION['items'] = array(array('item_id' => $itemId, 'qty' => $qty));
                }
            }
        }
    }
}

if (isset($_SESSION['items'])) {

    foreach ($_SESSION['items'] as $item) {
        $itemId = $item['item_id'];
        $qty = $item['qty'];
    }
}
if (isset($_GET['item_id']) && isset($_GET['qty'])) {
    if (isset($_SESSION['items'])) {
        $itemID = $_GET['item_id'];
        $qty = $_GET['qty'];

        foreach ($_SESSION['items'] as $key => $item) {
            if ($item['item_id'] == $itemID && $item['qty'] == $qty) {
                unset($_SESSION['items'][$key]);
                $_SESSION['items'] = array_values($_SESSION['items']);
                header('location: ./index.php');
                break;
            }
        }
    }
}


if (isset($_POST['order'])) {

    // Initialize variables
    $order_success = false;
    $lastOrderId = 1;

    // Get the last order ID
    $selectOrdersId = "SELECT `order_id` FROM `orders` ORDER BY `order_id` DESC LIMIT 1";
    $result = $conn->query($selectOrdersId);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lastOrderId = $row['order_id'] + 1;
    }

    // Get current date and time
    $currentDate = date("Y-m-d");
    $currentTime = date("H:i:s");
    $customerId = 0;

    // Insert order into orders table
    $orderSql = "INSERT INTO `orders`(`customer_id`, `date`, `time`, `payment_method`, `payment_status`, `order_status`) 
    VALUES (?, ?, ?, 'cash', 'paid', 'active')";

    $orderStmt = $conn->prepare($orderSql);
    $orderStmt->bind_param("iss", $customerId, $currentDate, $currentTime);

    if ($orderStmt->execute()) {

        // Insert order details into order_details table
        if (isset($_SESSION['items'])) {
            foreach ($_SESSION['items'] as $item) {
                $itemId = $item['item_id'];
                $qty = $item['qty'];

                $orderDetailsSql = "INSERT INTO `order_details`(`order_id`, `item_id`, `order_type`, `quantity`) 
                        VALUES (?, ?, '', ?)";

                $orderDetailsStmt = $conn->prepare($orderDetailsSql);
                $orderDetailsStmt->bind_param("iii", $lastOrderId, $itemId, $qty);

                if ($orderDetailsStmt->execute()) {

                    // Update item stock quantity
                    $selectItemQuery = "SELECT `stock_quantity` FROM `item` WHERE `item_id` = ?";
                    $selectItemStmt = $conn->prepare($selectItemQuery);
                    $selectItemStmt->bind_param("i", $itemId);
                    $selectItemStmt->execute();
                    $resultItem = $selectItemStmt->get_result();

                    if ($resultItem->num_rows > 0) {
                        $itemData = $resultItem->fetch_assoc();
                        $stock_quantity = $itemData['stock_quantity'];
                        $new_stock_quantity = $stock_quantity - $qty;

                        $updateItemSql = "UPDATE `item` SET `stock_quantity`=? WHERE `item_id`=?";
                        $updateItemStmt = $conn->prepare($updateItemSql);
                        $updateItemStmt->bind_param("ii", $new_stock_quantity, $itemId);
                        if ($updateItemStmt->execute()) {
                            $order_success = true;
                        } else {
                            echo "Error updating item stock quantity: " . $conn->error;
                        }
                    }
                } else {
                    echo "Error inserting order details: " . $conn->error;
                }
            }
        }
    } else {
        echo "Error inserting order: " . $conn->error;
    }

    // Handle success or failure
    if ($order_success) {
        // echo "Order successfully placed.";
        unset($_SESSION['items']);
        // Redirect to order history or other page
        // header('location: ./order-history.php');
    } else {
        // echo "Failed to place order. Please try again.";
        // Redirect back to cart page
        // header('location: cart.php');
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/user-style.css">
    <link rel="stylesheet" href="../assets/css/cashier.css">
    <link rel="stylesheet" href="../assets/css/user-cart.css">
    <link rel="stylesheet" href="../assets/css/cashier-nav.css">
</head>

<body>
    <div class="container">
        <div class="cashier">
            <nav>
                <div class="nav-content">
                    <div class="nav-content-1">
                        <img src="../assets/images/ui/hardware-logo.png" alt="">
                    </div>
                    <div class="nav-content-2">
                        <!-- <a href="">
                            <img src="../assets/images/admin/1_profile.jpg" alt="">
                            <h3>Tharindu Kulasinghe</h3>
                        </a> -->
                        <a href="../logout.php" class="nav-logout">
                            <i class="ri-logout-box-r-line"></i>
                            <p>logout</p>
                        </a>
                    </div>
                </div>
            </nav>
            <section>
                <div class="section-content-1">
                    <div class="section-content-1-c1">
                        <div class="section-c1-c1-c1">
                            <div class="section-c1-c1-left">
                                <div class="section-c1-c1-input">
                                    <div class="section-c1-c1-i-left">
                                        <h4>Cashier Name</h4>
                                    </div>
                                    <div class="section-c1-c1-i-right">
                                        <input type="text" style="pointer-events: none;" value="<?php echo $user_first_name ." " . $user_last_name;?>">
                                    </div>
                                </div>
                                <div class="section-c1-c1-input">
                                    <div class="section-c1-c1-i-left">
                                        <h4>Date</h4>
                                    </div>
                                    <div class="section-c1-c1-i-right">
                                        <input type="date" id="date">
                                    </div>
                                </div>
                                <div class="section-c1-c1-input">
                                    <div class="section-c1-c1-i-left">
                                        <h4>Time</h4>
                                    </div>
                                    <div class="section-c1-c1-i-right">
                                        <input type="time" id="time">
                                    </div>
                                </div>
                            </div>
                            <form class="section-c1-c1-right" method="post" action="">
                                <div class="section-c1-c1-input">
                                    <div class="section-c1-c1-i-left">
                                        <h4>Item ID</h4>
                                    </div>
                                    <div class="section-c1-c1-i-right">
                                        <input type="text" id="item-id" name="item-id">
                                    </div>
                                </div>
                                <div class="section-c1-c1-input">
                                    <div class="section-c1-c1-i-left">
                                        <h4>QTY</h4>
                                    </div>
                                    <div class="section-c1-c1-i-right">
                                        <input type="number" id="qty" name="qty">
                                    </div>
                                </div>
                                <div class="cart-button">
                                    <button id="add-button" name="add-button" type="submit">Add To List</button>
                                </div>

                                <div class="section-cart-list">

                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {

                                        document.getElementById("item-id").addEventListener("keyup", () => {
                                            search(document.getElementById("item-id").value);
                                        });

                                        document.querySelector('.section-cart-list').style.visibility = "hidden";

                                        function search(item_id) {
                                            let xhr = new XMLHttpRequest();
                                            xhr.onreadystatechange = function() {
                                                if (xhr.readyState == XMLHttpRequest.DONE) {
                                                    if (xhr.status == 200) {
                                                        var responseArray = JSON.parse(xhr.responseText);
                                                        // console.log(responseArray.itemName);

                                                        var cartList = document.querySelector('.section-cart-list');
                                                        cartList.innerHTML = '';

                                                        if (typeof responseArray === "object" && Object.keys(responseArray).length > 0) {
                                                            for (var itemName in responseArray) {
                                                                responseArray[itemName].forEach(function(item) {
                                                                    var listItem = document.createElement('div');
                                                                    listItem.classList.add('section-cart-list-item');
                                                                    cartList.appendChild(listItem);

                                                                    var listItemImg = document.createElement('img');
                                                                    // Assuming the image URL is the first one in the array
                                                                    listItemImg.src = "../assets/images/product/" + item.image_url[0];
                                                                    listItem.appendChild(listItemImg);

                                                                    // console.log("../assets/images/product" + item.image_url[0]);

                                                                    var listItemH2 = document.createElement('h2');
                                                                    listItemH2.innerText = itemName;
                                                                    listItem.appendChild(listItemH2);

                                                                    // console.log(item.price);

                                                                    listItem.addEventListener("click", function() {
                                                                        document.getElementById("item-id").value = item.item_id;
                                                                        document.querySelector('.section-cart-list').style.visibility = "hidden";
                                                                    });
                                                                });
                                                            }
                                                            cartList.style.visibility = "visible";
                                                        } else {
                                                            cartList.style.visibility = "hidden";
                                                        }

                                                    } else {
                                                        console.error("Error updating quantity");
                                                    }
                                                }
                                            };

                                            xhr.open("POST", "", true);
                                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                            var params = "item_id=" + encodeURIComponent(document.getElementById("item-id").value) + "&search=true";
                                            xhr.send(params);
                                        }
                                    });
                                </script>


                            </form>
                        </div>
                        <div class="section-c1-c1-c2">

                            <?php
                            if (isset($_SESSION['items'])) {

                                foreach ($_SESSION['items'] as $item) {
                                    $itemId = $item['item_id'];
                                    $qty = $item['qty'];

                                    $selectItem = "SELECT * FROM `item` WHERE item_id = '$itemId'";
                                    $resultItem = $conn->query($selectItem);

                                    if ($resultItem->num_rows > 0) {
                                        $rowItem = $resultItem->fetch_assoc();

                                        $name = $rowItem['name'];
                                        $price = $rowItem['price'];

                                        $selectItem = "SELECT * FROM `item_image` WHERE item_id = '$itemId'";
                                        $resultItem = $conn->query($selectItem);

                                        if ($resultItem->num_rows > 0) {
                                            $rowItem1 = $resultItem->fetch_assoc();

                                            $image_url = $rowItem1['image_url'];

                                            // $qty = $rowItem['qty'];
                                            // $qty = $rowItem['qty'];

                                            $total_amount_item = $price * $qty;

                                            echo '
                                            <div class="user-cart-product">
                                                    <div class="cart-product-1">
                                                        <div class="cart-product-1-1">
                                                            <img src="../assets/images/product/' . $image_url . '" alt="" style="object-fit:cover;">
                                                        </div>
                                                        <div class="cart-product-1-2">
                                                            <div class="cart-product-1-2-1">
                                                                <p>' . $name . '</p>
                                                            </div>
                                                            <div class="cart-product-1-2-2">
                                                                <div class="cart-q">
                                                                    <input class="quantity" type="text" value="' . $qty . '" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart-product-2">
                                                        <div class="cart-product-1-2-1">
                                                            <p class="total-amount-item">LKR.' . $total_amount_item . '</p>
                                                        </div>
                                                        <div class="cart-product-1-2-2">
                                                            <p>
                                                                <a href="index.php?item_id=' . $itemId . '&qty=' . $qty . '"><i class="ri-delete-bin-line"></i></a>
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            ';
                                        }
                                    }
                                }
                            }
                            ?>


                        </div>
                    </div>
                    <?php
                    $subtotal = 0;
                    if (isset($_SESSION['items'])) {

                        foreach ($_SESSION['items'] as $item) {
                            $itemId = $item['item_id'];
                            $qty = $item['qty'];

                            $selectItem = "SELECT * FROM `item` WHERE item_id = '$itemId'";
                            $resultItem = $conn->query($selectItem);

                            if ($resultItem->num_rows > 0) {
                                $rowItem = $resultItem->fetch_assoc();

                                $name = $rowItem['name'];
                                $price = $rowItem['price'];

                                $subtotal += $price * $qty;
                            }
                        }
                    }


                    ?>




                    <div class="section-content-1-c2">
                        <h3>Order Summery</h3>
                        <div class="section-content-1-c2-c1">
                            <div class="section-c1-c2-c1-left">
                                <p>Subtotal</p>
                            </div>
                            <div class="section-c1-c2-c1-right">
                                <p>LKR. <?php echo $subtotal; ?></p>
                            </div>
                        </div>
                        <div class="section-content-1-c2-c1">
                            <div class="section-c1-c2-c1-left">
                                <p>Discount</p>
                            </div>
                            <div class="section-c1-c2-c1-right">
                                <input type="number" placeholder="ex: LKR. 20" id="discount">
                            </div>
                        </div>
                        <div class="section-content-1-c2-c1 bold">
                            <div class="section-c1-c2-c1-left">
                                <p>Total</p>
                            </div>
                            <div class="section-c1-c2-c1-right">
                                <p id="total">LKR. <?php echo $subtotal; ?> </p>
                            </div>
                        </div>
                        <div class="section-content-1-c2-c1">
                            <div class="section-c1-c2-c1-left">
                                <p>Cash</p>
                            </div>
                            <div class="section-c1-c2-c1-right">
                                <!-- <p>LKR. 150.00</p> -->
                                <input type="number" id="cash">
                            </div>
                        </div>
                        <div class="section-content-1-c2-c1">
                            <div class="section-c1-c2-c1-left">
                                <p>Change</p>
                            </div>
                            <div class="section-c1-c2-c1-right disable">
                                <!-- <p>LKR. 150.00</p> -->
                                <input type="number" id="change">
                            </div>
                        </div>
                        <div class="section-content-1-c2-c1">
                            <form class="section-c1-c2-c1-button" action="" method="POST">
                                <button type="submit" name="order">Prosses Payment</button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    let total = <?php echo $subtotal; ?>;

                    document.getElementById("discount").addEventListener("keyup", () => {
                        console.log("hello")
                        total = <?php echo $subtotal; ?> - document.getElementById("discount").value;
                        document.getElementById("total").innerHTML = "LKR. " + total;
                    });
                </script>

            </section>
            <script>
                let cash = document.getElementById("cash");
                let change = document.getElementById("change");

                // console.log()

                cash.addEventListener("keyup", () => {
                    let price = total;
                    change.value = cash.value - price;

                    if (cash.value == "") {
                        change.value = "";
                    }
                })

                function setDateInput() {
                    var currentDate = new Date();
                    var year = currentDate.getFullYear();
                    var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
                    var day = currentDate.getDate().toString().padStart(2, '0');
                    var dateString = year + '-' + month + '-' + day;
                    document.getElementById('date').value = dateString;
                }
                setDateInput();

                function updateTimeInput() {
                    var currentTime = new Date();
                    var hours = currentTime.getHours();
                    var minutes = currentTime.getMinutes();
                    var seconds = currentTime.getSeconds();
                    var timeString = formatTime(hours) + ':' + formatTime(minutes) + ':' + formatTime(seconds);
                    document.getElementById('time').value = timeString;
                }

                function formatTime(time) {
                    return time < 10 ? '0' + time : time;
                }
                updateTimeInput();
                setInterval(updateTimeInput, 1000);
            </script>
        </div>
    </div>
</body>

</html>