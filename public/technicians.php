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
        header('location: ./delivery-boy/index.php');
    } else if ($_SESSION['account_type'] == "admin") {
        header('location: ./admin/index.php');
    } else if ($_SESSION['account_type'] == "technical_team") {
        header('location: ./technical-team/index.php');
    }
}

$categoryIdUrl = "";
$minCost = "";
$maxCost = "";
$age1 = "";
$experience = "";

if (isset($_GET['category_id'])) {
    if (!empty($_GET['category_id'])) {
        $categoryIdUrl = $_GET['category_id'];
    }
} else if (isset($_GET['min'])) {
    if (!empty($_GET['min'])) {
        if (isset($_GET['max'])) {
            if (!empty($_GET['max'])) {
                $minCost = $_GET['min'];
                $maxCost = $_GET['max'];
            }
        }
    }
} else if (isset($_GET['age'])) {

    if (!empty($_GET['age'])) {
        $age1 = $_GET['age'];
    }
} else if (isset($_GET['experience'])) {
    if (!empty($_GET['experience'])) {
        $experience = $_GET['experience'];
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

    <link rel="stylesheet" href="./assets/css/user-nav-1.css">
    <link rel="stylesheet" href="./assets/css/user-nav-2.css">
    <link rel="stylesheet" href="./assets/css/user-menu.css">
    <link rel="stylesheet" href="./assets/css/user-search-bar.css">
    <link rel="stylesheet" href="./assets/css/user-footer.css">
    <link rel="stylesheet" href="./assets/css/user-technicians.css">
    <link rel="stylesheet" href="./assets/css/user-technician-list.css">
    <link rel="stylesheet" href="./assets/css/user-style.css">
    <link rel="stylesheet" href="./assets/css/button.css">
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
            <div class="box">
                <div class="technician">
                    <div class="technician-filter ">
                        <div class="technician-filter-content">
                            <div class="filter-close">
                                <i class="bi bi-x"></i>
                            </div>
                            <h3>Category</h3>
                            <hr>
                            <div class="category-list">
                                <ul>
                                    <?php



                                    $selectTechnicianQuery1 = "SELECT * FROM `technician_category` WHERE 1";
                                    $resultTechnicianCategory = $conn->query($selectTechnicianQuery1);

                                    if ($resultTechnicianCategory->num_rows > 0) {
                                        while ($technicianCategoryData = $resultTechnicianCategory->fetch_assoc()) {

                                            $technician_category_id = $technicianCategoryData['technician_category_id'];
                                            $name = $technicianCategoryData['name'];
                                            $description = $technicianCategoryData['description'];
                                            $image_url = $technicianCategoryData['image_url'];


                                            echo '
                                            <li>
                                                <a href="technicians.php?category_id=' . $technician_category_id . '">' . $name . '</a>
                                            </li>
                                        
                                        ';
                                        }
                                    }
                                    ?>

                                </ul>
                            </div>

                            <h3>Cost Per Day</h3>
                            <hr>
                            <form class="price-content" method="get">
                                <input type="text" name="min" placeholder="Min" value="<?php echo $minCost ?>">
                                <span>-</span>
                                <input type="text" name="max" placeholder="Max" value="<?php echo $maxCost ?>">
                                <button type="submit">Apply</button>
                            </form>

                            <h3>Age</h3>
                            <hr>
                            <form class="filter-select-content" method="get" action="technicians.php">
                                <select name="age">
                                    <?php
                                    for ($age = 18; $age <= 60; $age++) {
                                        echo "<option value=\"$age\">$age</option>";
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn" style="margin-top: 10px; margin-left:0; width:100%">Filter</button>
                            </form>

                            <h3>Years of experience</h3>
                            <hr>
                            <form class="filter-select-content" method="get">
                                <select name="experience">
                                    <?php
                                    for ($ex = 0; $ex <= 40; $ex++) {
                                        echo "<option value=\"$ex\">$ex</option>";
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn" style="margin-top: 10px; margin-left:0; width:100%">Filter</button>
                            </form>
                        </div>
                    </div>
                    <div class="technician-content">
                        <div class="filter-icon">
                            <i class="bi bi-filter-left"></i>
                            <p>Filter</p>
                        </div>
                        <div class="technician-list">

                            <?php

                            if ($categoryIdUrl !== "") {

                                $selectTechnicianQuery1 = "SELECT * FROM `technician` WHERE `category` = '$categoryIdUrl'";
                                $resultTechnician = $conn->query($selectTechnicianQuery1);

                                if ($resultTechnician->num_rows > 0) {
                                    while ($technicianData = $resultTechnician->fetch_assoc()) {

                                        $technician_id = $technicianData['technician_id'];
                                        $user_id = $technicianData['user_id'];
                                        $category = $technicianData['category'];
                                        $nic_number = $technicianData['nic_number'];
                                        $nic_photo_url = $technicianData['nic_photo_url'];
                                        $work_experience = $technicianData['work_experience'];
                                        $cost_per_day = $technicianData['cost_per_day'];
                                        $cost_per_hour = $technicianData['cost_per_hour'];
                                        $status = $technicianData['status'];
                                        $balance = $technicianData['balance'];

                                        $selectUserQuery = "SELECT * FROM `user` WHERE `user_id`='$user_id'";
                                        $resultUser = $conn->query($selectUserQuery);

                                        if ($resultUser->num_rows > 0) {
                                            $userData = $resultUser->fetch_assoc();

                                            $first_name = $userData['first_name'];
                                            $last_name = $userData['last_name'];
                                            $email = $userData['email'];
                                            $phone_number = $userData['phone_number'];
                                            $dob = $userData['dob'];
                                            $house_no = $userData['house_no'];
                                            $state = $userData['state'];
                                            $city = $userData['city'];
                                            $account_type = $userData['account_type'];
                                            $profile_url = $userData['profile_url'];

                                            $birthDateObj = new DateTime($dob);
                                            $currentDateObj = new DateTime();

                                            $age = $currentDateObj->diff($birthDateObj);

                                            $age = $age->y;

                                            echo '
                                            <a href="technician.php?technician_id=' . $technician_id . '" class="technician-card">
                                                <div class="technician-image">
                                                    <img src="./assets/images/technician/' . $profile_url . '" alt="">
                                                </div>
                                                <div class="technician-details">
                                                    <h3 class="technician-name">' . $first_name . ' ' . $last_name . '</h3>
                                                    <div class="technician-details-content">
                                                        <div class="technician-details-content-1">
                                                            <ul>
                                                                <li>City</li>
                                                                <li>Age</li>
                                                                <li>Cost per hours</li>
                                                                <li>Cost per day</li>
                                                                <li>Years of experience</li>
                                                            </ul>
                                                        </div>
                                                        <div class="technician-details-content-2">
                                                            <ul>
                                                                <li>' . $city . '</li>
                                                                <li>' . $age . '</li>
                                                                <li>Rs.' . $cost_per_hour . '</li>
                                                                <li>Rs.' . $cost_per_day . '</li>
                                                                <li>' . $work_experience . ' year</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="technician-stars">
                                                        <ul>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                        </ul>
                                                        <span>(200)</span>
                                                    </div>
                                                </div>
                                            </a>
                                            ';
                                        }
                                    }
                                }
                            } else if ($minCost !== "" && $maxCost !== "") {
                                $minCost = $conn->real_escape_string($minCost);
                                $maxCost = $conn->real_escape_string($maxCost);

                                $selectTechnicianQuery1 = "SELECT * FROM `technician` WHERE `cost_per_day` BETWEEN '$minCost' AND '$maxCost'";
                                $resultTechnician = $conn->query($selectTechnicianQuery1);

                                if ($resultTechnician->num_rows > 0) {
                                    while ($technicianData = $resultTechnician->fetch_assoc()) {
                                        $technician_id = $technicianData['technician_id'];
                                        $user_id = $technicianData['user_id'];
                                        $category = $technicianData['category'];
                                        $nic_number = $technicianData['nic_number'];
                                        $nic_photo_url = $technicianData['nic_photo_url'];
                                        $work_experience = $technicianData['work_experience'];
                                        $cost_per_day = $technicianData['cost_per_day'];
                                        $cost_per_hour = $technicianData['cost_per_hour'];
                                        $status = $technicianData['status'];
                                        $balance = $technicianData['balance'];

                                        $selectUserQuery = "SELECT * FROM `user` WHERE `user_id`='$user_id'";
                                        $resultUser = $conn->query($selectUserQuery);

                                        if ($resultUser->num_rows > 0) {
                                            $userData = $resultUser->fetch_assoc();

                                            $first_name = $userData['first_name'];
                                            $last_name = $userData['last_name'];
                                            $email = $userData['email'];
                                            $phone_number = $userData['phone_number'];
                                            $dob = $userData['dob'];
                                            $house_no = $userData['house_no'];
                                            $state = $userData['state'];
                                            $city = $userData['city'];
                                            $account_type = $userData['account_type'];
                                            $profile_url = $userData['profile_url'];

                                            $birthDateObj = new DateTime($dob);
                                            $currentDateObj = new DateTime();

                                            $age = $currentDateObj->diff($birthDateObj);

                                            $age = $age->y;

                                            echo '
                                            <a href="technician.php?technician_id=' . $technician_id . '" class="technician-card">
                                                <div class="technician-image">
                                                    <img src="./assets/images/technician/' . $profile_url . '" alt="">
                                                </div>
                                                <div class="technician-details">
                                                    <h3 class="technician-name">' . $first_name . ' ' . $last_name . '</h3>
                                                    <div class="technician-details-content">
                                                        <div class="technician-details-content-1">
                                                            <ul>
                                                                <li>City</li>
                                                                <li>Age</li>
                                                                <li>Cost per hours</li>
                                                                <li>Cost per day</li>
                                                                <li>Years of experience</li>
                                                            </ul>
                                                        </div>
                                                        <div class="technician-details-content-2">
                                                            <ul>
                                                                <li>' . $city . '</li>
                                                                <li>' . $age . '</li>
                                                                <li>Rs.' . $cost_per_hour . '</li>
                                                                <li>Rs.' . $cost_per_day . '</li>
                                                                <li>' . $work_experience . ' year</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="technician-stars">
                                                        <ul>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                        </ul>
                                                        <span>(200)</span>
                                                    </div>
                                                </div>
                                            </a>
                                            ';
                                        }
                                    }
                                }
                            } else if ($age1 !== "") {

                                $selectTechnicianQuery1 = "SELECT * FROM `technician` WHERE 1";
                                $resultTechnician = $conn->query($selectTechnicianQuery1);

                                if ($resultTechnician->num_rows > 0) {
                                    while ($technicianData = $resultTechnician->fetch_assoc()) {
                                        $technician_id = $technicianData['technician_id'];
                                        $user_id = $technicianData['user_id'];
                                        $category = $technicianData['category'];
                                        $nic_number = $technicianData['nic_number'];
                                        $nic_photo_url = $technicianData['nic_photo_url'];
                                        $work_experience = $technicianData['work_experience'];
                                        $cost_per_day = $technicianData['cost_per_day'];
                                        $cost_per_hour = $technicianData['cost_per_hour'];
                                        $status = $technicianData['status'];
                                        $balance = $technicianData['balance'];

                                        $selectUserQuery = "SELECT * FROM `user` WHERE `user_id`='$user_id'";
                                        $resultUser = $conn->query($selectUserQuery);

                                        if ($resultUser->num_rows > 0) {
                                            $userData = $resultUser->fetch_assoc();

                                            $first_name = $userData['first_name'];
                                            $last_name = $userData['last_name'];
                                            $email = $userData['email'];
                                            $phone_number = $userData['phone_number'];
                                            $dob = $userData['dob'];
                                            $house_no = $userData['house_no'];
                                            $state = $userData['state'];
                                            $city = $userData['city'];
                                            $account_type = $userData['account_type'];
                                            $profile_url = $userData['profile_url'];

                                            $birthDateObj = new DateTime($dob);
                                            $currentDateObj = new DateTime();

                                            $age = $currentDateObj->diff($birthDateObj);

                                            $age = $age->y;

                                            if ($age == $age1) {

                                                echo '
                                            <a href="technician.php?technician_id=' . $technician_id . '" class="technician-card">
                                                <div class="technician-image">
                                                    <img src="./assets/images/technician/' . $profile_url . '" alt="">
                                                </div>
                                                <div class="technician-details">
                                                    <h3 class="technician-name">' . $first_name . ' ' . $last_name . '</h3>
                                                    <div class="technician-details-content">
                                                        <div class="technician-details-content-1">
                                                            <ul>
                                                                <li>City</li>
                                                                <li>Age</li>
                                                                <li>Cost per hours</li>
                                                                <li>Cost per day</li>
                                                                <li>Years of experience</li>
                                                            </ul>
                                                        </div>
                                                        <div class="technician-details-content-2">
                                                            <ul>
                                                                <li>' . $city . '</li>
                                                                <li>' . $age1 . '</li>
                                                                <li>Rs.' . $cost_per_hour . '</li>
                                                                <li>Rs.' . $cost_per_day . '</li>
                                                                <li>' . $work_experience . ' year</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="technician-stars">
                                                        <ul>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                        </ul>
                                                        <span>(200)</span>
                                                    </div>
                                                </div>
                                            </a>
                                            ';
                                            }
                                        }
                                    }
                                }
                            } else if ($experience !== "") {

                                $selectTechnicianQuery1 = "SELECT * FROM `technician` WHERE `work_experience` = '$experience'";
                                $resultTechnician = $conn->query($selectTechnicianQuery1);

                                if ($resultTechnician->num_rows > 0) {
                                    while ($technicianData = $resultTechnician->fetch_assoc()) {
                                        $technician_id = $technicianData['technician_id'];
                                        $user_id = $technicianData['user_id'];
                                        $category = $technicianData['category'];
                                        $nic_number = $technicianData['nic_number'];
                                        $nic_photo_url = $technicianData['nic_photo_url'];
                                        $work_experience = $technicianData['work_experience'];
                                        $cost_per_day = $technicianData['cost_per_day'];
                                        $cost_per_hour = $technicianData['cost_per_hour'];
                                        $status = $technicianData['status'];
                                        $balance = $technicianData['balance'];

                                        $selectUserQuery = "SELECT * FROM `user` WHERE `user_id`='$user_id'";
                                        $resultUser = $conn->query($selectUserQuery);

                                        if ($resultUser->num_rows > 0) {
                                            $userData = $resultUser->fetch_assoc();

                                            $first_name = $userData['first_name'];
                                            $last_name = $userData['last_name'];
                                            $email = $userData['email'];
                                            $phone_number = $userData['phone_number'];
                                            $dob = $userData['dob'];
                                            $house_no = $userData['house_no'];
                                            $state = $userData['state'];
                                            $city = $userData['city'];
                                            $account_type = $userData['account_type'];
                                            $profile_url = $userData['profile_url'];

                                            $birthDateObj = new DateTime($dob);
                                            $currentDateObj = new DateTime();

                                            $age = $currentDateObj->diff($birthDateObj);

                                            $age = $age->y;

                                            echo '
                                            <a href="technician.php?technician_id=' . $technician_id . '" class="technician-card">
                                                <div class="technician-image">
                                                    <img src="./assets/images/technician/' . $profile_url . '" alt="">
                                                </div>
                                                <div class="technician-details">
                                                    <h3 class="technician-name">' . $first_name . ' ' . $last_name . '</h3>
                                                    <div class="technician-details-content">
                                                        <div class="technician-details-content-1">
                                                            <ul>
                                                                <li>City</li>
                                                                <li>Age</li>
                                                                <li>Cost per hours</li>
                                                                <li>Cost per day</li>
                                                                <li>Years of experience</li>
                                                            </ul>
                                                        </div>
                                                        <div class="technician-details-content-2">
                                                            <ul>
                                                                <li>' . $city . '</li>
                                                                <li>' . $age . '</li>
                                                                <li>Rs.' . $cost_per_hour . '</li>
                                                                <li>Rs.' . $cost_per_day . '</li>
                                                                <li>' . $work_experience . ' year</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="technician-stars">
                                                        <ul>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                        </ul>
                                                        <span>(200)</span>
                                                    </div>
                                                </div>
                                            </a>
                                            ';
                                        }
                                    }
                                }
                            } else {

                                $selectTechnicianQuery1 = "SELECT * FROM `technician` WHERE 1";
                                $resultTechnician = $conn->query($selectTechnicianQuery1);

                                if ($resultTechnician->num_rows > 0) {
                                    while ($technicianData = $resultTechnician->fetch_assoc()) {
                                        $technician_id = $technicianData['technician_id'];
                                        $user_id = $technicianData['user_id'];
                                        $category = $technicianData['category'];
                                        $nic_number = $technicianData['nic_number'];
                                        $nic_photo_url = $technicianData['nic_photo_url'];
                                        $work_experience = $technicianData['work_experience'];
                                        $cost_per_day = $technicianData['cost_per_day'];
                                        $cost_per_hour = $technicianData['cost_per_hour'];
                                        $status = $technicianData['status'];
                                        $balance = $technicianData['balance'];

                                        $selectUserQuery = "SELECT * FROM `user` WHERE `user_id`='$user_id'";
                                        $resultUser = $conn->query($selectUserQuery);

                                        if ($resultUser->num_rows > 0) {
                                            $userData = $resultUser->fetch_assoc();

                                            $first_name = $userData['first_name'];
                                            $last_name = $userData['last_name'];
                                            $email = $userData['email'];
                                            $phone_number = $userData['phone_number'];
                                            $dob = $userData['dob'];
                                            $house_no = $userData['house_no'];
                                            $state = $userData['state'];
                                            $city = $userData['city'];
                                            $account_type = $userData['account_type'];
                                            $profile_url = $userData['profile_url'];

                                            $birthDateObj = new DateTime($dob);
                                            $currentDateObj = new DateTime();

                                            $age = $currentDateObj->diff($birthDateObj);

                                            $age = $age->y;

                                            echo '
                                            <a href="technician.php?technician_id=' . $technician_id . '" class="technician-card">
                                                <div class="technician-image">
                                                    <img src="./assets/images/technician/' . $profile_url . '" alt="">
                                                </div>
                                                <div class="technician-details">
                                                    <h3 class="technician-name">' . $first_name . ' ' . $last_name . '</h3>
                                                    <div class="technician-details-content">
                                                        <div class="technician-details-content-1">
                                                            <ul>
                                                                <li>City</li>
                                                                <li>Age</li>
                                                                <li>Cost per hours</li>
                                                                <li>Cost per day</li>
                                                                <li>Years of experience</li>
                                                            </ul>
                                                        </div>
                                                        <div class="technician-details-content-2">
                                                            <ul>
                                                                <li>' . $city . '</li>
                                                                <li>' . $age . '</li>
                                                                <li>Rs.' . $cost_per_hour . '</li>
                                                                <li>Rs.' . $cost_per_day . '</li>
                                                                <li>' . $work_experience . ' year</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="technician-stars">
                                                        <ul>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                            <li>
                                                                <i class="bi bi-star-fill"></i>
                                                            </li>
                                                        </ul>
                                                        <span>(200)</span>
                                                    </div>
                                                </div>
                                            </a>
                                            ';
                                        }
                                    }
                                }
                            }



                            ?>


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
    <script src="./assets/js/user-technicians.js"></script>
</body>

</html>