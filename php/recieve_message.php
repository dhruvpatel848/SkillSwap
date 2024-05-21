<?php
// Include the authentication file to establish a database connection
include 'auth.php';

// Prepare and execute the SQL query to select recent messages from the database
$sql = "SELECT * FROM messages ORDER BY timestamp DESC LIMIT 10"; // Change the limit as per your requirement
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div><strong>" . $row["sender"] . ":</strong> " . $row["message"] . "</div>";
    }
} else {
    echo "No messages";
}

// Close the database connection
$conn->close();
?>
