<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        :root {
            --light: #f6f6f9;
            --primary: #1976D2;
            --light-primary: #CFE8FF;
            --grey: #eee;
            --dark-grey: #AAAAAA;
            --dark: #363949;
            --danger: #D32F2F;
            --light-danger: #FECDD3;
            --warning: #FBC02D;
            --light-warning: #FFF2C6;
            --success: #388E3C;
            --light-success: #BBF7D0;
            --dark-primary: #1565C0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .bx {
            font-size: 1.7rem;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        html {
            overflow-x: hidden;
        }

        body.dark {
            --light: #181a1e;
            --grey: #25252c;
            --dark: #fbfbfb
        }

        body {
            background: var(--grey);
            overflow-x: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            background: var(--light);
            width: 230px;
            height: 100%;
            z-index: 2000;
            overflow-x: hidden;
            scrollbar-width: none;
            transition: all 0.3s ease;
        }

        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .sidebar.close {
            width: 60px;
        }

        .sidebar .logo {
            font-size: 24px;
            font-weight: 700;
            height: 56px;
            display: flex;
            align-items: center;
            color: var(--primary);
            z-index: 500;
            padding-bottom: 20px;
            box-sizing: content-box;
        }

        .sidebar .logo .logo-name span {
            color: var(--dark);
        }

        .sidebar .logo .bx {
            min-width: 60px;
            display: flex;
            justify-content: center;
            font-size: 2.2rem;
        }

        .sidebar .side-menu {
            width: 100%;
            margin-top: 48px;
        }

        .sidebar .side-menu li {
            height: 48px;
            background: transparent;
            margin-left: 6px;
            border-radius: 48px 0 0 48px;
            padding: 4px;
        }

        .sidebar .side-menu li.active {
            background: var(--grey);
            position: relative;
        }

        .sidebar .side-menu li.active::before {
            content: "";
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            top: -40px;
            right: 0;
            box-shadow: 20px 20px 0 var(--grey);
            z-index: -1;
        }

        .sidebar .side-menu li.active::after {
            content: "";
            position: absolute;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            bottom: -40px;
            right: 0;
            box-shadow: 20px -20px 0 var(--grey);
            z-index: -1;
        }

        .sidebar .side-menu li a {
            width: 100%;
            height: 100%;
            background: var(--light);
            display: flex;
            align-items: center;
            border-radius: 48px;
            font-size: 16px;
            color: var(--dark);
            white-space: nowrap;
            overflow-x: hidden;
            transition: all 0.3s ease;
        }

        .sidebar .side-menu li.active a {
            color: var(--success);
        }

        .sidebar.close .side-menu li a {
            width: calc(48px - (4px * 2));
            transition: all 0.3s ease;
        }

        .sidebar .side-menu li a .bx {
            min-width: calc(60px - ((4px + 6px) * 2));
            display: flex;
            font-size: 1.6rem;
            justify-content: center;
        }

        .sidebar .side-menu li a.logout {
            color: var(--danger);
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            position: relative;
            width: calc(100% - 230px);
            left: 230px;
            transition: all 0.3s ease;
        }

        .sidebar.close ~ .content {
            width: calc(100% - 60px);
            left: 60px;
        }

        .card {
            background-color: var(--light);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            max-width: 800px;
            width: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .card p {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .card ul {
            margin-bottom: 20px;
        }

        .card ul li {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .btn-signup {
            display: inline-block;
            padding: 12px 24px;
            background-color: var(--primary);
            color: var(--light);
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-signup:hover {
            background-color: var(--dark-primary);
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>std home page</title>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Skill</span>Swap</div>
        </a>
        <ul class="side-menu">
            <li><a href="save.php"><i class='bx bx-group'></i>Profile</a></li>
            <li><a href="userlist.php"><i class='bx bxs-dashboard'></i>Members</a></li>
            <li><a href="chat.html"><i class='bx bx-message-square-dots'></i>Chat-Peer</a></li>
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
            <div class="card main-section">
                <div class="section-content">
                    <h1 class="animated fadeInDown">
                        "Empowering Collaboration: The Essence of Skill Swapping" <span class="highlight"></span></h1>
                    <p class="animated fadeInLeft">SkillSwap is not just a platform; it's a community-driven initiative aimed at fostering learning, collaboration, and personal growth.</p>
                    <p class="animated fadeInRight">It will be useful to:</p>
                    <ul class="benefits-list animated fadeInUp">
                        <li>Freelancers and Small Business Owners</li>
                        <li>Students and Learners</li>
                        <li>Creative Professionals</li>
                        <li>Career Changers and Job Seekers</li>
                        <li>And many more!</li>
                
                </div>
                <div class="section-image animated fadeIn"></div>
            </div>
        
            <div class="card about-section">
                <div class="section-content">
                    <h2 class="animated fadeInLeft">Our Mission</h2>
                    <p class="animated fadeInRight">At SkillSwap, we believe that everyone has something valuable to offer and something new to learn. Our mission is to empower individuals worldwide to exchange skills, knowledge, and experiences in a supportive and inclusive environment.</p>
                </div>
                <div class="section-image animated fadeIn"></div>
            </div>
        
            <div class="card features-section">
                <div class="section-content">
                    <h2 class="animated fadeInLeft">Key Features</h2>
                    <ul class="features-list animated fadeInRight">
                       
                        <li>Live Workshops and Webinars</li>
                        <li>Peer-to-Peer Skill Exchange</li>
                        <li>Progress Tracking and Analytics</li>
                    </ul>
                </div>
                <div class="section-image animated fadeIn"></div>
            </div>
        </div>            
</section>
</div>
<!-- End of Main Content -->

    <script src="index.js"></script>
</body>

</html>
