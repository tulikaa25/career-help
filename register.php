<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "user_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_msg = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (first_name, last_name, email, phone, password) 
            VALUES ('$first_name', '$last_name', '$email', '$phone', '$password')";

    if ($conn->query($sql) === TRUE) {
        $success_msg = "Registration successful!";
    } else {
        $error_msg = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>

    <!-- Display Success or Error Message -->
    <?php if ($success_msg): ?>
        <p style="color: green;"><?php echo $success_msg; ?></p>
        <a href="index.html">Go to Home Page</a> <!-- Link to home page -->
    <?php else: ?>
        <?php if ($error_msg): ?>
            <p style="color: red;"><?php echo $error_msg; ?></p>
        <?php endif; ?>

        <!-- Registration Form -->
        <form id="registrationForm" action="register.php" method="post">
            <label for="first_name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name" required><br><br>

            <label for="last_name">Last Name:</label><br>
            <input type="text" id="last_name" name="last_name" required><br><br>

            <label for="email">Email Address:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="phone">Phone Number:</label><br>
            <input type="text" id="phone" name="phone" required><br><br>

            <label for="password">Create Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Register">
        </form>
    <?php endif; ?>
</body>
</html>
