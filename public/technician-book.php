<?php
include "../config/database.php";
include "../template/user-data.php";


session_start();

$user_id = $_SESSION['id'];

if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
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

if (isset($_GET['technician_id'])) {
    if (!empty($_GET['technician_id'])) {
        $technician_id = $_GET['technician_id'];
    } else {
        header('location: technicians.php');
    }
} else {
    header('location: technicians.php');
}

$selectTechnicianQuery1 = "SELECT * FROM `technician` WHERE `technician_id`= '$technician_id'";
$resultTechnician = $conn->query($selectTechnicianQuery1);

if ($resultTechnician->num_rows > 0) {
    $technicianData = $resultTechnician->fetch_assoc();
} else {
    header('location: technicians.php');
}

$state_error = $house_no_error = $city_error = $date_error = "";

if (isset($_POST['book'])) {
    $time = $_POST['time'];
    $house_no = $_POST['house_no'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $payment_method = $_POST['payment_method'];
    // $image = $_POST['book'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $date  = $_POST['date'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    if (empty($_POST['house_no'])) {
        $house_no_error = 'Please enter your house number';
    }

    if (empty($_POST['state'])) {
        $state_error = 'Please enter your state';
    }

    if (empty($_POST['city'])) {
        $city_error = 'Please enter your city';
    }

    if (empty($_POST['date'])) {
        $date_error = 'please select a date';
    }

    if (empty($house_no_error) && empty($state_error) && empty($city_error) && empty($date_error)) {

        // if ($payment_method == "card") {

        //     $selectLastBookingId = "SELECT `booking_id` FROM `booking` ORDER BY `booking_id` DESC LIMIT 1";
        //     $result = $conn->query($selectLastBookingId);
        //     $lastBookId = "1";
        //     if ($result && $result->num_rows > 0) {
        //         $row = $result->fetch_assoc();
        //         $lastBookId = $row['booking_id'] + 1;
        //     }

        //     $imageUrl = $lastBookId . "_image.jpg";

        //     $_SESSION['technician_id'] = $technician_id;
        //     $_SESSION['year'] = $year;
        //     $_SESSION['month'] = $month;
        //     $_SESSION['date'] = $date;
        //     $_SESSION['time'] = $time;
        //     $_SESSION['imageUrl'] = $imageUrl;
        //     $_SESSION['house_no'] = $house_no;
        //     $_SESSION['state'] = $state;
        //     $_SESSION['city'] = $city;
        //     $_SESSION['payment_method'] = $payment_method;

        //     $_SESSION['description'] = $description;
        //     $_SESSION['latitude'] = $latitude;
        //     $_SESSION['longitude'] = $longitude;

           
        //     $_SESSION['file_name'] = $_FILES["image"]["name"];
        //     $_SESSION['file_error'] = $_FILES["image"]["error"];
        //     $_SESSION['file_tmp_name'] = $_FILES["image"]["tmp_name"];

        //     $_SESSION['booking_id'] = $lastBookId;
        //     header('location: ./payment.php');
        // } else {
            $selectLastBookingId = "SELECT `booking_id` FROM `booking` ORDER BY `booking_id` DESC LIMIT 1";
            $result = $conn->query($selectLastBookingId);
            $lastBookId = "1";
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $lastBookId = $row['booking_id'] + 1;
            }

            $imageUrl = $lastBookId . "_image.jpg";

            $sql = "INSERT INTO `booking`(`technician_id`, `customer_id`, `status`, 
            `booked_date`, `booked_time`, `photo_url`, `house_no`, `state`, `city`, 
            `payment_status`, `payment_method`, `description`, `latitude`, `longitude`) VALUES 
            ('$technician_id','$user_id','pending','$year-$month-$date','$time','$imageUrl','$house_no','$state','$city'
            ,'pending', '$payment_method','$description','$latitude','$longitude')";

            $targetDirectory = "./assets/images/booking/";

            if ($conn->query($sql) === TRUE) {

                if (!empty($_FILES["image"]["name"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                    $newFileName = $lastBookId . "_image.jpg";
                    $targetFile = $targetDirectory . $newFileName;
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                        header('location: book-history.php');
                    }
                } else {
                    header('location: book-history.php');
                }
            }
        }
    // }
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
    <link rel="stylesheet" href="./assets/css/user-contact.css">
    <link rel="stylesheet" href="./assets/css/input.css">
    <link rel="stylesheet" href="./assets/css/user-booking.css">

    <link rel="stylesheet" href="./assets/css/signup.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

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
                <form class="booking-content" method="POST" enctype="multipart/form-data">
                    <div class="calendar-content">
                        <div class="calendar">
                            <div class="calendar-header">
                                <button class="calendar-nav" type="button" onclick="previousMonth()">&#8249;</button>
                                <h2 id="calendar-month-year">February 2024</h2>
                                <button class="calendar-nav" type="button" onclick="nextMonth()">&#8250;</button>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sun</th>
                                        <th>Mon</th>
                                        <th>Tue</th>
                                        <th>Wed</th>
                                        <th>Thu</th>
                                        <th>Fri</th>
                                        <th>Sat</th>
                                    </tr>
                                </thead>
                                <tbody id="calendar-body">
                                    <!-- Calendar days will be inserted here dynamically -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <p class="input-error margin-top-10"><?php echo $date_error ?></p>


                    <div class="other-details">

                        <div class="input-content">
                            <input type="hidden" id="day" name="date">
                            <input type="hidden" id="month" name="month">
                            <input type="hidden" id="year" name="year">
                            <div class="input-two-content">

                                <div class="input-two-content-1">
                                    <p>Select Time</p>
                                    <div class="time-content">
                                        <div class="time-selector">
                                            <input type="time" id="time" name="time">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-two-content-2">
                                    <p>House No</p>
                                    <input type="text" name="house_no" value="<?php echo $user_house_no ?>">
                                    <p class="input-error"><?php echo $house_no_error ?></p>
                                </div>
                            </div>

                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>state</p>
                                    <input type="text" name="state" value="<?php echo $user_state ?>">
                                    <p class="input-error"><?php echo $state_error ?></p>
                                </div>
                                <div class="input-two-content-2">
                                    <p>city</p>
                                    <input type="text" name="city" value="<?php echo $user_city ?>">
                                    <p class="input-error"><?php echo $city_error ?></p>
                                </div>
                            </div>
                            <div class="input-two-content">
                                <div class="input-two-content-1">
                                    <p>payment method</p>
                                    <select name="payment_method">
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                    </select>
                                    <!-- <p class="input-error">please enter your first name</p> -->
                                </div>
                                <div class="input-two-content-2">
                                    <div class="profile-image">
                                        <div class="profile-image-content-1">
                                            <p>Image</p>
                                            <img src="../assets/images/technician/" alt="" id="preview-image">
                                            <input type="file" id="file-input" name="image">
                                        </div>
                                        <div class="profile-image-content-2">
                                            <input type="button" class="btn" style="margin-left: 0; width: 100px;" value="Choose Photo" id="file-button" name="">
                                        </div>
                                    </div>
                                    <p class="input-error" style="margin-top:-20px;">
                                        <!-- <?php echo $nicImageError ?> -->
                                    </p>
                                </div>
                            </div>

                            <div class="input-one-content">
                                <p>description</p>
                                <textarea name="description" id="" cols="30" rows="10"></textarea>
                                <!-- <p class="input-error">please enter your first name</p> -->
                            </div>
                            <div class="input-one-content">
                                <!-- <div class="input-two-content-1"> -->
                                <p>Select Location</p>
                                <div id="map"></div>
                                <!-- <p class="input-error"><?php echo $latitudeError ?></p> -->
                                <input type="hidden" id="latitude" name="latitude" value=" <?php echo $user_latitude ?>">
                                <input type="hidden" id="longitude" name="longitude" value=" <?php echo $user_longitude ?>">
                                <!-- </div> -->
                            </div>
                            <div class="right-button">
                                <!-- <input type="submit"> -->
                                <!-- <input type="submit"> -->
                                <input type="submit" value="Book Now" name="book">
                            </div>
                        </div>
                    </div>
                </form>
        </section>
        <?php
        include "../template/user-footer.php";
        ?>
    </div>
    <?php

    $selectTechnicianQuery1 = "SELECT * FROM `booking` WHERE `technician_id`= '$technician_id'";
    $resultTechnician = $conn->query($selectTechnicianQuery1);

    $eventData = [];

    if ($resultTechnician->num_rows > 0) {
        while ($row = $resultTechnician->fetch_assoc()) {
            $date = date("Y/m/d", strtotime($row['booked_date']));
            $time = date("h.ia", strtotime($row['booked_time']));
            $event = $row['status'];

            if ($row['status'] !== "reject") {
                $eventData[] = [$date, $time, $event];
            }
        }
    }

    ?>

    <script>
        var eventData = <?php echo json_encode($eventData); ?>;
    </script>

    <script src="./assets/js/user-script.js"></script>
    <script src="./assets/js/user-booking.js"></script>
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