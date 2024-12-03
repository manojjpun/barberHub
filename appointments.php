<?php
include 'database.php';

// Fetch all appointments with user and gallery details
$query = "
    SELECT 
        users.email, 
        gallery.title, 
        appointments.comment, 
        appointments.appointment_date, 
        gallery.image_data, 
        gallery.image_type 
    FROM 
        appointments
    INNER JOIN users ON appointments.user_id = users.id
    INNER JOIN gallery ON appointments.gallery_id = gallery.id
    ORDER BY appointments.created_at DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Appointments</title>
    <link rel="stylesheet" href="./CSS/tableHeadingData.css">
</head>

<body>

    <?php
    include "adminSidebar.php";
    include "adminMainContent.php";
    ?>

    <div class="admin-appointments-section">
        <div class="table-heading-data">
            <div class="table-heading">
                <span>EMAIL</span>
                <span>IMAGE</span>
                <span>TITLE</span>
                <span>COMMENTS</span>
                <span>DATE</span>
                <span>STATUS</span>
            </div>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="table-data">
                    <span><?php echo htmlspecialchars($row['email']); ?></span>
                    <span>
                        <img src="data:<?php echo $row['image_type']; ?>;base64,<?php echo base64_encode($row['image_data']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" width="100" height="100">
                    </span>
                    <span><?php echo htmlspecialchars($row['title']); ?></span>
                    <span><?php echo !empty($row['comment']) ? htmlspecialchars($row['comment']) : 'No comment'; ?></span>
                    <span><?php echo htmlspecialchars($row['appointment_date']); ?></span>
                    <button id="complete-btn-1" class="complete-button">Complete</button>
                </div>

            <?php } ?>

        </div>
    </div>

    <script>
        // Example: Select the button using its ID
        const completeButton = document.getElementById('complete-btn-1');

        if (completeButton) {
            completeButton.addEventListener('click', function () {
                // Change button text to 'Completed'
                this.textContent = 'Completed';
                
                // Disable the button to prevent further clicks
                this.disabled = true;

                // Optional: Change the button style to indicate it's completed
                this.style.backgroundColor = 'gray'; // Change color to indicate it is completed
            });
        }
    </script>

</body>

</html>