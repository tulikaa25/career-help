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

// Get all pending requests
$pending_sql = "SELECT * FROM callback_requests WHERE status = 'pending' ORDER BY request_time ASC";
$pending_result = $conn->query($pending_sql);

// Get all called requests
$called_sql = "SELECT * FROM callback_requests WHERE status = 'called' ORDER BY request_time ASC";
$called_result = $conn->query($called_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view_requests.css">
    <title>Callback Requests</title>
</head>
<body>
<div class="container">
<h2>Pending Callback Requests</h2>
<?php if ($pending_result->num_rows > 0): ?>
    <ul>
        <?php while($row = $pending_result->fetch_assoc()): ?>
            <li>
                ID: <?php echo $row['id']; ?> - 
                <?php echo $row['first_name'] . " " . $row['last_name'] . " - " . $row['phone'] . " (Requested on: " . $row['request_time'] . ")"; ?>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>No pending requests.</p>
<?php endif; ?>

<h2>Called Requests</h2>
<?php if ($called_result->num_rows > 0): ?>
    <ul>
        <?php while($row = $called_result->fetch_assoc()): ?>
            <li>
                ID: <?php echo $row['id']; ?> - 
                <?php echo $row['first_name'] . " " . $row['last_name'] . " - " . $row['phone'] . " (Requested on: " . $row['request_time'] . ")"; ?>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>No requests have been called yet.</p>
<?php endif; ?>
</div>

</body>
</html>
