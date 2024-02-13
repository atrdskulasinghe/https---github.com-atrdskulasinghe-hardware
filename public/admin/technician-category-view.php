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
        // header('location: ../admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ../technical-team/index.php');
    }
} else {
    header('location: ../login.php');
}

include "../../config/database.php";
include "../../template/user-data.php";

$categoryId = "";

if (isset($_GET["category_id"])) {
    $categoryId = $_GET["category_id"];
}

$selectQuery = "SELECT * FROM `technician_category` WHERE `technician_category_id` = '$categoryId'";
$result = $conn->query($selectQuery);

$item_catagory_id = "";
$name = "";
$description = "";
$image_url = "";

$item_catagory_idError = "";
$nameError = "";
$descriptionError = "";
$image_urlError = "";

if ($result && $result->num_rows > 0) {
    while ($itemData = $result->fetch_assoc()) {
        $item_catagory_id = $itemData['technician_category_id'];
        $name = $itemData['name'];
        $description = $itemData['description'];
        $image_url = $itemData['image_url'];
    }
} else {
    header('location: item-category.php');
}

// image path

$targetDirectory = "../assets/images/technician_category/";

if (isset($_POST["save"])) {

    // $item_catagory_id = "";
    $name = $_POST["category_name"];
    $description = $_POST["description"];

    // $image_url = $_POST["save"];
    // if (empty($item_catagory_id)) {
    //     $item_catagory_idError = "Please enter description";
    // }

    if (empty($name)) {
        $nameError = "Please enter description";
    }

    if (empty($description)) {
        $descriptionError = "Please enter description";
    }

    $updateQuery = "UPDATE `technician_category` SET 
    `name` = '$name', 
    `description` = '$description'
    WHERE `technician_category_id` = $categoryId";

    if (empty($nameError) && empty($descriptionError)) {

        if ($conn->query($updateQuery) === TRUE) {
            //  image save

            if (!empty($_FILES["technician_category"]["name"]) && $_FILES["technician_category"]["error"] == UPLOAD_ERR_OK) {

                $newFileName = $categoryId . "_category_image.jpg";
                $targetFile = $targetDirectory . $newFileName;
                if (move_uploaded_file($_FILES["technician_category"]["tmp_name"], $targetFile)) {
                    header('location: technician-category.php');
                }
            } else {
                header('location: technician-category.php');
            }
        }
    }
}

if (isset($_POST['delete'])) {

    // $targetDirectory;

    $checkRelatedRecordsQuery = "SELECT * FROM `technician` WHERE `category` = '$categoryId'";
    $result = $conn->query($checkRelatedRecordsQuery);

    if ($result->num_rows > 0) {
        

    } else {

        $getImageFilePathQuery = "SELECT `image_url` FROM `technician_category` WHERE `technician_category_id` = '$categoryId'";
        $imageResult = $conn->query($getImageFilePathQuery);

        if ($imageResult && $imageResult->num_rows > 0) {
            $imageData = $imageResult->fetch_assoc();

            $imageFilePath = $imageData['image_url'];

            $imageLocation = $targetDirectory . $imageFilePath;

            if (file_exists($imageLocation) && unlink($imageLocation)) {
                $deleteCategoryQuery = "DELETE FROM `technician_category` WHERE `technician_category_id` = '$categoryId'";
                if ($conn->query($deleteCategoryQuery)) {
                    header('location: technician-category.php');
                }
            }
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
    <link rel="stylesheet" href="../assets/css/dashboard-product.css">
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
                        <div class="menu-link-button-2 active">
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
                                <div class="menu-link-button menu-hidden-button active">
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
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/employee.png" alt="">Employee</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./add-technical-team.php">
                                        <p><img src="../assets/images/ui/technical team.png" alt="">Add Technical Team</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./technical-team.php">
                                        <p><img src="../assets/images/ui/technical team.png" alt="">Technical Team</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./add-cashiers.php">
                                        <p><img src="../assets/images/ui/Cashiers.png" alt="">Add Cashiers</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./cashiers.php">
                                        <p><img src="../assets/images/ui/Cashiers.png" alt="">Cashiers</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- menu link 2 -->
                        <div class="menu-link-button-2">
                            <div class="menu-link-button">
                                <p><img src="../assets/images/ui/item.png" alt="">Item</p>
                                <i class="ri-arrow-down-s-line"></i>
                                <i class="ri-arrow-up-s-line"></i>
                            </div>
                            <!-- menu hidden link -->
                            <div class="menu-hidden-list">
                                <div class="menu-link-button menu-hidden-button">
                                    <a href="./items.php">
                                        <p><img src="../assets/images/ui/all items.png" alt="">All Items</p>
                                    </a>
                                </div>
                                <div class="menu-link-button menu-hidden-button">
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
                            <a href="./income.php">
                                <p><img src="../assets/images/ui/income.png" alt="">Income Report</p>
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
                        <a href="../logout.php">
                            <p><img src="../assets/images/ui/Exit.png" alt="">Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
        <section class="active section" style="padding-bottom: 60px">
            <div class="content">

            </div>
            <div class="content margin-top-40">

                <form class="profile-content" method="POST" enctype="multipart/form-data">
                    <div class="profile-content-1">
                        <h1>Basic Information</h1>
                        <p>Edit your account details and settings.</p>
                    </div>
                    <div class="profile-content-2">
                        <div class="input-content">

                            <div class="profile-image">
                                <div class="profile-image-content-1">
                                    <h2>CATEGORY IMAGE</h2>
                                    <img src="../assets/images/technician_category/<?php echo $image_url ?>" alt="" id="preview-image">
                                    <input type="file" id="file-input" name="technician_category" value="../assets/images/technician_category/<?php echo $image_url ?>">
                                </div>
                                <div class="profile-image-content-2">
                                    <input type="button" class="btn" value="Choose Photo" id="file-button" name="">
                                </div>
                            </div>

                            <div class="input-one-content">
                                <p>Category ID</p>
                                <input type="text" value="<?php echo $item_catagory_id ?>" name="" disabled>
                                <p class="input-error"><?php echo $item_catagory_idError ?></p>
                            </div>

                            <div class="input-one-content">
                                <p>NAME</p>
                                <input type="text" value="<?php echo $name ?>" name="category_name">
                                <p class="input-error"><?php echo $nameError ?></p>
                            </div>

                            <div class="input-one-content margin-top-20">
                                <p>Description</p>
                                <textarea name="description" id="" cols="30" rows="10"><?php echo $description ?></textarea>
                                <p class="input-error"><?php echo $descriptionError ?></p>
                            </div>
                            <div class="right-button">
                                <!-- <input type="submit"> -->
                                <input type="submit" value="Delete" name="delete">
                                <input type="submit" value="Save Change" name="save">
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