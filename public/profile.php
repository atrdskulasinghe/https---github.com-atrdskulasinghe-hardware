<?php
include "../config/database.php";
include "../template/user-data.php";

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


$first_name_error = '';
$last_name_error = '';
$email_error = '';
$phone_number_error = '';
$dob_error = '';
$house_no_error = '';
$state_error = '';
$city_error = '';
$account_type_error = '';
$profile_url_error = '';
$password_error = '';
$latitude_error = '';
$longitude_error = '';
$old_password_error = '';

if (isset($_POST['save'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    // $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $dob = $_POST['dob'];
    $house_no = $_POST['house_no'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    if (empty($first_name)) {
        $first_name_error = "First name is required.";
    }

    if (empty($last_name)) {
        $last_name_error = "Last name is required.";
    }

    // if (empty($email)) {
    //     $email_error = "Email is required.";
    // } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     $email_error = "Invalid email format.";
    // }

    if (empty($_POST['phone_number'])) {
        $phone_number_error = 'Please enter your phone number';
    }

    if (empty($_POST['dob'])) {
        $dob_error = 'Please enter your date of birth';
    }

    if (empty($_POST['house_no'])) {
        $house_no_error = 'Please enter your house number';
    }

    if (empty($_POST['state'])) {
        $state_error = 'Please enter your state';
    }

    if (empty($_POST['city'])) {
        $city_error = 'Please enter your city';
    }

    if (empty($_POST['latitude'])) {
        $latitude_error = 'Please select your location';
    }

    $updateUserQuery = "UPDATE `user` SET 
    `first_name` = '$first_name', 
    `last_name` = '$last_name', 
    `phone_number` = '$phone_number', 
    `dob` = '$dob', 
    `house_no` = '$house_no', 
    `state` = '$state', 
    `city` = '$city',
    `latitude` = '$latitude', 
    `longitude` = '$longitude'
    WHERE `user_id` = $user_id";

    $passwordOk = false;

    if (!empty($_POST['password'])) {
        if (!empty($_POST['old_password'])) {
            // Sanitize and validate input data
            $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $selectUserEmailQuery = "SELECT * FROM `user` WHERE `user_id`= '$user_id'";
            $resultUserEmail = $conn->query($selectUserEmailQuery);

            if ($resultUserEmail) {
                if ($resultUserEmail->num_rows > 0) {
                    $userData = $resultUserEmail->fetch_assoc();
                    if (password_verify($old_password, $userData['password'])) {
                        $updateUserQuery = "UPDATE `user` SET 
                        `first_name` = '$first_name', 
                        `last_name` = '$last_name', 
                        `phone_number` = '$phone_number', 
                        `dob` = '$dob', 
                        `house_no` = '$house_no', 
                        `state` = '$state', 
                        `city` = '$city',
                        `latitude` = '$latitude', 
                        `longitude` = '$longitude',
                        `password` = '$hashedPassword'
                        WHERE `user_id` = $user_id";
                        $passwordOk = true;
                    } else {
                        $old_password_error = 'Your old password is invalid';
                    }
                }
            }
        } else {
            $old_password_error = 'Please enter your old password';
        }
    }

    $targetDirectory = "./assets/images/customer/";

    if (
        empty($first_name_error) && empty($last_name_error) && empty($phone_number_error)
        && empty($dob_error) && empty($house_no_error) && empty($state_error) && empty($city_error) && empty($password_error)
        && empty($old_password_error) && empty($latitude_error)
    ) {
        if ($conn->query($updateUserQuery) === TRUE) {
            // profile image save
            if (!empty($_FILES["profile_image"]["name"]) && $_FILES["profile_image"]["error"] == UPLOAD_ERR_OK) {
                $newFileName = $user_id . "_profile.jpg";
                $targetFile = $targetDirectory . $newFileName;
                if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {

                    if ($passwordOk) {
                        header('location: ./logout.php');
                    }
                }
            }else{
                if ($passwordOk) {
                    header('location: ./logout.php');
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="./assets/css/user-nav-1.css">
    <link rel="stylesheet" href="./assets/css/user-nav-2.css">
    <link rel="stylesheet" href="./assets/css/user-menu.css">
    <link rel="stylesheet" href="./assets/css/user-search-bar.css">
    <link rel="stylesheet" href="./assets/css/user-footer.css">
    <link rel="stylesheet" href="./assets/css/user-style.css">
    <link rel="stylesheet" href="./assets/css/button.css">
    <link rel="stylesheet" href="./assets/css/dashboard-history.css">
    <link rel="stylesheet" href="./assets/css/user-profile.css">
    <link rel="stylesheet" href="./assets/css/input.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map {
            height: 200px;
            width: 100%;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        include "../template/user-nav.php";
        ?>
        <?php
        include "../template/user-menu.php";
        ?>
        <div class="search-bar">
            <div class="box">
                <div class="search-input-box">
                    <input type="text" placeholder="Search">
                    <button>
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <section>
            <div class="user-cart">
                <div class="box">
                    <form class="user-profile" method="post" enctype="multipart/form-data">
                        <div class="user-profile-content">
                            <div class="user-profile-content-1">
                                <h1>Basic Information</h1>
                                <p>Edit your account details and settings.</p>
                            </div>
                            <div class="user-profile-content-2">
                                <div class="user-profile-image">
                                    <div class="user-profile-image-content-1">
                                        <h2>AVATAR</h2>
                                        <img src="./assets/images/customer/<?php echo $user_profile_url ?>" alt="" id="preview-image">
                                        <input type="file" id="file-input" name="profile_image">
                                    </div>
                                    <div class="user-profile-image-content-2">
                                        <input type="button" class="btn" value="Choose Photo" id="file-button">
                                    </div>
                                </div>
                                <div class="input-content">
                                    <div class="input-two-content">
                                        <div class="input-two-content-1">
                                            <p>First Name</p>
                                            <input type="text" value="<?php if (isset($user_first_name)) {
                                                                            echo $user_first_name;
                                                                        } ?>" name="first_name">
                                            <p class="input-error"><?php echo $first_name_error; ?></p>
                                        </div>
                                        <div class="input-two-content-2">
                                            <p>Last Name</p>
                                            <input type="text" value="<?php if (isset($user_last_name)) {
                                                                            echo $user_last_name;
                                                                        } ?>" name="last_name">
                                            <p class="input-error"><?php echo $last_name_error; ?></p>
                                        </div>
                                    </div>


                                    <div class="input-two-content">
                                        <div class="input-two-content-1">
                                            <p>email</p>
                                            <input type="text" disabled value="<?php if (isset($user_email)) {
                                                                                    echo $user_email;
                                                                                } ?>" name="email">
                                            <p class="input-error"><?php echo $email_error; ?></p>
                                        </div>
                                        <div class="input-two-content-2">
                                            <p>phone number</p>
                                            <input type="text" value="<?php if (isset($user_phone_number)) {
                                                                            echo $user_phone_number;
                                                                        } ?>" name="phone_number">
                                            <p class="input-error"><?php echo $phone_number_error; ?></p>
                                        </div>
                                    </div>


                                    <div class="input-two-content">
                                        <div class="input-two-content-1">
                                            <p>Date of Birth</p>
                                            <input type="date" value="<?php if (isset($user_dob)) {
                                                                            echo $user_dob;
                                                                        } ?>" name="dob">
                                            <p class="input-error"><?php echo $dob_error; ?></p>
                                        </div>
                                        <div class="input-two-content-2">
                                            <p>house no</p>
                                            <input type="text" value="<?php if (isset($user_house_no)) {
                                                                            echo $user_house_no;
                                                                        } ?>" name="house_no">
                                            <p class="input-error"><?php echo $house_no_error; ?></p>
                                        </div>
                                    </div>

                                    <div class="input-two-content">
                                        <div class="input-two-content-1">
                                            <p>state</p>
                                            <input type="text" value="<?php if (isset($user_state)) {
                                                                            echo $user_state;
                                                                        } ?>" name="state">
                                            <p class="input-error"><?php echo $state_error; ?></p>
                                        </div>
                                        <div class="input-two-content-2">
                                            <p>city</p>
                                            <input type="text" value="<?php if (isset($user_city)) {
                                                                            echo $user_city;
                                                                        } ?>" name="city">
                                            <p class="input-error"><?php echo $city_error; ?></p>
                                        </div>
                                    </div>

                                    <div class="input-two-content">
                                        <div class="input-two-content-1">
                                            <p>Select Location</p>
                                            <div id="map"></div>
                                            <p class="input-error"><?php echo $latitude_error ?></p>
                                            <input type="hidden" id="latitude" name="latitude" value="<?php if (isset($user_latitude)) {
                                                                                                            echo $user_latitude;
                                                                                                        } ?>">
                                            <input type="hidden" id="longitude" name="longitude" value="<?php if (isset($user_longitude)) {
                                                                                                            echo $user_longitude;
                                                                                                        } ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="user-profile-content margin-top-20">
                            <div class="user-profile-content-1">
                                <h1>security Information</h1>
                                <p>Edit your account details and settings.</p>
                            </div>
                            <div class="user-profile-content-2">
                                <div class="input-content">
                                    <div class="input-two-content">
                                        <div class="input-two-content-1">
                                            <p>Old Password</p>
                                            <input type="password" name="old_password">
                                            <p class="input-error"><?php echo $old_password_error ?></p>
                                        </div>
                                        <div class="input-two-content-2">
                                            <p>New Password</p>
                                            <input type="password" name="password">
                                            <p class="input-error"><?php echo $password_error ?></p>
                                        </div>
                                    </div>
                                    <div class="right-button">
                                        <!-- <input type="submit"> -->
                                        <!-- <input type="submit"> -->
                                        <input type="submit" value="Save" name="save">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>
    <script src="./assets/js/profile.js"></script>

    <script>
        var map = L.map('map').setView([
            <?php
            if (isset($user_latitude)) {
                echo $user_latitude;
            } else {
                echo 6.9271;
            }
            ?>,
            <?php
            if (isset($user_longitude)) {
                echo $user_longitude;
            } else {
                echo 79.8612;
            }
            ?>
        ], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        var marker;
        <?php if (isset($user_latitude) && isset($user_longitude)) { ?>
            marker = new L.Marker([<?php echo $user_latitude; ?>, <?php echo $user_longitude; ?>]).addTo(map);
        <?php } ?>
        map.on('click', function(e) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = new L.Marker(e.latlng).addTo(map);
            document.getElementById('latitude').value = e.latlng.lat.toFixed(6);
            document.getElementById('longitude').value = e.latlng.lng.toFixed(6);
        });
    </script>

</body>

</html>