<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = "localhost"; // Database host
$username = "root";  // Database username
$password = "";      // Database password
$dbname = "barberHub"; // Database name

// Disable exceptions for mysqli
mysqli_report(MYSQLI_REPORT_OFF);


// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }else {
//     echo "Connection successful!";
// }
?>