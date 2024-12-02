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

                    <div class="available-slots" id="timeSlots">
                        <div class="time-book-status">
                            <div class="time-slot">
                                <span>6:00 - 6:30</span>
                                <button type="button" class="book-button">Book</button>
                            </div>
                            <div class="time-slot">
                                <span>6:30 - 7:00</span>
                                <button type="button" class="book-button">Book</button>
                            </div>
                            <div class="time-slot">
                                <span>7:00 - 7:30</span>
                                <button type="button" class="book-button">Book</button>
                            </div>
                            <div class="time-slot">
                                <span>7:30 - 8:00</span>
                                <button type="button" class="book-button">Book</button>
                            </div>
                            <div class="time-slot">
                                <span>8:00 - 8:30</span>
                                <button type="button" class="book-button">Book</button>
                            </div>
                            <div class="time-slot">
                                <span>8:00 - 8:30</span>
                                <button type="button" class="book-button">Book</button>
                            </div>
                            <div class="time-slot">
                                <span>8:00 - 8:30</span>
                                <button type="button" class="book-button">Book</button>
                            </div>
                        </div>
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

    <script>
        // Get the date input and time slots container
        const appointmentDate = document.getElementById('appointment_date');
        const timeSlots = document.getElementById('timeSlots');

        // Show time slots when a date is selected
        appointmentDate.addEventListener('change', function () {
            if (this.value) {
                timeSlots.style.display = 'flex'; // Show the time slots
            } else {
                timeSlots.style.display = 'none'; // Hide if no date is selected
            }
        });

        const bookButtons = document.querySelectorAll('.book-button');

        // Variable to store the currently selected button
        let selectedButton = null;

        // Add event listeners to each button
        bookButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Ignore clicks if the button is already booked
                if (this.classList.contains('booked-button')) {
                    return;
                }

                // If there's a previously selected button, reset its text and style
                if (selectedButton) {
                    selectedButton.textContent = 'Book';
                    selectedButton.classList.remove('booked-button');
                }

                // Set the current button as booked
                this.textContent = 'Booked';
                this.classList.add('booked-button');
                selectedButton = this; // Update the selected button
            });
        });
    </script>

</body>

</html>