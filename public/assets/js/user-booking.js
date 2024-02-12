
// Function to generate calendar
function generateCalendar(year, month) {
    var calendarBody = document.getElementById('calendar-body');
    var calendarHeader = document.getElementById('calendar-month-year');
    calendarBody.innerHTML = ''; // Clear existing calendar

    var today = new Date();
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



        var date = new Date(year, month, day);

        if (date <= today) {
            cell.classList.add('past-date');
        } else {
            cell.addEventListener('click', handleCellClick);
            if (eventInfo !== null) {
                var dot = document.createElement('span');
                dot.className = 'event-dot';
                cell.appendChild(dot);
            } else {
                cell.style.cursor = "pointer";
            }
        }

        cellIndex++;
        if (cellIndex % 7 === 0 && day < endDate) {
            currentRow = calendarBody.insertRow();
            cellIndex = 0;
        }
    }

    function handleCellClick() {
        var dateStr = year + '/' + padNumber(month + 1) + '/' + padNumber(this.textContent);
        var eventInfo = getEventInfo(dateStr);

        if (eventInfo !== null && eventInfo.length >= 2) {
            // alert('Event: ' + eventInfo[2] + '\nTime: ' + eventInfo[1]);
        } else {
            if (selectedCell !== null) {
                selectedCell.classList.remove('selected-date');
            }

            document.getElementById("day").value = padNumber(this.textContent);
            document.getElementById("month").value = padNumber(month + 1);
            document.getElementById("year").value = year;

            this.classList.add('selected-date');
            selectedCell = this;
        }
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



let now = new Date();
let hours = now.getHours().toString().padStart(2, '0');
let minutes = now.getMinutes().toString().padStart(2, '0');
document.getElementById('time').value = `${hours}:${minutes}`;


