<?php
// Include the database connection
include 'database.php';
session_start();

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $gallery_id = $_GET['id'];

    // Fetch the gallery data using the ID from the database
    $stmt = mysqli_prepare($conn, "SELECT * FROM gallery WHERE id = ?");
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

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && $_SESSION['role'] === 'admin') {
    $delete_stmt = mysqli_prepare($conn, "DELETE FROM gallery WHERE id = ?");
    mysqli_stmt_bind_param($delete_stmt, 'i', $gallery_id);
    mysqli_stmt_execute($delete_stmt);

    // Redirect to the gallery page after deletion
    header('Location: gallery.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inner Gallery</title>
    <link rel="stylesheet" href="./CSS/innerGallery.css">
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this image?");
        }
    </script>
</head>

<body>
    <?php include "header.php"; ?>

    <div class="innerGallery-layout-container">
        <div class="innerGallery-layout">
            <div class="gallery-image-section">
                <img class="gallery-image" src="image.php?id=<?php echo $gallery_id; ?>" alt="<?php echo htmlspecialchars($image['title']); ?>">
            </div>
            <div class="gallery-info-section">
                <div class="gallery-title">
                    <?php echo htmlspecialchars($image['title']); ?>
                </div>
                <div class="gallery-image-description">
                    <div class="image-description">
                        <?php echo nl2br(htmlspecialchars($image['description'])); ?>
                    </div>
                </div>

                <div class="delete-control">

                    <!-- Delete button -->
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') { ?>
                        <!-- Delete button for admin -->
                        <form method="POST" onsubmit="return confirmDelete();">
                            <input type="hidden" name="delete" value="1">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    <?php } ?>

                </div>

                <div class="gallery-appointment-button" onclick="location.href='makeAppointment.php?id=<?php echo $gallery_id; ?>'">
                    <button class="style-button">Make appointment with the style</button>
                </div>

            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>