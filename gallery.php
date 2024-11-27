

 <?php

include 'database.php';


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
                echo "<img class='gallery-image' src='" . $image['image_path'] . "' alt=''>";
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


