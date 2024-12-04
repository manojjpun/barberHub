<?php
include 'database.php';
session_start(); // Start session to access user data

// Check if the form has already been processed to avoid multiple redirects
if (isset($_SESSION['form_processed']) && $_SESSION['form_processed'] === true) {
    // If the form is already processed, don't process again
    header("Location: submitAppointment.php?id=" . $_POST['gallery_id']);
    exit();
}

// Get form data
$gallery_id = $_POST['gallery_id'];
$appointment_date = $_POST['appointment_date'];
$time_slot = $_POST['time_slot'];  // Retrieve the time slot
$comment = isset($_POST['comment']) ? trim($_POST['comment']) : null;

// Get the logged-in user's ID
$user_id = $_SESSION['user_id']; // Ensure that the user is logged in

// Prepare and execute SQL query to insert appointment
$stmt = mysqli_prepare($conn, "INSERT INTO appointments (gallery_id, user_id, appointment_date, time_slot, comment, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
mysqli_stmt_bind_param($stmt, 'iisss', $gallery_id, $user_id, $appointment_date, $time_slot, $comment);

if (mysqli_stmt_execute($stmt)) {
    // Set the success message in the session
    $_SESSION['success_message'] = "Your appointment is booked for $appointment_date at $time_slot.";
} else {
    // Set the error message in the session
    $_SESSION['error_message'] = "Error: " . mysqli_error($conn);
}

// Set a flag to indicate the form has been processed
$_SESSION['form_processed'] = true;

// Redirect to the same page after processing
header("Location: submitAppointment.php?id=$gallery_id");
exit();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <link rel="stylesheet" href="./CSS/submitAppointment.css">
</head>
<body>

    <?php include "header.php"; ?>

    <div class="appointment-confirmation-section">
        <div class="confirmation-message">
            <?php
            // Display the success or error message
            if (isset($_SESSION['success_message'])) {
                echo "<p class='success-message'>" . $_SESSION['success_message'] . "</p>";
                unset($_SESSION['success_message']); // Clear the message after displaying
            } elseif (isset($_SESSION['error_message'])) {
                echo "<p class='error-message'>" . $_SESSION['error_message'] . "</p>";
                unset($_SESSION['error_message']); // Clear the message after displaying
            }
            ?>
        </div>

        <a href="makeAppointment.php?id=<?php echo $gallery_id; ?>" class="back-button">Go Back</a>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>


