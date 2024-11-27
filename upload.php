<?php
// Include database connection
include 'database.php';

// Define target directory
$target_dir = "IMAGES/";
$target_file = $target_dir . basename($_FILES["file-input"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file is an actual image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file-input"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Limit file size (example: 5MB)
if ($_FILES["file-input"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats (JPG, JPEG, PNG, GIF)
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 due to an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// If everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["file-input"]["name"]) . " has been uploaded.";

        // Get form data
        $title = $_POST['title'];
        $description = $_POST['description'];

        // Insert file details into the database
        $stmt = mysqli_prepare($conn, "INSERT INTO gallery (title, description, image_path, upload_date) VALUES (?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, 'sss', $title, $description, $target_file);
        mysqli_stmt_execute($stmt);

        echo "Image details saved to database.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
