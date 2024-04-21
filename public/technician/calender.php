<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] == "customer") {
        header('location: ../index.php');
    } else if ($_SESSION['account_type'] == "cashier") {
        header('location: ../cashier/index.php');
    } else if ($_SESSION['account_type'] == "technician") {
        // header('location: ./technician/index.php');
        $user_id = $_SESSION['id'];
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
include "../../config/database.php";
include "../../template/user-data.php";

$technician_id;

$technician = "SELECT * FROM `technician` WHERE `user_id` = $user_id";
$resultTechnician = $conn->query($technician);

if ($resultTechnician->num_rows > 0) {
    $rowTechnician = $resultTechnician->fetch_assoc();

    $technician_id = $rowTechnician['technician_id'];
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
    <link rel="stylesheet" href="../assets/css/dashboard-wallet.css">
    <link rel="stylesheet" href="../assets/css/review.css">
    <link rel="stylesheet" href="../assets/css/dashboard-home.css">
    <link rel="stylesheet" href="../assets/css/dashboard-profile.css">
    <link rel="stylesheet" href="../assets/css/dashboard-review.css">
    <link rel="stylesheet" href="../assets/css/button.css">
    <link rel="stylesheet" href="../assets/css/card.css">
    <link rel="stylesheet" href="../assets/css/search.css">
    <link rel="stylesheet" href="../assets/css/input.css">
    <link rel="stylesheet" href="../assets/css/review.css">
    <link rel="stylesheet" href="../assets/css/stars.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        .calendar-content {
            width: calc(100% - 40px);
            padding: 10px 2px;
            margin: auto;
            overflow: auto;
        }



        .calendar {
            width: calc(100% - 40px);
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background-color: rgb(247, 247, 247)1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);

        }

        @media(max-width:768px) {
            .calendar-content {
                width: calc(100%);
                padding: 0;
            }

            .calendar {
                width: calc(100%);
                padding: 0;

            }
        }


        .calendar table {
            width: 100%;
            border-collapse: collapse;
        }

        .calendar th,
        .calendar td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .calendar th {
            background-color: #007bff;
            color: #fff;
        }

        .calendar td {
            /* */
            position: relative;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .calendar-header h2 {
            margin: 0;
        }

        .calendar-nav button {
            background: none;
            border: none;
            /* cursor: pointer; */
            font-size: 16px;
        }


        .event-dot {
            display: block;
            width: 5px;
            height: 5px;
            background-color: red;
            border-radius: 50%;
            position: absolute;
            bottom: 2px;
            left: 50%;
            transform: translateX(-50%);
        }

        .selected-date {
            background-color: rgb(0, 145, 255);
            color: #fff;
        }

        .past-date {
            background-color: rgb(177, 177, 177);
            color: white;
        }

        .calendar-nav {
            width: 40px;
            height: 30px;
            border-radius: 5px;
            background-color: #007bff;
            border: none;
            color: white;
            /* cursor: pointer; */
        }
    </style>
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
                <?php
                include "../../template/dashboard-menu.php";
                ?>
                <div class="menu-content">
                    <div class="menu-links">
                        <!-- menu link 1 -->
                        <div class="menu-link-button ">
                            <a href="./index.php">
                                <p><img src="../assets/images/ui/dashboard.png" alt="">Dashboard</p>
                            </a>
                        </div>

                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./booking.php">
                                <p><img src="../assets/images/ui/booking.png" alt="">Booking</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button active">
                            <a href="./calender.php">
                                <p><img src="../assets/images/ui/Calendar.png" alt="">Calendar</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./wallet.php">
                                <p><img src="../assets/images/ui/Wallet.png" alt="">My Wallet</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./salary-request.php">
                                <p><img src="../assets/images/ui/salary-request.png" alt="">Salary Request</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./feedback.php">
                                <p><img src="../assets/images/ui/Feedback.png" alt="">Feedback</p>
                            </a>
                        </div>
                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./message.php">
                                <p><img src="../assets/images/ui/messages.png" alt="">Messages</p>
                            </a>
                        </div>

                        <!-- menu link 1 -->
                        <div class="menu-link-button">
                            <a href="./history.php">
                                <p><img src="../assets/images/ui/history.png" alt="">History</p>
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

        <?php

        $startDate = date('Y-m-d', strtotime('-7 days'));
        $endDate = date('Y-m-d');

        $startDateMonth = date('Y-m-d', strtotime('-30 days'));
        $endDateMonth = date('Y-m-d');

        $todayIcome = 0;
        $thisWeekIcome = 0;
        $monthIcome = 0;
        $totalIncome = 0;

        $booking = "SELECT * FROM `booking` WHERE `technician_id` = $technician_id";
        $resultBooking = $conn->query($booking);

        if ($resultBooking->num_rows > 0) {
            while ($rowBooking = $resultBooking->fetch_assoc()) {

                $technician_id = $rowBooking['technician_id'];
                $customer_id = $rowBooking['customer_id'];
                $status = $rowBooking['status'];
                $booked_date = $rowBooking['booked_date'];
                $booked_time = $rowBooking['booked_time'];
                $accept_date = $rowBooking['accept_date'];
                $accept_time = $rowBooking['accept_time'];
                $start_date = $rowBooking['start_date'];
                $start_time = $rowBooking['start_time'];
                $finished_date = $rowBooking['finished_date'];
                $finished_time = $rowBooking['finished_time'];
                $photo_url = $rowBooking['photo_url'];
                $payment_status = $rowBooking['payment_status'];
                $payment_method = $rowBooking['payment_method'];
                $cost = $rowBooking['cost'];
                $description = $rowBooking['description'];

                $currentDate = date("Y-m-d");

                if ($currentDate == $finished_date) {
                    $todayIcome += $cost;
                }

                if ($finished_date >= $startDate && $finished_date <= $endDate) {
                    $thisWeekIcome += $cost;
                }

                if ($finished_date >= $startDateMonth && $finished_date <= $endDateMonth) {
                    $monthIcome += $cost;
                }

                $totalIncome += $cost;
            }
        }

        ?>
        <section class="active section">
            <div class="content">
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
                    <!-- <p class="input-error margin-top-10"><?php echo $date_error ?></p> -->

                </form>
            </div>
        </section>
        <!-- </div> -->
    </div>

    <?php
    $selectTechnicianQuery1 = "SELECT * FROM `booking` WHERE `technician_id`= '$technician_id'";
    $resultTechnician1 = $conn->query($selectTechnicianQuery1);

    $eventData = [];

    if ($resultTechnician1->num_rows > 0) {
        while ($row = $resultTechnician1->fetch_assoc()) {
            $date = date("Y/m/d", strtotime($row['booked_date']));
            $time = date("h.ia", strtotime($row['booked_time']));
            $event = $row['status'];

            if ($row['status'] !== "reject") {
                $eventData[] = [$date, $time, $event];
            }
        }
    }
?>


    <!-- // <script>
        //     var eventData = <?php echo json_encode($eventData); ?>;
        // 
    </script> -->


    <script>
        // var eventData = [
        //     ["2024/02/01", "10.20pm", "Batch party"],
        //     ["2024/02/05", "9.00am", "Meeting"],
        //     ["2024/02/10", "2.30pm", "Team outing"],
        //     ["2024/02/14", "11.45am", "Client presentation"],
        //     ["2024/02/18", "3.00pm", "Training session"],
        //     ["2024/02/22", "8.30am", "Project deadline"],
        //     ["2024/02/25", "6.00pm", "Company event"],
        //     ["2024/04/28", "1.15pm", "Lunch with colleagues"],
        // ];

        var eventData = <?php echo json_encode($eventData); ?>;

        // Function to generate calendar
        // Function to generate calendar
        function generateCalendar(year, month) {
            var calendarBody = document.getElementById('calendar-body');
            var calendarHeader = document.getElementById('calendar-month-year');
            calendarBody.innerHTML = ''; // Clear existing calendar

            var date = new Date(year, month, 1);
            var startingDay = date.getDay();
            var endDate = new Date(year, month + 1, 0).getDate(); 

            calendarHeader.textContent = monthNames[month] + ' ' + year;

            var currentRow = calendarBody.insertRow();
            var cellIndex = 0;
            var selectedCell = null; 

            for (var i = 0; i < startingDay; i++) {
                currentRow.insertCell();
                cellIndex++;
            }

            for (var day = 1; day <= endDate; day++) {
                var cell = currentRow.insertCell();
                cell.textContent = day;

                var dateStr = year + '/' + padNumber(month + 1) + '/' + padNumber(day);
                var eventInfo = getEventInfo(dateStr);

                if (eventInfo !== null) {
                    var dot = document.createElement('span');
                    dot.className = 'event-dot';
                    // cell.appendChild(dot);
                    // console.log(cell)
                    cell.style.cursor = "pointer";
                    cell.classList.add('selected-date');
                } else {
                    // cell.style.cursor = "pointer";
                }

                cellIndex++;
                if (cellIndex % 7 === 0 && day < endDate) { 
                    currentRow = calendarBody.insertRow();
                    cellIndex = 0;
                }

                cell.addEventListener('click', function() {
                    var dateStr = year + '/' + padNumber(month + 1) + '/' + padNumber(this.textContent);
                    var eventInfo = getEventInfo(dateStr);
                    
                    if (eventInfo !== null && eventInfo.length >= 2) {
                        // alert('Event: ' + eventInfo[2] + '\nTime: ' + eventInfo[1]);
                        window.location.href= "history-view.php?book_id=1";
                        
                    } else {
                        if (selectedCell !== null) {
                            // selectedCell.classList.remove('selected-date');
                        }
                        // this.classList.add('selected-date');
                        selectedCell = this;
                    }
                });
            }
        }

        function padNumber(num) {
            return num.toString().padStart(2, '0');
        }

        function getEventInfo(date) {
            for (var i = 0; i < eventData.length; i++) {
                if (eventData[i][0] === date) {
                    return eventData[i];
                }
            }
            return null;
        }

        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth();

        generateCalendar(currentYear, currentMonth);

        function previousMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar(currentYear, currentMonth);
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            generateCalendar(currentYear, currentMonth);
        }
    </script>

    <script src="../assets/js/dashboard-menu.js"></script>
    <script src="../assets/js/script.js"></script>
</body>

</html>