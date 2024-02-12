<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wall Calendar UI</title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
        } */

        .calendar {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
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
            cursor: pointer;
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
            background-color: #007bff;
            color: #fff;
        }


        @media(max-width:576px) {
            .calendar {
                width: calc(100% - 40px);
                overflow: auto;
            }
        }
    </style>
</head>

<body>

    <div class="calendar">
        <div class="calendar-header">
            <button class="calendar-nav" onclick="previousMonth()">&#8249;</button>
            <h2 id="calendar-month-year">February 2024</h2>
            <button class="calendar-nav" onclick="nextMonth()">&#8250;</button>
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

    <script>
        var eventData = [
            ["2024/02/01", "10.20pm", "Batch party"],
            ["2024/02/05", "9.00am", "Meeting"],
            ["2024/02/10", "2.30pm", "Team outing"],
            ["2024/02/14", "11.45am", "Client presentation"],
            ["2024/02/18", "3.00pm", "Training session"],
            ["2024/02/22", "8.30am", "Project deadline"],
            ["2024/02/25", "6.00pm", "Company event"],
            ["2024/03/28", "1.15pm", "Lunch with colleagues"],
        ];

        // Function to generate calendar
        // Function to generate calendar
        function generateCalendar(year, month) {
            var calendarBody = document.getElementById('calendar-body');
            var calendarHeader = document.getElementById('calendar-month-year');
            calendarBody.innerHTML = ''; // Clear existing calendar

            var date = new Date(year, month, 1);
            var startingDay = date.getDay(); // Get the starting day of the month
            var endDate = new Date(year, month + 1, 0).getDate(); // Get the last day of the month

            calendarHeader.textContent = monthNames[month] + ' ' + year;

            var currentRow = calendarBody.insertRow();
            var cellIndex = 0;
            var selectedCell = null; // Keep track of the currently selected cell

            // Insert empty cells for days before the starting day of the month
            for (var i = 0; i < startingDay; i++) {
                currentRow.insertCell();
                cellIndex++;
            }

            // Insert days of the month
            for (var day = 1; day <= endDate; day++) {
                var cell = currentRow.insertCell();
                cell.textContent = day;

                var dateStr = year + '/' + padNumber(month + 1) + '/' + padNumber(day);
                var eventInfo = getEventInfo(dateStr);

                if (eventInfo !== null) {
                    var dot = document.createElement('span');
                    dot.className = 'event-dot';
                    cell.appendChild(dot);
                    console.log(cell)
                }else{
                    cell.style.cursor= "pointer"; 
                }

                cellIndex++;
                if (cellIndex % 7 === 0 && day < endDate) { // Start a new row every 7 cells
                    currentRow = calendarBody.insertRow();
                    cellIndex = 0;
                }

                // Add event listener to each cell
                cell.addEventListener('click', function() {



                    var dateStr = year + '/' + padNumber(month + 1) + '/' + padNumber(this.textContent);
                    var eventInfo = getEventInfo(dateStr);

                    if (eventInfo !== null && eventInfo.length >= 2) {
                        alert('Event: ' + eventInfo[2] + '\nTime: ' + eventInfo[1]);
                    } else {
                        alert('No event information available for ' + dateStr);
                        if (selectedCell !== null) {
                            selectedCell.classList.remove('selected-date');
                        }
                        this.classList.add('selected-date');
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

</body>

</html>