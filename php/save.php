<?php
include('auth.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

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
    $dob = $row['dob'];
    $no = $row['no'];
    $skill = $row['skill'];
    $country = $row['country'];
    $photo = $row['photo'];

    if(isset($_POST['submit'])) {
        $new_name = $_POST['name'];
        $new_username = $_POST['username'];
        $new_email = $_POST['email'];
        $new_skill = $_POST['skill'];

        $update_query = "UPDATE users SET name = '$new_name', username = '$new_username', email = '$new_email', skill ='$new_skill' WHERE id = $user_id";
        $update_result = $conn->query($update_query);

        if($update_result) {
            header("Location: main.php");
            exit();
        } else {
            echo "Error updating data: " . $conn->error;
        }
    }

    if (isset($_POST['submit_photo'])) {
        $filename = $_FILES["photo"]["name"];
        $tempname = $_FILES["photo"]["tmp_name"];
        $folder = "./uploads/" . $filename;
        $filename_with_path = "uploads/" . $filename;
        if (move_uploaded_file($tempname, $folder)) {
            $insert_query = "UPDATE users SET photo = '$filename_with_path' WHERE id = $user_id";
            if ($conn->query($insert_query) === TRUE) {
                echo "<h3>Image uploaded successfully!</h3>";
                $photo = $filename; // Update $photo variable to display the new photo
            } else {
                echo "Error: " . $insert_query . "<br>" . $conn->error;
            }
        } else {
            echo "<h3>Failed to upload image!</h3>";
        }
    }
    if (isset($_POST['submit_password'])) {
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($newPassword === $confirmPassword) {
            
            $update_password_query = "UPDATE users SET password = '$newPassword' WHERE id = $user_id";
            if ($conn->query($update_password_query) === TRUE) {
                echo "Password updated successfully";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Passwords do not match";
        }
    }
?>
<!-- Your HTML code here -->

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="2 profile.css">
        <link rel="stylesheet" href="settings/style.css"-->
        <link rel="icon" href="home/img/logo.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Profile || SkillSwap</title>
    </head>

    <body>
    <form method="POST" name="update_profile" enctype="multipart/form-data">
        <!-- Sidebar -->
        <div class="sidebar">
            <a href="main.php" class="logo">
                <!-- <i class='bx bx-code-alt'></i> -->
                <p>&ensp;</p>
                <img src="images/logo.png" alt="logo" width="34" height="34">
                <p>&ensp;</p>
                <p>&nbsp;</p>
                <div class="logo-name"><span>Skill</span>Swap</div>
            </a>
            <ul class="side-menu">
                <li class="active"><a href="#"><i class='bx bx-group'></i>Profile</a></li>
                <li><a href="userlist.php"><i class='bx bxs-dashboard'></i>Members</a></li>
                <li><a href="chat.html"><i class='bx bx-message-square-dots'></i>Peer Chat</a></li>
                <li><a href="feedback.html"><i class='bx bx-comment'></i>Feedback</a></li>
                
                
               
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="logout.php" class="logout">
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
            <!-- <nav>
                <i class='bx bx-menu'></i>
                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                    </div>
                </form>
                <input type="checkbox" id="theme-toggle" hidden>
                <label for="theme-toggle" class="theme-toggle"></label>
                < <a href="#" class="notif">
                    <i class='bx bx-bell bx-sm'></i>
                    <span class="count">12</span>
                </a> >


                <a href="#" class="profile">
                    <img src="images/logo.png">
                </a-->
            </nav> 
            <!-- End of Navbar -->

            <main>
                <div class="container light-style flex-grow-1 container-p-y">
                    <a href="#" class="active-back">
                        <img src="settings/arrow-alt-circle-left.png" alt="">
                    </a>

                    <h4 class="font-weight-bold py-3 mb-4">
                        Personal information
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
                        <div class="tab-pane fade active show" id="account-general">
                        <div class="card-body media align-items-center">
        <img src="<?php echo $photo; ?>" alt="Profile Picture" class="d-block ui-w-80">
        <div class="media-body ml-4">
            <label class="btn btn-outline-primary">
                Upload new photo
                <input type="file" name="photo" class="account-settings-fileinput">
            </label> &nbsp;
            <!-- <button type="button" class="btn btn-default md-btn-flat">Reset</button> -->
            


        </div>
    </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control mb-1" name="username" value="<?php echo $username;?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="text" class="form-control mb-1" name="email" value="<?php echo $email;?>">
                                    <div class="alert alert-warning mt-3">
                                        Your email is not confirmed. Please check your inbox.<br>
                                        <a href="javascript:void(0)">Resend confirmation</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Skills</label>
                                    <input type="text" class="form-control" name ="skill" value="<?php echo $skill;?>">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
        <div class="card-body pb-2">
            <div class="form-group">
                <label class="form-label">New password</label>
                <input type="password" name="newPassword" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Confirm password</label>
                <input type="password" name="confirmPassword" class="form-control">
            </div>
        </div>
    </div>
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Write details about youe skills</label>
                                    <textarea class="form-control"
                                        rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Birthday</label>
                                    <input type="date" class="form-control" value="<?php echo $dob;?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <select class="custom-select">
                                        <option>USA</option>
                                        <option selected>india</option>
                                        <option>UK</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">Contacts</h6>
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" value="<?php echo $no;?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Website</label>
                                    <input type="text" class="form-control" value>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-social-links">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" class="form-control" value="https://twitter.com/user">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" class="form-control" value="https://www.facebook.com/user">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Google+</label>
                                    <input type="text" class="form-control" value>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="text" class="form-control" value>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" class="form-control" value="https://www.instagram.com/user">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-connections">
                            <div class="card-body">
                                <button type="button" class="btn btn-twitter">Connect to
                                    <strong>Twitter</strong></button>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <h5 class="mb-2">
                                    <a href="javascript:void(0)" class="float-right text-muted"><i
                                            class="ion ion-md-close"></i> Remove</a>
                                    <i class="ion ion-logo-google text-google"></i>
                                    You are connected to Google:
                                </h5>
                                <a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                    data-cfemail="f89794b8979e859db894989095d79a9694">[email&#160;protected]</a>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <button type="button" class="btn btn-facebook">Connect to
                                    <strong>Facebook</strong></button>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <button type="button" class="btn btn-instagram">Connect to
                                    <strong>Instagram</strong></button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-notifications">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">Activity</h6>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Email me when someone want to talk</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Email me when someone want to connect
                                        </span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input">
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Email me when someone visit my profile</span>
                                    </label>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">Wesite</h6>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">News and announcements</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input">
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Weekly updates</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked>
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Weekly Suggestions</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    <div class="text-right mt-3">
                    <button type="submit" name="submit_password" class="btn btn-primary">Update Password</button>
                            <button type="submit" name="submit_photo" class="btn btn-primary">Upload photo</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-default">Cancel</button>
            
                    </div>
                </div>
            </main>

        </div>
        </form>

        <script src="members.js"></script>
        <script>
            // Selecting the password input fields
const passwordInputs = document.querySelectorAll('.password');

// Function to check if passwords match
function passwordsMatch() {
    // Getting the values of the password fields
    const newPassword = passwordInputs[0].value;
    const reenteredPassword = passwordInputs[1].value;

    // Checking if both passwords match
    return newPassword === reenteredPassword;
}

// Function to send updated password to PHP script
function updatePassword() {
    // Check if passwords match
    if (passwordsMatch()) {
        const newPassword = passwordInputs[0].value;
        
        // Send the new password to PHP script using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_password.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Password updated successfully!');
            } else {
                console.error('Error updating password:', xhr.statusText);
            }
        };
        xhr.onerror = function() {
            console.error('Network error occurred');
        };
        xhr.send('newPassword=' + encodeURIComponent(newPassword));
    } else {
        console.error('Passwords do not match');
    }
}

// Event listener to trigger updatePassword function when the user submits the form or clicks a button
// Assuming there's a button with an id "updateBtn", you can replace it with your actual form submit button or any other trigger element
document.getElementById('updateBtn').addEventListener('click', updatePassword);

        </script>
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
