<?php
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "user_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$login_msg = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement to fetch user data
    $sql = "SELECT password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            $login_msg = "Login successful! Welcome back.";
            // Optionally, redirect to another page after successful login
            // header("Location: home.php");
            // exit();
        } else {
            $error_msg = "Invalid email or password.";
        }
    } else {
        $error_msg = "Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Result</title>
</head>
<body>

    <h2>Login</h2>

    <!-- Display Success or Error Message -->
    <?php if ($login_msg): ?>
        <p><?php echo $login_msg; ?></p>
        <!-- Optionally, redirect the user to another page after login -->
        <a href="index.html">Go to Home Page</a>
    <?php else: ?>
        <?php if ($error_msg): ?>
            <p style="color: red;"><?php echo $error_msg; ?></p>
        <?php endif; ?>

        <!-- Link back to the login form -->
        <a href="login.html">Go back to Login Form</a>
    <?php endif; ?>

</body>
</html>
