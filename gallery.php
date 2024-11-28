<?php
// Include database connection
include 'database.php';

// Fetch images from the database
$stmt = mysqli_query($conn, "SELECT * FROM gallery");
$images = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="./CSS/gallery.css">
</head>

<body>
    <?php include "header.php"; ?>

    <div class="gallery-layout-container">
        <span class="our-gallery-heading">Choose Your Styles</span>
        
        <div class="our-gallery">
            <?php
            foreach ($images as $image) {
                echo "<div class='gallery-grid' onclick='window.location=\"innerGallery.php?id=" . $image['id'] . "\"'>";

                // Display the image directly from binary data
                echo "<img class='gallery-image' src='data:" . $image['image_type'] . ";base64," . base64_encode($image['image_data']) . "' alt=''>";

                echo "<div class='gallery-grid-info'>";
                echo "<div class='gallery-title'>" . htmlspecialchars($image['title']) . "</div>";
                echo "<div class='gallery-description'>" . htmlspecialchars($image['description']) . "</div>";
                echo "</div>"; 
                echo "</div>"; 
            }
            ?>
        </div> 
    </div> 

    <?php include "footer.php"; ?>
</body>

</html>
