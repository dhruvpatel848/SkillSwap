<?php
include('config.php');

// Check if the user is logged in
// Assuming you have a session variable for user_id


// Fetch user details from database
$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed.");
}

if (mysqli_num_rows($result) == 0) {
    // User does not have a profile
    // Show option to create a profile
    echo "You don't have a profile. <a href='create_profile.php'>Create Profile</a>";
} else {
    // User has a profile, fetch and display
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $name = $row['name'];
    $email = $row['email'];
    $bio = $row['bio'];
    $birthday = $row['birthday'];
    $country = $row['country'];
    $phone = $row['phone'];
    $website = $row['website'];
    $twitter = $row['twitter'];
    $facebook = $row['facebook'];
    $google_plus = $row['google_plus'];
    $linkedin = $row['linkedin'];
    $instagram = $row['instagram'];

    // Display user profile
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>User Profile</title>
    </head>
    <body>
        <h1>Welcome, <?php echo $username; ?></h1>
        <p>Name: <?php echo $name; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Bio: <?php echo $bio; ?></p>
        <p>Birthday: <?php echo $birthday; ?></p>
        <p>Country: <?php echo $country; ?></p>
        <p>Phone: <?php echo $phone; ?></p>
        <p>Website: <?php echo $website; ?></p>
        <p>Twitter: <?php echo $twitter; ?></p>
        <p>Facebook: <?php echo $facebook; ?></p>
        <p>Google Plus: <?php echo $google_plus; ?></p>
        <p>LinkedIn: <?php echo $linkedin; ?></p>
        <p>Instagram: <?php echo $instagram; ?></p>
    </body>
    </html>
    <?php
}

// Close the database connection
mysqli_close($conn);
?>
