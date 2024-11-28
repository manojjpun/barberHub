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
        echo "File is not an image.";
        exit();
    }

    // Read the file content as binary data
    $imageData = file_get_contents($file['tmp_name']);
    $imageType = $file['type']; // Get MIME type

    // Insert image and details into the database
    $stmt = mysqli_prepare($conn, "INSERT INTO gallery (title, description, image_data, image_type, upload_date) VALUES (?, ?, ?, ?, NOW())");
    mysqli_stmt_bind_param($stmt, 'ssss', $title, $description, $imageData, $imageType);

    if (mysqli_stmt_execute($stmt)) {
        echo "Image uploaded and saved to database successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
