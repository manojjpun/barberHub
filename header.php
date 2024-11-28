<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="./CSS/header.css">
</head>

<body>
    <div class="home-layout-container">
        <div class="header-section <?php echo isset($_SESSION['user_id']) ? 'logged-in' : ''; ?>">
            <div class="header-left-section">
                <span class="logo">barberHub</span>
            </div>
            <div class="header-middle-section">
                <a class="home-link" href="./home.php">Home</a>
                <a class="gallery-link" href="./gallery.php">Gallery</a>
            </div>
            <div class="header-right-section">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-greeting" onclick="toggleAppointmentLogout()">
                        <?= htmlspecialchars($_SESSION['fullName']) ?>
                    </div>

                    <div class="appointment-logout" id="appointment-logout" style="display: none;">
                        <button class="my-appointments-button" onclick="showAppointments()">My Appointments</button>
                        <hr>
                        <button class="logout-button" onclick="logout()">Logout</button>
                    </div>
                <?php else: ?>
                    <!-- If not logged in, show the login button -->
                    <button class="login-button" onclick="location.href='login.php'">Login</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle visibility of My Appointments and Logout buttons
        function toggleAppointmentLogout() {
            var appointmentLogoutDiv = document.getElementById("appointment-logout");
            if (appointmentLogoutDiv.style.display === "none") {
                appointmentLogoutDiv.style.display = "block";
            } else {
                appointmentLogoutDiv.style.display = "none";
            }
        }

        // Function to handle "My Appointments" button click
        function showAppointments() {
            alert("Displaying user appointments...");
            // Replace this with the actual action to show appointments
        }

        // Function to handle Logout
        function logout() {
            window.location.href = 'logout.php'; // Redirects to logout.php
        }
    </script>
</body>

</html>
