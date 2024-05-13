<?php
session_start();

// Initialize the message variables
$loginMessage = "";
$signupMessage = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to your MySQL database
    $servername = "localhost"; // Change this if database is hosted elsewhere
    $username = "root"; // MySQL username
    $password = ""; //  MySQL password
    $dbname = "skillswap"; //  MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process login form
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header("location: main.php"); // Redirect to your homepage
            exit(); // Add this line to prevent further execution
        } else {
            $loginMessage = "Invalid username or password";
        }
        $stmt->close();
    }

    // Process signup form
    if (isset($_POST['signup'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            $signupMessage = "Registration successful!";
        } else {
            $signupMessage = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css" />
    <title>Sign In | SkillSwap</title>
    <link rel="icon" href="img/logo.png">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap");

        :root {
            --light: #f6f6f9;
            --primary: #1976d2;
            --light-primary: #cfe8ff;
            --grey: #eee;
            --dark-grey: #aaaaaa;
            --dark: #363949;
            --danger: #d32f2f;
            --light-danger: #fecdd3;
            --warning: #fbc02d;
            --light-warning: --light2C6;
            --success: #388e3c;
            --light-success: #bbf7d0;
            --header-height: 3.5rem;
            /*========== Colors ==========*/
            /*Color mode HSL(hue, saturation, lightness)*/
            --first-color: hsl(220, 68%, 54%);
            --first-color-lighten: hsl(220, 68%, 97%);
            --title-color: hsl(220, 48%, 28%);
            --text-color: hsl(220, 12%, 45%);
            --body-color: hsl(220, 100%, 99%);
            /*========== Font and typography ==========*/
            /*.5rem = 8px | 1rem = 16px ...*/
            --body-font: "Poppins", sans-serif;
            --normal-font-size: .938rem;
            --small-font-size: .813rem;
            --smaller-font-size: .75rem;
            /*========== Font weight ==========*/
            --font-medium: 500;
            --font-semi-bold: 600;
            /*========== z index ==========*/
            --z-tooltip: 10;
            --z-fixed: 100;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
        }

        body.dark {
            --light: #181a1e;
            --grey: #25252c;
            --dark: #fbfbfb;
        }

        body {
            background: var(--grey);
            overflow-x: hidden;
        }

        body,
        input {
            font-family: "Poppins", sans-serif;
        }

        a {
            text-decoration: none;
        }

        .mainContent nav {
            position: fixed;
            height: 80px;
            background: var(--light);
            padding: 0 24px 0 0;
            display: flex;
            align-items: center;
            grid-gap: 24px;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: inset 0 0 0.5px 1px hsla(0, 0%, 100%, 0.1),
              
                0 0 0 1px hsla(230, 13%, 9%, 0.075),
              
                0 0.3px 0.4px hsla(230, 13%, 9%, 0.02),
                0 0.9px 1.5px hsla(230, 13%, 9%, 0.045),
                0 3.5px 6px hsla(230, 13%, 9%, 0.09);
        }

        .mainContent nav a {
            color: var(--dark);
            float: right;
        }

        .mainContent nav .theme-toggle {
            display: block;
            min-width: 50px;
            height: 25px;
            background: var(--grey);
            cursor: pointer;
            position: relative;
            border-radius: 25px;
        }

        .mainContent nav .theme-toggle::before {
            content: "";
            position: absolute;
            top: 2px;
            right: 2px;
            bottom: 2px;
            width: calc(25px - 4px);
            background: var(--primary);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .mainContent nav #theme-toggle:checked+.theme-toggle::before {
            right: calc(100% - (25px - 4px) - 2px);
        }

        .nav__links {
            font-weight: var(--font-semi-bold);
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: color 0.3s;
        }

        .nav__links:hover {
            display: inline-flex;
            align-items: center;
            column-gap: 0.25rem;
            color: var(--primary);
            font-weight: var(--font-semi-bold);
            transition: color 0.3s;
        }

        .logo-text .logo {
            background: var(--light);
            display: flex;
            align-items: center;
            color: var(--primary);
            padding-bottom: 7px;
            padding-left: 3cqi;
            box-sizing: content-box;
            padding-inline: 12cqi;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            color: var(--primary);
            padding-bottom: 7px;
            padding-left: 10cqi;
            box-sizing: content-box;
        }

        .logo-text .logo .logo-name span {
            color: var(--dark);
        }

        .container {
            position: relative;
            width: 100%;
            background-color: --light;
            min-height: 100vh;
            overflow: hidden;
        }

        .forms-container {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .signin-signup {
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            left: 75%;
            width: 50%;
            transition: 1s 0.7s ease-in-out;
            display: grid;
            grid-template-columns: 1fr;
            z-index: 5;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0rem 5rem;
            transition: all 0.2s 0.7s;
            overflow: hidden;
            grid-column: 1 / 2;
            grid-row: 1 / 2;
        }

        form.sign-up-form {
            opacity: 0;
            z-index: 1;
        }

        form.sign-in-form {
            z-index: 2;
        }

        .title {
            font-size: 2.2rem;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .input-field {
            max-width: 380px;
            width: 100%;
            background-color: var(--light);
            margin: 10px 0;
            height: 55px;
            border-radius: 55px;
            display: grid;
            grid-template-columns: 15% 85%;
            padding: 0 0.4rem;
            position: relative;
        }

        .input-field i {
            text-align: center;
            line-height: 55px;
            color: var(--dark);
            transition: 0.5s;
            font-size: 1.1rem;
        }

        .input-field input {
            background: none;
            outline: none;
            border: none;
            line-height: 1;
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--dark);
        }

        .input-field input::placeholder {
            color: --dark-grey;
            font-weight: 500;
        }

        .social-text {
            color: var(--dark);
            padding: 0.7rem 0;
            font-size: 1rem;
        }

        .social-media {
            display: flex;
            justify-content: center;
        }

        .social-icon {
            height: 46px;
            width: 46px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 0.45rem;
            color: var(--dark);
            border-radius: 50%;
            border: 1px solid --dark;
            text-decoration: none;
            font-size: 1.1rem;
            transition: 0.3s;
        }

        .social-icon:hover {
            color: #4481eb;
            border-color: #4481eb;
        }

        .btn {
            width: 150px;
            background-color: #5995fd;
            border: none;
            outline: none;
            height: 49px;
            border-radius: 49px;
            color: var(--dark);
            text-transform: uppercase;
            font-weight: 600;
            margin: 10px 0;
            cursor: pointer;
            transition: 0.5s;
        }

        .btn:hover {
            background-color: #4d84e2;
        }

        .panels-container {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .container:before {
            content: "";
            position: absolute;
            height: 2000px;
            width: 2000px;
            top: -10%;
            right: 48%;
            transform: translateY(-50%);
            background-image: linear-gradient(-45deg, #4481eb 0%, #04befe 100%);
            transition: 1.8s ease-in-out;
            border-radius: 50%;
            z-index: 6;
        }

        .image {
            width: 100%;
            transition: transform 1.1s ease-in-out;
            transition-delay: 0.4s;
        }

        .panel {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-around;
            text-align: center;
            z-index: 6;
        }

        .left-panel {
            pointer-events: all;
            padding: 3rem 17% 2rem 12%;
        }

        .right-panel {
            pointer-events: none;
            padding: 3rem 12% 2rem 17%;
        }

        .panel .content {
            color: var(--dark);
            transition: transform 0.9s ease-in-out;
            transition-delay: 0.6s;
        }

        .panel h3 {
            font-weight: 600;
            line-height: 1;
            font-size: 1.5rem;
        }

        .panel p {
            font-size: 0.95rem;
            padding: 0.7rem 0;
        }

        .btn.transparent {
            margin: 0;
            background: none;
            border: 2px solid var(--dark);
            width: 130px;
            height: 41px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .btn.transparent:hover {
            color: #5995fd;
            background-color: #cfe8ff;
            border: 1px solid #5995fd;
        }

        .right-panel .image,
        .right-panel .content {
            transform: translateX(800px);
        }

        /* ANIMATION */

        .container.sign-up-mode:before {
            transform: translate(100%, -50%);
            right: 52%;
        }

        .container.sign-up-mode .left-panel .image,
        .container.sign-up-mode .left-panel .content {
            transform: translateX(-800px);
        }

        .container.sign-up-mode .right-panel .image,
        .container.sign-up-mode .right-panel .content {
            transform: translateX(0%);
        }

        .container.sign-up-mode .left-panel {
            pointer-events: none;
        }

        .container.sign-up-mode .right-panel {
            pointer-events: all;
        }

        @media (max-width: 870px) {
            .container {
                min-height: 800px;
                height: 100vh;
            }

            .signin-signup {
                width: 100%;
                top: 95%;
                transform: translate(-50%, -100%);
                transition: 1s 0.8s ease-in-out;
            }

            .signin-signup,
            .container.sign-up-mode .signin-signup {
                left: 50%;
            }

            .panels-container {
                grid-template-columns: 1fr;
                grid-template-rows: 1fr 2fr 1fr;
            }

            .panel {
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                padding: 2.5rem 8%;
                grid-column: 1 / 2;
            }

            .right-panel {
                grid-row: 3 / 4;
            }

            .left-panel {
                grid-row: 1 / 2;
            }

            .image {
                width: 200px;
                transition: transform 0.9s ease-in-out;
                transition-delay: 0.6s;
            }

            .panel .content {
                padding-right: 15%;
                transition: transform 0.9s ease-in-out;
                transition-delay: 0.8s;
            }

            .panel h3 {
                font-size: 1.2rem;
            }

            .panel p {
                font-size: 0.7rem;
                padding: 0.5rem 0;
            }

            .btn.transparent {
                width: 110px;
                height: 35px;
                font-size: 0.7rem;
            }

            .container:before {
                width: 1500px;
                height: 1500px;
                transform: translateX(-50%);
                left: 30%;
                bottom: 68%;
                right: initial;
                top: initial;
                transition: 2s ease-in-out;
            }

            .container.sign-up-mode:before {
                transform: translate(-50%, 100%);
                bottom: 32%;
                right: initial;
            }

            .container.sign-up-mode .left-panel .image,
            .container.sign-up-mode .left-panel .content {
                transform: translateY(-300px);
            }

            .container.sign-up-mode .right-panel .image,
            .container.sign-up-mode .right-panel .content {
                transform: translateY(0px);
            }

            .right-panel .image,
            .right-panel .content {
                transform: translateY(300px);
            }

            .container.sign-up-mode .signin-signup {
                top: 5%;
                transform: translate(-50%, 0);
            }
        }

        @media (max-width: 570px) {
            form {
                padding: 0 1.5rem;
            }

            .image {
                display: none;
            }

            .panel .content {
                padding: 0.5rem 1rem;
            }

            .container {
                padding: 1.5rem;
            }

            .container:before {
                bottom: 72%;
                left: 50%;
            }

            .container.sign-up-mode:before {
                bottom: 28%;
                left: 50%;
            }
        }

        .btn {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <button type="submit" name="login" class="btn solid"><span>Login</span></button>
                    <p class="social-text">Or Sign in with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </form>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                    class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <button type="submit" name="signup" class="btn"><span>Sign up</span></button>
                    <p class="social-text">Or Sign up with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        Explore our forums, chat rooms, and collaborative coding spaces.<br>
                        We believe in the power of collaboration, learning, and sharing!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Access a vast library of tech resources, tutorials, and hackathon opportunities.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="auth.js">
        
    </script>
</body>

</html>
