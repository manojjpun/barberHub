<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Redirect to login page if not logged in or not an admin
    header("Location: login.php");
    exit();
}

// Retrieve the full name of the admin from the session
$fullName = ucwords($_SESSION['fullName']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./CSS/admin.css">
</head>

<body>
    <div class="main-content-section">
        <div class="manage-flex">
            <span class="admin-title">Admin Panel</span>
            <div class="admin-logout-button">
                <button class="admin-button" onclick="toggleLogout()">
                    <!-- Display Admin Full Name -->
                    <?= htmlspecialchars($fullName) ?>
                </button>
                <button id="logoutButton" class="logout-button" onclick="logout()">Logout</button>
            </div>
        </div>
        <hr>
    </div>

    <script>
        // Function to toggle the visibility of the logout button
        function toggleLogout() {
            const logoutButton = document.getElementById('logoutButton');
            if (logoutButton.style.display === 'none' || logoutButton.style.display === '') {
                logoutButton.style.display = 'block'; // Show the logout button
            } else {
                logoutButton.style.display = 'none'; // Hide the logout button
            }
        }

        function logout() {
            // Redirect to logout script
            window.location.href = 'logout.php';
        }
    </script>
</body>

</html>