<?php
// Include the database connection
include('db_connection.php');

// Fetch bookings grouped by date
$bookings_query = "
    SELECT booking_date, COUNT(*) as total_bookings FROM (
        SELECT booking_date FROM bookings
        UNION ALL
        SELECT dedication_date AS booking_date FROM child_dedication_bookings
        UNION ALL
        SELECT service_date AS booking_date FROM funeral_service_bookings
    ) AS combined_bookings
    GROUP BY booking_date
";

$result = $conn->query($bookings_query);

// Organize bookings by date and count
$booked_data = [];
while ($row = $result->fetch_assoc()) {
    $booked_data[$row['booking_date']] = $row['total_bookings'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Bookings</title>
    <style>
        /* Sidebar Styles */
        body {
            display: flex;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            color: #fff;
            width: 250px;
            padding-left: 20px;
            height: 100vh;
            background-image: linear-gradient(30deg, #11cf4d, #055e21);
        }
        .sidebar h2 {
            padding: 40px 0 0 0;
        }
        .sidebar a {
            font-size: 14px;
            color: #fff;
            display: block;
            padding: 12px;
            padding-left: 30px;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #56ff38;
            background: #fff;
            border-top-left-radius: 22px;
            border-bottom-left-radius: 22px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        /* Main Container */
        .container {
            margin-right: 250px;
            width: calc(100% - 250px);
            padding: 10px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-header h3 {
            margin: 0;
            font-size: 24px;
        }

        .calendar-header button,
        .calendar-header select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #055e21;
            border-radius: 5px;
            background-color: #11cf4d;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .calendar-header button:hover {
            background-color: #0a8c38;
        }

        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }

        .day {
            background-color: #11cf4d;
            color: #fff;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s;
        }

        .day.booked {
            background-color: #ff4d4d;
        }

        .day.limited {
            background-color: #ff8c1a;
        }

        .day:hover {
            background-color: #0a8c38;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
    </style>
    <script>
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        function renderCalendar() {
            const monthNames = [
                "January", "February", "March", "April", "May",
                "June", "July", "August", "September",
                "October", "November", "December"
            ];

            document.getElementById('month-name').textContent = `${monthNames[currentMonth]} ${currentYear}`;

            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const calendar = document.getElementById('calendar-days');
            calendar.innerHTML = '';

            const bookedData = <?php echo json_encode($booked_data); ?>;

            for (let day = 1; day <= daysInMonth; day++) {
                const date = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const bookingCount = bookedData[date] || 0;
                let dayClass = '';

                if (bookingCount >= 3) {
                    dayClass = 'booked';
                } else if (bookingCount > 0) {
                    dayClass = 'limited';
                }

                const dayElement = document.createElement('div');
                dayElement.className = `day ${dayClass}`;
                dayElement.innerHTML = `<div>${day}</div><small>${bookingCount}/3 bookings</small>`;

                if (dayClass !== 'booked') {
                    dayElement.onclick = () => manageBookings(date, bookingCount);
                }

                calendar.appendChild(dayElement);
            }
        }

        function prevMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        }

        function changeYear(year) {
            currentYear = parseInt(year);
            renderCalendar();
        }

        function manageBookings(date, bookingCount) {
            if (bookingCount >= 3) {
                alert("This day is fully booked. No additional bookings are allowed.");
            } else {
                const service = prompt("Enter the service type (Baptism, Child Dedication, Funeral):");
                if (service) {
                    alert(`Booking added for ${service} on ${date}`);
                    // Make an AJAX request to save the booking (you can implement this later)
                }
            }
        }

        window.onload = renderCalendar;
    </script>
</head>
<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <a href="bookings.php">Bookings</a>
        <a href="schedules.php">Schedules</a>
        <a href="users.php">Users</a>
        <a href="log_out.php">Log out</a>
    </div>

    <div class="container">
        <div class="calendar-header">
            <button onclick="prevMonth()">&lt;</button>
            <h3 id="month-name"></h3>
            <button onclick="nextMonth()">&gt;</button>
            <select onchange="changeYear(this.value)">
                <?php for ($year = 2020; $year <= 2030; $year++): ?>
                    <option value="<?php echo $year; ?>" <?php echo $year == date('Y') ? 'selected' : ''; ?>>
                        <?php echo $year; ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div id="calendar-days" class="calendar"></div>
        <div class="footer">© 2024 Church Admin</div>
    </div>
</body>
</html>
