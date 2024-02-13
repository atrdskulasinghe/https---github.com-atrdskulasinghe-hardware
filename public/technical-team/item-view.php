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
        header('location: ../delivery-boy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        header('location: ../admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        // header('location: ../technical-team/index.php');
    }
} else {
    header('location: ../login.php');
}


include "../../config/database.php";
include "../../template/user-data.php";

$itemName = $itemCategory = $price = $quantity = $creationDate = $expirationDate = $brand = $discount = $warranty = $weight = $manufacturer = $description = $itemCategoryName = '';
$itemNameError = $itemCategoryError = $priceError = $quantityError = $creationDateError = $expirationDateError = $brandError = $discountError = $warrantyError = $weightError = $manufacturerError = $descriptionError = $image1Error = $image2Error = $image3Error = $image4Error = $image5Error = '';

$itemImages = [];



$item_id = "";

if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];
}

$selectUserQuery = "SELECT * FROM `item` WHERE `item_id` = $item_id";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $itemCategory = $row['item_category'];
    $itemName = $row['name'];
    $price = $row['price'];
    $quantity = $row['stock_quantity'];
    $creationDate = $row['creation_date'];
    $expirationDate = $row['expiration_date'];
    $brand = $row['brand'];
    $discount = $row['discount'];
    $warranty = $row['warranty'];
    $weight = $row['weight'];
    $manufacturer = $row['manufacturer'];
    $description = $row['description'];
} else {
    header('location: cashiers.php');
}

// get Item category name

$selectUserQuery = "SELECT * FROM `item_category` WHERE `item_catagory_id` = $itemCategory";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $itemCategoryName = $row['name'];
}

$selectUserQuery = "SELECT * FROM `item_image` WHERE `item_id` = $item_id";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {


    while ($row = $result->fetch_assoc()) {
        $itemId = $row['item_id'];
        $imageUrl = $row['image_url'];

        if (!isset($itemImages[$itemId])) {
            $itemImages[$itemId] = [];
        }

        $itemImages[$itemId][] = $imageUrl;
    }
}

if (isset($_POST['save'])) {



    $itemName = $_POST["item_name"];
    $itemCategory = $_POST["item_category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $creationDate = $_POST["creation_date"];
    $expirationDate = $_POST["expiration_date"];
    $brand = $_POST["brand"];
    $discount = $_POST["discount"];
    $warranty = $_POST["warranty"];
    $weight = $_POST["weight"];
    $manufacturer = $_POST["manufacturer"];
    $description = $_POST["description"];

    if (empty($itemName)) {
        $itemNameError = "Please enter item name";
    }

    if (empty($itemCategory)) {
        $itemCategoryError = "Please enter item category";
    }

    if (empty($price)) {
        $priceError = "Please enter price";
    }

    if (empty($quantity)) {
        $quantityError = "Please enter quantity";
    }

    // if (empty($creationDate)) {
    //     $creationDateError = "Please enter creation date";
    // }

    // if (empty($expirationDate)) {
    //     $expirationDateError = "Please enter expiration date";
    // }

    // if (empty($brand)) {
    //     $brandError = "Please enter brand";
    // }

    // if (empty($discount)) {
    //     $discountError = "Please enter discount";
    // }

    if (empty($warranty)) {
        $warrantyError = "Please enter warranty";
    }

    // if (empty($weight)) {
    //     $weightError = "Please enter weight";
    // }

    // if (empty($manufacturer)) {
    //     $manufacturerError = "Please enter manufacturer";
    // }

    if (empty($description)) {
        $descriptionError = "Please enter description";
    }

    // if (empty($_FILES["image_1"]["name"]) && $_FILES["image_1"]["error"] == UPLOAD_ERR_OK) {
    //     $image1Error = "Please choose a image 1.";
    // } 
    // if (empty($_FILES["image_2"]["name"]) && $_FILES["image_2"]["error"] == UPLOAD_ERR_OK) {
    //     $image2Error = "Please choose a image 2.";
    // } 
    // if (empty($_FILES["image_3"]["name"]) && $_FILES["image_3"]["error"] == UPLOAD_ERR_OK) {
    //     $image3Error = "Please choose a image 3.";
    // } 
    // if (empty($_FILES["image_4"]["name"]) && $_FILES["image_4"]["error"] == UPLOAD_ERR_OK) {
    //     $image4Error = "Please choose a image 4.";
    // } 
    // if (empty($_FILES["image_5"]["name"]) && $_FILES["image_5"]["error"] == UPLOAD_ERR_OK) {
    //     $image5Error = "Please choose a image 5.";
    // }

    $updateItemQuery = "UPDATE `item` SET 
    `name` = '$itemName',
    `price` = '$price',
    `stock_quantity` = '$quantity',
    `creation_date` = '$creationDate',
    `expiration_date` = '$expirationDate',
    `brand` = '$brand',
    `discount` = '$discount',
    `warranty` = '$warranty',
    `weight` = '$weight',
    `manufacturer` = '$manufacturer',
    `description` = '$description'
    WHERE `item_id` = '$item_id'";

    // image path

    $targetDirectory = "../assets/images/product/";

    if (empty($itemNameError) && empty($itemCategoryError) && empty($priceError) && empty($quantityError) && empty($creationDateError) && empty($expirationDateError) && empty($brandError) && empty($discountError) && empty($warrantyError) && empty($weightError) && empty($manufacturerError) && empty($descriptionError) && empty($image1Error) && empty($image2Error) && empty($image3Error) && empty($image4Error) && empty($image5Error)) {

        if ($conn->query($updateItemQuery)) {

            if (!empty($_FILES["image_1"]["name"]) && $_FILES["image_1"]["error"] == UPLOAD_ERR_OK) {
                echo "oj";
                $newFileName = $item_id . "_image1.jpg";
                $targetFile = $targetDirectory . $newFileName;
                if (move_uploaded_file($_FILES["image_1"]["tmp_name"], $targetFile)) {
                }
            }

            if (!empty($_FILES["image_2"]["name"]) && $_FILES["image_2"]["error"] == UPLOAD_ERR_OK) {
                $newFileName = $item_id . "_image2.jpg";
                $targetFile = $targetDirectory . $newFileName;
                if (move_uploaded_file($_FILES["image_2"]["tmp_name"], $targetFile)) {
                }
            }

            if (!empty($_FILES["image_3"]["name"]) && $_FILES["image_3"]["error"] == UPLOAD_ERR_OK) {
                $newFileName = $item_id . "_image3.jpg";
                $targetFile = $targetDirectory . $newFileName;
                if (move_uploaded_file($_FILES["image_3"]["tmp_name"], $targetFile)) {
                }
            }

            if (!empty($_FILES["image_4"]["name"]) && $_FILES["image_4"]["error"] == UPLOAD_ERR_OK) {
                $newFileName = $item_id . "_image4.jpg";
                $targetFile = $targetDirectory . $newFileName;
                if (move_uploaded_file($_FILES["image_4"]["tmp_name"], $targetFile)) {
                }
            }

            if (!empty($_FILES["image_5"]["name"]) && $_FILES["image_5"]["error"] == UPLOAD_ERR_OK) {
                $newFileName = $item_id . "_image5.jpg";
                $targetFile = $targetDirectory . $newFileName;
                if (move_uploaded_file($_FILES["image_5"]["tmp_name"], $targetFile)) {
                }
            }

            header('location: items.php');
        }
    }
}

if (isset($_POST['delete'])) {

    // delete item Images

    $deleteItemImageQuery = "DELETE FROM `item_image` WHERE `item_id` = '$item_id'";
    $conn->query($deleteItemImageQuery);

    if ($conn->query($deleteItemImageQuery)) {

        $countQuery = "SELECT COUNT(*) AS item_count FROM `item`";
        $result = $conn->query($countQuery);
        if ($result) {

            $row = $result->fetch_assoc();
            $itemCount = $row['item_count'];

            if ($itemCount == 1) {
                $truncateQuery = "TRUNCATE TABLE `item`";
                $conn->query($truncateQuery);
                $truncateQuery = "TRUNCATE TABLE `item_image`";
                $conn->query($truncateQuery);
                header('location: items.php');
            } else {
                $deleteItemQuery = "DELETE FROM `item` WHERE `item_id` = '$item_id'";
                $conn->query($deleteItemQuery);

                if ($conn->query($deleteItemQuery)) {
                    header('location: items.php');
                }
            }

            $result->free();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard-menu.css">
    <link rel="stylesheet" href="../assets/css/dashboard-nav.css">
    <link rel="stylesheet" href="../assets/css/dashboard-technician.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/card.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/dashboard-profile.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />

</head>

<body>
    <div class="container">
        <!-- navigation -->
        <?php
        include "../../template/dashboard-nav.php";
        ?>
        <!-- <div class="content"> -->
        <aside class="active aside">
                <!-- menu -->
                <div class="menu">
                <div class="menu-header">
                    <h1>Logo</h1>
                    <div class="menu-close">
                        <i class="ri-close-line " id="menu-header-icon"></i>
                    </div>
                </div>
                <div class="menu-content">
                    <div class="menu-links">
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./index.php">
                                <p><img src="../assets/images/ui/dashboard.png" alt="">Dashboard</p>
                            </a>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/booking.png" alt="">Technician</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technicians.php">
                                        <p><img src="../assets/images/ui/booking.png" alt="">Technicians</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./new-technician.php">
                                        <p><img src="../assets/images/ui/new technicians.png" alt="">New Technicians</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technician-category.php">
                                        <p><img src="../assets/images/ui/category.png" alt="">Technician Category</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technician-salary-request.php">
                                        <p><img src="../assets/images/ui/salary-request.png" alt="">Salary Request</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/delivery-boy.png" alt="">Delivery Boy</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./delivery-boys.php">
                                        <p><img src="../assets/images/ui/Courier.png" alt="">All Delivery Boys</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./new-delivery-boy.php">
                                        <p><img src="../assets/images/ui/new delivery boy.png" alt="">New Delivery Boys</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./delivery-boy-salary-request.php">
                                        <p><img src="../assets/images/ui/salary-request.png" alt="">Salary Request</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2 active">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/item.png" alt="">Item</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list ">
                                <div class="menu-link-button menu-hidden-button active">
                                    <a href="./items.php">
                                        <p><img src="../assets/images/ui/all items.png" alt="">All Items</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button ">
                                    <a href="./add-item.php">
                                        <p><img src="../assets/images/ui/add item.png" alt="">Add Item</p>
                                    </a>
                                </div>

                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./item-category.php">
                                        <p><img src="../assets/images/ui/category.png" alt="">Item Category</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./customers.php">
                                <p><img src="../assets/images/ui/customer.png" alt="">Customer</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./settings.php">
                                <p><img src="../assets/images/ui/Settings.png" alt="">Settings</p>
                            </a>
                        </div>
                    </div>
                    <div class="menu-logout">
                        <a href="">
                            <p><img src="../assets/images/ui/Exit.png" alt="">Logout</p>
                        </a>
                    </div>
                </div>
            </div>
            </aside>
        <section class="active section">
            <div class="content">
                <form class="profile" method="POST" enctype="multipart/form-data">
                    <div class="profile-content">
                        <div class="profile-content-1">
                            <h1>Basic Information</h1>
                            <p>Edit your account details and settings.</p>
                        </div>
                        <div class="profile-content-2">
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>MAIN IMAGE</h2>
                                    <img src="../assets/images/product/<?php echo $itemImages[$item_id][0]; ?>" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="image_1" value="../assets/images/product/<?php echo $itemImages[$item_id][0]; ?>">
                                    <p class="input-error"><?php echo $image1Error ?></p>
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button" name="">
                                </div>
                            </div>
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>IMAGE 2</h2>
                                    <img src="../assets/images/product/<?php echo $itemImages[$item_id][1]; ?>" alt="" id="preview-image-2">
                                    <input type="file" id="file-input-2" name="image_2" value="../assets/images/product/<?php echo $itemImages[$item_id][1]; ?>">
                                    <p class="input-error"><?php echo $image2Error ?></p>
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button-2" name="">
                                </div>
                            </div>
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>IMAGE 3</h2>
                                    <img src="../assets/images/product/<?php echo $itemImages[$item_id][2]; ?>" alt="" id="preview-image-3">
                                    <input type="file" id="file-input-3" name="image_3" value="../assets/images/product/<?php echo $itemImages[$item_id][2]; ?>">
                                    <p class="input-error"><?php echo $image3Error ?></p>
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button-3" name="">
                                </div>
                            </div>
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>IMAGE 4</h2>
                                    <img src="../assets/images/product/<?php echo $itemImages[$item_id][3]; ?>" alt="" id="preview-image-4">
                                    <input type="file" id="file-input-4" name="image_4" value="../assets/images/product/<?php echo $itemImages[$item_id][3]; ?>">
                                    <p class="input-error"><?php echo $image4Error ?></p>
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button-4" name="">
                                </div>
                            </div>
                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>IMAGE 5</h2>
                                    <img src="../assets/images/product/<?php echo $itemImages[$item_id][4]; ?>" alt="" id="preview-image-5">
                                    <input type="file" id="file-input-5" name="image_5" value="../assets/images/product/<?php echo $itemImages[$item_id][4]; ?>">
                                    <p class="input-error"><?php echo $image5Error ?></p>
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button-5" name="">
                                </div>
                            </div>
                            <div class="input-content">
                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>ITEM NAME</p>
                                        <input type="text" name="item_name" value="<?php echo $itemName ?>">
                                        <p class="input-error"><?php echo $itemNameError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>ITEM CATEGORY</p>
                                        <select name="item_category" id="">

                                            <?php


                                            $selectUserQuery = "SELECT * FROM `item_category` WHERE 1";
                                            $result = $conn->query($selectUserQuery);

                                            if ($result->num_rows > 0) {
                                                // Start the loop with $row = $result->fetch_assoc()
                                                for ($i = 0; $i < $result->num_rows; $i++) {
                                                    $row = $result->fetch_assoc();

                                                    $categoryID = $row['item_catagory_id'];
                                                    $categoryName = $row['name'];

                                                    if ($categoryID == $itemCategory) {
                                                        echo '<option value="' . $categoryID . '" selected>' . $categoryName . '</option>';
                                                    } else {
                                                        echo '<option value="' . $categoryID . '">' . $categoryName . '</option>';
                                                    }
                                                }
                                            } else {
                                                echo '<option value="-1">No categories found</option>';
                                            }

                                            ?>
                                        </select>
                                        <p class="input-error"><?php echo $itemCategoryError ?></p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>PRICE</p>
                                        <input type="text" name="price" value="<?php echo $price ?>">
                                        <p class="input-error"><?php echo $priceError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>QUANTITY</p>
                                        <input type="text" name="quantity" value="<?php echo $quantity ?>">
                                        <p class="input-error"><?php echo $quantityError ?></p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>CREATION DATE</p>
                                        <input type="date" name="creation_date" value="<?php echo $creationDate ?>">
                                        <p class="input-error"><?php echo $creationDateError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>EXPIRATION DATE</p>
                                        <input type="date" name="expiration_date" value="<?php echo $expirationDate ?>">
                                        <p class="input-error"><?php echo $expirationDateError ?></p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>BRAND</p>
                                        <input type="text" name="brand" value="<?php echo $brand ?>">
                                        <p class="input-error"><?php echo $brandError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>DISCOUNT</p>
                                        <input type="text" name="discount" value="<?php echo $discount ?>">
                                        <p class="input-error"><?php echo $discountError ?></p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>WATTANTY</p>
                                        <select name="warranty" id="">
                                            <option value="0" <?php if ($warranty == 0) {
                                                                    echo 'selected';
                                                                } ?>>0 Year</option>
                                            <option value="1" <?php if ($warranty == 1) {
                                                                    echo 'selected';
                                                                } ?>>1 Year</option>
                                            <option value="2" <?php if ($warranty == 2) {
                                                                    echo 'selected';
                                                                } ?>>2 Year</option>
                                            <option value="3" <?php if ($warranty == 3) {
                                                                    echo 'selected';
                                                                } ?>>3 Year</option>
                                            <option value="4" <?php if ($warranty == 4) {
                                                                    echo 'selected';
                                                                } ?>>4 Year</option>
                                            <option value="5" <?php if ($warranty == 5) {
                                                                    echo 'selected';
                                                                } ?>>5 Year</option>
                                            <option value="10" <?php if ($warranty == 10) {
                                                                    echo 'selected';
                                                                } ?>>10 Year</option>
                                            <option value="11" <?php if ($warranty == 11) {
                                                                    echo 'selected';
                                                                } ?>>Life Time</option>
                                        </select>
                                        <p class="input-error"><?php echo $warrantyError ?></p>
                                    </div>
                                    <div class="input-two-content-2">
                                        <p>WEIGHT</p>
                                        <input type="text" name="weight" value="<?php echo $weight ?>">
                                        <p class="input-error"><?php echo $weightError ?></p>
                                    </div>
                                </div>

                                <div class="input-two-content">
                                    <div class="input-two-content-1">
                                        <p>MANUFACTURER</p>
                                        <input type="text" name="manufacturer" value="<?php echo $manufacturer ?>">
                                        <p class="input-error"><?php echo $manufacturerError ?></p>
                                    </div>
                                </div>
                                <div class="input-one-content ">
                                    <p>DESCRIPTION</p>
                                    <textarea name="description" id="" cols="30" rows="10"><?php echo $description ?></textarea>
                                    <p class="input-error"><?php echo $descriptionError ?></p>
                                </div>
                                <div class="input-content">
                                    <div class="right-button margin-top-30">
                                        <input type="submit" value="Delete" name="delete">
                                        <input type="submit" value="Save Change" name="save">

                                        <!-- <input type="submit" value="Approve"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- </div> -->
    </div>
    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/profile.js"></script>
</body>

</html>