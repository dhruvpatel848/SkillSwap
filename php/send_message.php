<?php
// Include the authentication file to establish a database connection
include 'auth.php';

// Check if the message is sent via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the message is set and not empty
    if(isset($_POST['message']) && !empty($_POST['message'])) {
        $message = $_POST['message'];

        // Prepare and execute the SQL query to insert the message into the database
        $stmt = $conn->prepare("INSERT INTO messages (sender, message, timestamp) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $sender, $message);

        // Set the sender (you may replace this with the actual sender's username)
        $sender = "YourSenderUsername";

        if ($stmt->execute()) {
            echo "Message sent successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Message is empty";
    }
} else {
    echo "Invalid request method";
}
?>
