<?php
include 'database.php';
session_start(); // Start session to access user data

// Check if user is logged in and get their user ID
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die("Error: User not logged in.");
}

// Get form data
$gallery_id = $_POST['gallery_id'];
$appointment_date = $_POST['appointment_date'];
$comment = isset($_POST['comment']) ? trim($_POST['comment']) : null; // Retrieve the comment

// Prepare and execute SQL query to insert appointment
$stmt = mysqli_prepare($conn, "INSERT INTO appointments (gallery_id, user_id, appointment_date, comment, created_at) VALUES (?, ?, ?, ?, NOW())");
mysqli_stmt_bind_param($stmt, 'iiss', $gallery_id, $user_id, $appointment_date, $comment);

if (mysqli_stmt_execute($stmt)) {
    echo "<div class='success-message'>Your appointment is booked for $appointment_date.</div>";
} else {
    echo "Error: " . mysqli_error($conn);
}
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



    <div class="appointment-confirmation-section">
        <div class="confirmation-message">
            <?php if (isset($successMessage)) { ?>
                <p><?php echo $successMessage; ?></p>
            <?php } elseif (isset($errorMessage)) { ?>
                <p><?php echo $errorMessage; ?></p>
            <?php } ?>
        </div>

        <a href="makeAppointment.php?id=<?php echo $gallery_id; ?>" class="back-button">Go Back</a>
    </div>



</body>

</html>
