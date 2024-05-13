<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        <?php include 'styles.css'; ?>
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetStarted</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <div class="circle"></div>
        <header>
            <a href="#"><img src="/images/logo.png" alt="logo"  class="logo"></a>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="try.php">Login</a></li>
                <li><a href="our_team.html">Our Team</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </header>

        <div class="content">
            <div class="textbox">
                <h2>SKILL SWAP <span>NETWORK</span> </h2>
                <p>The skill swap hub is an innovative and transformative solution aimed at revolutionizing the way students learn and support one another. The skill swap hub addresses this gap by providing a tailored platform that intelligently matches students based on their individual proficiency levels and strengths.</p>
                <a href="try.php">Get Started</a>
            </div>
            <div class="imgbox">
                <img src="./images/studying.png" alt="" class="image">
            </div>
        </div>
        <ul class="thumb">
            <li><img src="./images/studying.png" alt="" onclick="imgslider('./images/studying.png')"></li>
            <li><img src="./images/reading (1).png" alt="" onclick="imgslider('./images/reading (1).png')"></li>
            <li><img src="./images/reading.png" alt="" onclick="imgslider('./images/reading.png')"></li>
        </ul>
        <ul class="sci">
            <li><a href="#"><img src="./images/github.png" alt=""></a></li>
            <li><a href="#"><img src="./images/envelope.png" alt=""></a></li>
            <li><a href="#"><img src="./images/linkedin.png" alt=""></a></li>
        </ul>
    </section>

    <script type="text/javascript">
        function imgslider(anything) {
            document.querySelector('.image').src = anything;
        }
    </script>
</body>
</html>
