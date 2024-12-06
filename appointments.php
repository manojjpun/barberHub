<?php
include 'database.php';

// Check if the status update has been requested
if (isset($_GET['complete_id'])) {
    $appointment_id = $_GET['complete_id'];

    // Update the appointment status to 'completed'
    $updateQuery = "UPDATE appointments SET status = 'completed' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'i', $appointment_id);
    mysqli_stmt_execute($stmt);
}

// Fetch all appointments with user and gallery details
$query = "
    SELECT 
        appointments.id,
        users.email, 
        gallery.title, 
        appointments.comment, 
        appointments.appointment_date, 
        gallery.image_data, 
        gallery.image_type, 
        appointments.status
    FROM 
        appointments
    INNER JOIN users ON appointments.user_id = users.id
    INNER JOIN gallery ON appointments.gallery_id = gallery.id
    WHERE appointments.status != 'completed'
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
                    <span>
                        <?php if ($row['status'] == 'completed') { ?>
                            <button class="complete-button" disabled>Completed</button>
                        <?php } else { ?>
                            <a style="text-decoration: none;" href="?complete_id=<?php echo $row['id']; ?>" class="complete-button">Complete</a>
                        <?php } ?>
                    </span>
                </div>
            <?php } ?>

        </div>
    </div>

</body>

</html>
