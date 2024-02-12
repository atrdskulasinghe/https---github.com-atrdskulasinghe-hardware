<?php
include "../config/database.php";
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: index.php');
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
}


if (!isset($_SESSION['first_name'])) {
    header('location: signup.php');
}

$phone_number = $house_no = $state = $city = $latitude = $longitude = "";
$phone_numberError = $house_noError = $stateError = $cityError = $latitudeError = "";

if (isset($_POST['previos'])) {
    header('location: signup.php');
}

if (isset($_POST['next'])) {

    $phone_number = $_POST['phone_number'];
    $house_no = $_POST['house_no'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    if (empty($phone_number)) {
        $phone_numberError = "Please enter your phone number";
    }

    if (empty($house_no)) {
        $house_noError = "Please enter your house no";
    }

    if (empty($state)) {
        $stateError = "Please enter your state";
    }

    if (empty($city)) {
        $cityError = "Please enter your city";
    }

    if (empty($latitude)) {
        $latitudeError = "Please select your location";
    }

    if (empty($phone_numberError) && empty($house_noError) && empty($stateError) && empty($cityError)  && empty($latitudeError)) {
        $_SESSION['phone_number'] = $phone_number;
        $_SESSION['house_no'] = $house_no;
        $_SESSION['state'] = $state;
        $_SESSION['city'] = $city;
        $_SESSION['latitude'] = $latitude;
        $_SESSION['longitude'] = $longitude;

        header('location: signup-s.php');
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./assets/css/user-nav-1.css">
    <link rel="stylesheet" href="./assets/css/user-nav-2.css">
    <link rel="stylesheet" href="./assets/css/user-menu.css">
    <link rel="stylesheet" href="./assets/css/user-search-bar.css">
    <link rel="stylesheet" href="./assets/css/user-footer.css">
    <link rel="stylesheet" href="./assets/css/user-style.css">
    <link rel="stylesheet" href="./assets/css/signup.css">
    <link rel="stylesheet" href="./assets/css/signup.css">
    <!-- <link rel="stylesheet" href="./assets/css/line-1.css"> -->
    <link rel="stylesheet" href="./assets/css/button.css">
    <link rel="stylesheet" href="./assets/css/input.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">

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
        <!-- section -->

        <section>
            <div class="all-signup">
                <div class="signup-box">
                    <div class="signup-line">
                        <div class="line-content <?php if (isset($_SESSION['account_type'])) {
                                                        if ($_SESSION['account_type'] == "customer") {
                                                            echo "active";
                                                        }
                                                    } ?>" id="line-content-1">
                            <div class="line-all-content-1">
                                <div class="line-circle line-circle-1 active">
                                    <p>1</p>
                                </div>
                                <div class="line line-1 active"></div>
                                <div class="line-circle line-circle-2 active">
                                    <p>2</p>
                                </div>
                                <div class="line  line-2 "></div>
                                <div class="line-circle line-circle-3 ">
                                    <p>3</p>
                                </div>
                            </div>
                        </div>
                        <div class="line-content <?php if (isset($_SESSION['account_type'])) {
                                                        if ($_SESSION['account_type'] !== "customer") {
                                                            echo "active";
                                                        }
                                                    } ?>" id="line-content-2">
                            <div class="line-all-content-2">
                                <div class="line-circle line-circle-1 active">
                                    <p>1</p>
                                </div>
                                <div class="line line-1 active"></div>
                                <div class="line-circle line-circle-2 active">
                                    <p>2</p>
                                </div>
                                <div class="line  line-2 "></div>
                                <div class="line-circle line-circle-3 ">
                                    <p>3</p>
                                </div>
                                <div class="line  line-3 "></div>
                                <div class="line-circle line-circle-4 ">
                                    <p>4</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="signup-content" method="post">
                        <div class="input-content">
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>Phone Number</p>
                                    <input type="text" name="phone_number" value="<?php
                                                                                    if (isset($_SESSION['phone_number'])) {
                                                                                        echo $_SESSION['phone_number'];
                                                                                    } else {
                                                                                        echo $phone_number;
                                                                                    } ?>">
                                    <p class="input-error"><?php echo $phone_numberError ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>House Number</p>
                                    <input type="text" name="house_no" value="<?php
                                                                                if (isset($_SESSION['house_no'])) {
                                                                                    echo $_SESSION['house_no'];
                                                                                } else {
                                                                                    echo $house_no;
                                                                                } ?>">
                                    <p class="input-error"><?php echo $house_noError ?></p>
                                </div>
                            </div>
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>State</p>
                                    <input type="text" name="state" value="<?php
                                                                            if (isset($_SESSION['state'])) {
                                                                                echo $_SESSION['state'];
                                                                            } else {
                                                                                echo $state;
                                                                            } ?>">
                                    <p class="input-error"><?php echo $stateError ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>City</p>
                                    <input type="text" name="city" value="<?php
                                                                            if (isset($_SESSION['city'])) {
                                                                                echo $_SESSION['city'];
                                                                            } else {
                                                                                echo $city;
                                                                            } ?>">
                                    <p class="input-error"><?php echo $cityError ?></p>
                                </div>
                            </div>
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>Select Location</p>
                                    <div id="map"></div>
                                    <p class="input-error"><?php echo $latitudeError ?></p>
                                    <input type="hidden" id="latitude" name="latitude">
                                    <input type="hidden" id="longitude" name="longitude">
                                </div>
                            </div>
                            <div class="right-button margin-top-40">
                                <input type="submit" value="Previos" name="previos">
                                <input type="submit" value="Next" name="next">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>
        <!-- footer -->

        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <script src="./assets/js/user-script.js"></script>


    <script>
        var map = L.map('map').setView([<?php
                                        if (isset($_SESSION['latitude'])) {
                                            echo $_SESSION['latitude'];
                                        } else {
                                            echo 6.9271;
                                        } ?>, <?php
                                            if (isset($_SESSION['longitude'])) {
                                                echo $_SESSION['longitude'];
                                            } else {
                                                echo 79.8612;
                                            } ?>], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        var marker;
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