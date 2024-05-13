<?php
// Include your database configuration file
include('auth.php');

// Check if the user is logged in
// Assuming you have a session variable for user_id
if (!isset($_SESSION['id'])) {
    // Redirect to login page or handle not logged in user
    header("Location: login.php");
    exit();
}

// Fetch user profile data
$user_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($query);

if (!$result) {
    die("Database query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
    $name = $row['name'];
    // You can fetch more fields like password if needed

    // Display user data in HTML
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="settings/style.css"-->
        <link rel="icon" href="home/img/logo.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Members | SkillSwap</title>
    </head>

    <body>

        <!-- Sidebar -->
        <div class="sidebar">
            <a href="index.html" class="logo">
                <!-- <i class='bx bx-code-alt'></i> -->
                <p>&ensp;</p>
                <img src="images/logo.png" alt="logo" width="34" height="34">
                <p>&ensp;</p>
                <p>&nbsp;</p>
                <div class="logo-name"><span>Skill</span>Swap</div>
            </a>
            <ul class="side-menu">
                <li><a href="members.html"><i class='bx bxs-dashboard'></i>Members</a></li>
                <li><a href="clubs.html"><i class='bx bx-analyse'></i>Clubs</a></li>
                <li><a href="library.html"><i class='bx bx-store-alt'></i>Library</a></li>
                <li><a href="#"><i class='bx bx-message-square-dots'></i>Peer Chat</a></li>
                <li><a href="#"><i class='bx bx-group'></i>Profile</a></li>
                <li class="active"><a href="settings.html"><i class='bx bx-cog'></i>Settings</a></li>
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="#" class="logout">
                        <i class='bx bx-log-out-circle'></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
        <!-- End of Sidebar -->

        <!-- Main Content -->
        <div class="content">
            <!-- Navbar -->
            <nav>
                <i class='bx bx-menu'></i>
                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                    </div>
                </form>
                <input type="checkbox" id="theme-toggle" hidden>
                <label for="theme-toggle" class="theme-toggle"></label>
                <!-- <a href="#" class="notif">
                    <i class='bx bx-bell bx-sm'></i>
                    <span class="count">12</span>
                </a> -->


                <a href="#" class="profile">
                    <img src="images/logo.png">
                </a>
            </nav>
            <!-- End of Navbar -->

            <main>
                <div class="container light-style flex-grow-1 container-p-y">
                    <a href="#" class="active-back">
                        <img src="settings/arrow-alt-circle-left.png" alt="">
                    </a>

                    <h4 class="font-weight-bold py-3 mb-4">
                        Account settings
                    </h4>
                    <div class="card overflow-hidden">
                        <div class="row no-gutters row-bordered row-border-light">
                            <div class="col-md-3 pt-0">
                                <div class="list-group list-group-flush account-settings-links">
                                    <a class="list-group-item list-group-item-action active" data-toggle="list"
                                        href="#account-general">General</a>
                                    <a class="list-group-item list-group-item-action" data-toggle="list"
                                        href="#account-change-password">Change password</a>
                                    <a class="list-group-item list-group-item-action" data-toggle="list"
                                        href="#account-info">Info</a>
                                    <a class="list-group-item list-group-item-action" data-toggle="list"
                                        href="#account-social-links">Social links</a>
                                    <a class="list-group-item list-group-item-action" data-toggle="list"
                                        href="#account-connections">Connections</a>
                                    <a class="list-group-item list-group-item-action" data-toggle="list"
                                        href="#account-notifications">Notifications</a>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content">
                                    <!-- Your PHP code will go here to display user profile information -->
                                    <!-- I've included a basic structure for the profile -->
                                    <div class="tab-pane fade active show" id="account-general">
                                        <div class="card-body media align-items-center">
                                            <!-- Display user profile picture -->
                                            <img src="<?php echo $row['profile_picture']; ?>"
                                                alt class="d-block ui-w-80">
                                            <div class="media-body ml-4">
                                                <label class="btn btn-outline-primary">
                                                    Upload new photo
                                                    <input type="file" class="account-settings-fileinput">
                                                </label> &nbsp;
                                                <button type="button"
                                                    class="btn btn-default md-btn-flat">Reset</button>
                                                <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of
                                                    800K
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="border-light m-0">
                                        <div class="card-body">
                                            <!-- Display user information -->
                                            <div class="form-group">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control mb-1"
                                                    value="<?php echo $username; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Name</label>
                                                <input

 type="text" class="form-control" value="<?php echo $name; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">E-mail</label>
                                                <input type="text" class="form-control mb-1"
                                                    value="<?php echo $email; ?>">
                                                <!-- You can add more profile fields here -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of PHP displayed content -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-3">
                        <button type="button" class="btn btn-primary">Save changes</button>&nbsp;
                        <button type="button" class="btn btn-default">Cancel</button>
                    </div>
                </div>
            </main>

        </div>

        <script src="members.js"></script>
        <script data-cfasync="false"
            src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
        </script>
    </body>

    </html>

    <?php
} else {
    echo "No user found.";
}

// Close the database connection
$conn->close();
?>
