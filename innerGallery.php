<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/innerGallery.css">
</head>

<body>
    <?php include "header.php" ?>

    <div class="innerGallery-layout-container">
        <div class="innerGallery-layout">
            <div class="gallery-image-section">
                <img class="gallery-image" src="./IMAGES/_.jpeg" alt="">
            </div>
            <div class="gallery-info-section">
                <div class="gallery-title">
                    Mullet
                </div>
                <div class="gallery-image-description">
                    <div class="image-description">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta repellendus rerum nihil obcaecati blanditiis dignissimos ipsam minus aliquid neque unde eum, earum tempore in alias illum officia dolore ut nemo Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis reprehenderit repellendus, eaque voluptatibus doloremque temporibus illum deleniti explicabo at quod id nam rerum ab. Consectetur fugiat illo tenetur cupiditate explicabo?
                    </div>
                </div>
                <div class="edit-delete-control">
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">Delete</button>
                </div>

                <div class="gallery-appointment-button">
                    <button class="style-button">Make appointment with the style</button>
                </div>
            </div>
        </div>

    </div>

    <?php include "footer.php" ?>
</body>

</html> -->

<?php
// Include the database connection
include 'database.php';

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
    // If 'id' is not set, redirect to the gallery page
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
</head>

<body>
    <?php include "header.php"; ?>

    <div class="innerGallery-layout-container">
        <div class="innerGallery-layout">
            <div class="gallery-image-section">
                <!-- Display the image -->
                <img class="gallery-image" src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="">
            </div>
            <div class="gallery-info-section">
                <div class="gallery-title">
                    <!-- Display the title -->
                    <?php echo htmlspecialchars($image['title']); ?>
                </div>
                <div class="gallery-image-description">
                    <div class="image-description">
                        <!-- Display the description -->
                        <?php echo nl2br(htmlspecialchars($image['description'])); ?>
                    </div>
                </div>
                <div class="edit-delete-control">
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">Delete</button>
                </div>

                <div class="gallery-appointment-button">
                    <button class="style-button">Make appointment with the style</button>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>
