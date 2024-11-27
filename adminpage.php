<!DOCTYPE html>
<html>
    <head>
        <style>
            /* Sidebar Styles */
            body {
                display: flex;
                margin: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            div.sidebar {
                color: #fff;
                width: 250px;
                padding-left: 20px;
                height: 100vh;
                background-image: linear-gradient(30deg, #11cf4d, #055e21);
                position: fixed;
                top: 0;
                left: 0;
            }

            div.sidebar h2 {
                padding: 40px 0 0 0;
                text-align: center;
                font-size: 24px;
                margin-bottom: 20px;
            }

            div.sidebar a {
                font-size: 16px;
                color: #fff;
                display: block;
                padding: 12px;
                padding-left: 30px;
                text-decoration: none;
                transition: background-color 0.3s;
            }

            div.sidebar a:hover {
                background-color: #fff;
                color: #56ff38;
                border-radius: 22px;
            }

            .sidebar {
                color: #fff;
                width: 250px;
                padding: 20px;
                height: 100%; 
                background-image: linear-gradient(30deg, #11cf4d, #055e21);
                position: fixed;
            }

            .sidebar h2 {
                text-align: center;
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 20px;
            }

            .sidebar a {
                font-size: 16px;
                color: #fff;
                display: block;
                padding: 12px;
                text-decoration: none;
                transition: background-color 0.3s;
            }

        </style>
    </head>
    <body>
        <div class="sidebar">
            <h2>Admin</h2>
            <a href="bookings.php">Bookings</a>
            <a href="schedules.php">Schedules</a>
            <a href="users.php">Users</a>
            <a href="log_out.php">Log out</a>
        </div>
    </body>
</html>
