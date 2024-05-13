<?php
include('auth.php');
if(isset($_GET['keyword']) && isset($_GET['search_type'])) {
    $keyword = $_GET['keyword'];
    $search_type = $_GET['search_type'];

    // Modify the SQL query to include skill searching
    if($search_type === 'name') {
        $query = "SELECT * FROM users WHERE username LIKE '%$keyword%'";
    } else {
        $query = "SELECT * FROM users WHERE skill LIKE '%$keyword%'";
    }
} else {
    // If no search keyword is provided, fetch all users
    $query = "SELECT * FROM users";
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td><img src='" . $row['photo'] . "' alt='' />" . $row['username'] . "</td>";
        echo "<td>" . $row['skill'] . "</td>";
        echo "<td>" . $row['rating'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No co-workers found</td></tr>";
}
?>
