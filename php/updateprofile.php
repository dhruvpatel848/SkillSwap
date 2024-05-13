<?php
include('auth.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted
    if (isset($_POST['submit'])) {
        // Escape user inputs for security
        $new_username = $conn->real_escape_string($_POST['username']);
        $new_name = $conn->real_escape_string($_POST['name']);
        $new_email = $conn->real_escape_string($_POST['email']);
        $new_dob = $conn->real_escape_string($_POST['dob']);
        $new_no = $conn->real_escape_string($_POST['no']);
        $new_skill = $conn->real_escape_string($_POST['skill']);
        $new_country = $conn->real_escape_string($_POST['country']);

        // Update query
        $user_id = $_SESSION['id'];
        $update_query = "UPDATE users SET username='$new_username', name='$new_name' WHERE id=$user_id";

        if ($conn->query($update_query) === TRUE) {
            // Update successful
            echo "Profile updated successfully";
        } else {
            // Error updating profile
            echo "Error updating profile: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
