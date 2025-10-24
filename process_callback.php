<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "counselling";

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
    $city = $_POST['city'];
    $state = $_POST['state'];

    // Server-side validation for email and phone formats
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "Invalid email format.";
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $error_msg = "Invalid phone number format. Please enter a 10-digit phone number.";
    } else {
        // Check if a user with the same name, email, and pending status already exists
        $sql_check = "SELECT * FROM callback_requests 
                      WHERE first_name = '$first_name' 
                      AND last_name = '$last_name' 
                      AND email = '$email' 
                      AND status = 'pending'";
        $result = $conn->query($sql_check);

        if ($result->num_rows > 0) {
            $error_msg = "Appointment already scheduled. We'll reach out to you shortly!";
        } else {
            // No existing pending appointment found, proceed with the new registration
            $request_time = date("Y-m-d H:i:s");
            $sql = "INSERT INTO callback_requests (first_name, last_name, email, phone, city, state, request_time, status) 
                    VALUES ('$first_name', '$last_name', '$email', '$phone', '$city', '$state', '$request_time', 'pending')";

            if ($conn->query($sql) === TRUE) {
                $success_msg = "Your appointment has been registered successfully!";
            } else {
                $error_msg = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Callback</title>
</head>
<body>
    <h2>Request a Callback</h2>

    <!-- Display Success or Error Message -->
    <?php if ($success_msg): ?>
        <p style="color: green;"><?php echo $success_msg; ?></p>
        <a href="index.html">Go to Home Page</a>
    <?php elseif ($error_msg): ?>
        <p style="color: red;"><?php echo $error_msg; ?></p>
        <a href="index.html">Go to Home Page</a>
    <?php endif; ?>
</body>
</html>
