<?php
include "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="./CSS/registration.css">

</head>

<body>
    <div class="signup-layout-container">
        <div class="signup-layout">
            <?php
            // Enable error reporting
            error_reporting(E_ALL);
            ini_set('display_errors', 1);


            // Initialize variables for errors and values
            $fullName = $email = $password = "";
            $fullNameError = $emailError = $passwordError = "";

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fullName = trim($_POST["fullname"]);
                $email = trim($_POST["email"]);
                $password = trim($_POST["password"]);

                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Validate full name
                if (empty($fullName)) {
                    $fullNameError = "Full name is required.";
                }

                //validate email
                if (empty($email)) {
                    $emailError = "Email is required.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailError = "Invalid email format.";
                } else {
                    // Check if the email already exists using a prepared statement
                    $query = "SELECT * FROM users WHERE email = ?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($result) > 0) {
                        // If email already exists, set an error
                        $emailExistsError = "This email is already registered.";
                    }
                    mysqli_stmt_close($stmt); // Close the statement
                }

                if (empty($password)) {
                    $passwordError = "Password is required.";
                } elseif (strlen($password) < 8) {
                    $passwordError = "Password must be at least 8 characters long.";
                }

                // Insert user into the database if no errors
                if (empty($fullNameError) && empty($emailError) && empty($passwordError) && empty($emailExistsError)) {
                    $role = "user";
                    $query = "INSERT INTO users (fullName, email, password,role) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "ssss", $fullName, $email, $passwordHash,$role);

                    if (mysqli_stmt_execute($stmt)) {
                        $successMessage = "Account created successfully!";
                        $fullName = $email = $password = ""; // Clear the form fields
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                    mysqli_stmt_close($stmt); // Close the statement
                }
            }
            ?>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h1 class="signup-title">Create an account</h1>
                <?php if (!empty($successMessage)) : ?>
                    <div class="success-message"><?= $successMessage ?></div>
                <?php endif; ?>
                <!-- Display error message if email already exists -->
                <!-- <?php if (!empty($emailExistsError)) : ?>
                    <span class="error-message<?= !empty($emailExistsError) ? 'visible' : '' ?>"><?= $emailExistsError ?></span>
                <?php endif; ?> -->
                <div class="form-group">
                    <input class="form-control" type="text" name="fullname" placeholder="Full name" value="<?= htmlspecialchars($fullName) ?>">
                    <span class="error-message <?= !empty($fullNameError) ? 'visible' : '' ?>"><?= $fullNameError ?></span>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="email" placeholder="Email" value="<?= htmlspecialchars($email) ?>">
                    <span class="error-message <?= !empty($emailError) ? 'visible' : '' ?>"><?= $emailError ?></span>
                    <!-- Display error message if email already exists -->
                    <?php if (!empty($emailExistsError)) : ?>
                        <span class="error-message visible"><?= $emailExistsError ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                    <span class="error-message <?= !empty($passwordError) ? 'visible' : '' ?>"><?= $passwordError ?></span>
                </div>

                <div class="form-button">
                    <button class="signup-button" type="submit" name="submit">Create account</button>
                </div>
                <div class="login-redirect">
                    <span>Already have an account?</span>
                    <span class="login-link-anker"><a class="login-link" href="./login.php">Log In</a></span>
                </div>
            </form>
        </div>
    </div>
</body>

</html>