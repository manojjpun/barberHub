<?php
// Include database connection
include 'database.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $file = $_FILES['file-input'];

    // Check if the file is an image
    $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        $message = "File is not an image.";
    } else {
        // Read the file content as binary data
        $imageData = file_get_contents($file['tmp_name']);
        $imageType = $file['type']; // Get MIME type

        // Insert image and details into the database
        $stmt = mysqli_prepare($conn, "INSERT INTO gallery (title, description, image_data, image_type, upload_date) VALUES (?, ?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, 'ssss', $title, $description, $imageData, $imageType);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Image uploaded and saved to database successfully.";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link rel="stylesheet" href="./CSS/upload.css">
</head>

<body>

    <?php include "header.php"; ?>
    
    <div class="message-container">
        <div class="message">
            <p><?php echo isset($message) ? $message : 'No message available.'; ?></p>
        </div>
        <a href="gallery.php" class="back-button">Go to Gallery</a>
    </div>

    <?php include "footer.php"; ?>

</body>

</html>
