<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$host = "localhost"; 
$username = "root";  
$password = "";      
$dbname = "barberHub"; 

// Disable exceptions for mysqli
mysqli_report(MYSQLI_REPORT_OFF);


// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>