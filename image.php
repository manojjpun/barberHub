<?php
// Enable error reporting for debugging (optional)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include 'database.php';

// Check if 'id' parameter is passed in the URL
if (isset($_GET['id'])) {
    $gallery_id = $_GET['id'];

    // Prepare and execute the SQL statement to fetch image data
    $stmt = mysqli_prepare($conn, "SELECT image_data, image_type FROM gallery WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $gallery_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the image data is found
    if ($image = mysqli_fetch_assoc($result)) {
        // Set the appropriate content type header
        header("Content-Type: " . $image['image_type']);
        // Output the image data
        echo $image['image_data'];
    } else {
        // If no image is found, display an error or a placeholder image
        header("Content-Type: image/png");
        echo file_get_contents("path/to/placeholder.png"); // Optional placeholder image
    }
} else {
    echo "No image ID specified.";
}
?>
