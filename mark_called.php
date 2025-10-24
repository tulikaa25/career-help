<?php
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "counselling";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = $_POST['id']; // Get the request ID from the form

    // Update the status to 'called'
    $sql = "UPDATE callback_requests SET status = 'called' WHERE id = $request_id";

    if ($conn->query($sql) === TRUE) {
        echo "Request marked as called successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mark_called.css">
    <title>Mark as Called</title>
</head>
<body>
<div class="container">
<h2>Mark Callback Request as Called</h2>

<form action="mark_called.php" method="post">
    <label for="id">Callback Request ID:</label><br>
    <input type="number" id="id" name="id" required><br><br>
    <input type="submit" id="submit" value="Mark as Called">
</form>
</div>


</body>
</html>
