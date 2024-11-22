<?php
include "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            $email = $password = "";
            $emailError = $passwordError = "";
            $emailNotFoundError = ""; // Variable to store email not found error
            $loginError = ""; // Variable to store login error

            // Handle form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = trim($_POST["email"]);
                $password = trim($_POST["password"]);

                // Validate email
                if (empty($email)) {
                    $emailError = "Email is required.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailError = "Invalid email format.";
                }

                // Validate password
                if (empty($password)) {
                    $passwordError = "Password is required.";
                }

                // If email and password are valid, check if the user exists and the password matches
                if (empty($emailError) && empty($passwordError)) {
                    // Prepare SQL query to check if the email exists
                    $query = "SELECT * FROM users WHERE email = ?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    // If email does not exist
                    if (mysqli_num_rows($result) == 0) {
                        $emailNotFoundError = "Email not found. Please register.";
                    } else {
                        // If email exists, fetch user data
                        $user = mysqli_fetch_assoc($result);
                        // Verify the password
                        if (!password_verify($password, $user['password'])) {
                            $passwordInvalid = "Invalid password.";
                        } else {
                            // Successful login
                            header("Location: dashboard.php"); // Redirect to a secure page (e.g., dashboard)
                            exit();
                        }
                    }
                    mysqli_stmt_close($stmt);
                }
            }
            ?>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <h1 class="signup-title">Log In</h1>
                <!-- Display error message if email is not found -->
                <div class="form-group">
                    <input class="form-control" type="text" name="email" placeholder="Email" value="<?= htmlspecialchars($email) ?>">
                    <span class="error-message <?= !empty($emailError) ? 'visible' : '' ?>"><?= $emailError ?></span>
                    <!-- Display error message if email is not found -->
                    <?php if (!empty($emailNotFoundError)) : ?>
                        <span class="error-message visible"><?= $emailNotFoundError ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                    <span class="error-message <?= !empty($passwordError) ? 'visible' : '' ?>"><?= $passwordError ?></span>
                    <!-- Display error message if password is invalid -->
                    <?php if (!empty($passwordInvalid)) : ?>
                        <span class="error-message visible"><?= $passwordInvalid ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-button">
                    <button class="signup-button" type="submit" name="submit">Log In</button>
                </div>
                <div class="login-redirect">
                    <span>Don't have an account?</span>
                    <span class="login-link-anker"><a class="login-link" href="./registration.php">Register</a></span>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
