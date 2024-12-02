<?php
// Include the database connection
include 'database.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $gallery_id = $_GET['id'];

    // Fetch the gallery data using the ID from the database
    $stmt = mysqli_prepare($conn, "SELECT title FROM gallery WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $gallery_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $image = mysqli_fetch_assoc($result);

    // If no data is found, redirect to the gallery page
    if (!$image) {
        header('Location: gallery.php');
        exit;
    }
} else {
    header('Location: gallery.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Appointment</title>
    <link rel="stylesheet" href="./CSS/makeAppointment.css">
</head>

<body>

    <?php include "header.php" ?>;

    <div class="user-appointment-section">
        <div class="appointment-content">
            <!-- Display image -->
            <div class="appointment-image-container">
                <img src="image.php?id=<?php echo $gallery_id; ?>" alt="<?php echo htmlspecialchars($image['title']); ?>" class="appointment-image">
            </div>

            <!-- Display title and form -->
            <div class="appointment-details">
                <span class="appointment-title"><?php echo htmlspecialchars($image['title']); ?></span>

                <!-- Appointment form -->
                <form action="submitAppointment.php" method="POST" class="appointment-form">
                    <input type="hidden" name="gallery_id" value="<?php echo $gallery_id; ?>">

                    <div class="form-group">
                        <label for="appointment_date" class="form-label">Date:</label>
                        <input type="date" id="appointment_date" name="appointment_date" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="comment" class="form-label">Comments:</label>
                        <textarea id="comment" name="comment" class="form-textarea" placeholder="Enter any additional details or preferences"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-button">Book Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>;

</body>

</html>
