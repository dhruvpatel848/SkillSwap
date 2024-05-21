<?php 
include('auth.php');
$user_id = $_SESSION['id'];
$sql = "SELECT name FROM users WHERE id = $user_id";
$result = $conn->query($sql);

$name = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
}

$colors = array('#007AFF','#FF7000','#FF7000','#15E25F','#CFC700','#CFC700','#CF1100','#CF00BE','#F00');
$color_pick = array_rand($colors);
?>
<html lang="en">

<head>
    <style>
        /* Include your existing CSS here */
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
            position: relative;
            width: calc(100% - 230px);
            left: 230px;
            transition: all 0.3s ease;
        }

        .sidebar.close~.content {
            width: calc(100% - 60px);
            left: 60px;
        }

        .content nav {
            height: 56px;
            background: var(--light);
            padding: 0 24px 0 0;
            display: flex;
            align-items: center;
            grid-gap: 24px;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .content nav::before {
            content: "";
            position: absolute;
            width: 40px;
            height: 40px;
            bottom: -40px;
            left: 0;
            border-radius: 50%;
            box-shadow: -20px -20px 0 var(--light);
        }

        .content nav a {
            color: var(--dark);
        }

        .content nav .bx.bx-menu {
            cursor: pointer;
            color: var(--dark);
        }

        .content nav form {
            max-width: 400px;
            width: 100%;
            margin-right: auto;
        }

        .content nav form .form-input {
            display: flex;
            align-items: center;
            height: 36px;
        }

        .content nav form .form-input input {
            flex-grow: 1;
            padding: 0 16px;
            height: 100%;
            border: none;
            background: var(--grey);
            border-radius: 36px 0 0 36px;
            outline: none;
            width: 100%;
            color: var(--dark);
        }

        .content nav form .form-input button {
            width: 80px;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--primary);
            color: var(--light);
            font-size: 18px;
            border: none;
            outline: none;
            border-radius: 0 36px 36px 0;
            cursor: pointer;
        }

        .content nav .notif {
            font-size: 20px;
            position: relative;
        }

        .content nav .notif .count {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 20px;
            height: 20px;
            background: var(--danger);
            border-radius: 50%;
            color: var(--light);
            border: 2px solid var(--light);
            font-weight: 700;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content nav .profile img {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 50%;
        }

        .content nav .theme-toggle {
            display: block;
            min-width: 50px;
            height: 25px;
            background: var(--grey);
            cursor: pointer;
            position: relative;
            border-radius: 25px;
        }

        .content nav .theme-toggle::before {
            content: "";
            position: absolute;
            top: 2px;
            left: 2px;
            bottom: 2px;
            width: calc(25px - 4px);
            background: var(--primary);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .content nav #theme-toggle:checked+.theme-toggle::before {
            left: calc(100% - (25px - 4px) - 2px);
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                width: calc(100% - 60px);
                left: 200px;
            }
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            text-align: center;
        }

        h1 {
            color: #26b4ff;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .chat-wrapper {
	font: bold 11px/normal 'lucida grande', tahoma, verdana, arial, sans-serif;
    background: #00a6bb;
    padding: 20px;
    margin: 20px auto;
    box-shadow: 2px 2px 2px 0px #00000017;
	max-width:700px;
	min-width:500px;
}
#message-box {
    width: 97%;
    display: inline-block;
    height: 300px;
    background: #fff;
    box-shadow: inset 0px 0px 2px #00000017;
    overflow: auto;
    padding: 10px;
}
.user-panel{
    margin-top: 10px;
}
input[type=text]{
    border: none;
    padding: 5px 5px;
    box-shadow: 2px 2px 2px #0000001c;
}
input[type=text]#name{
    width:20%;
}
input[type=text]#message{
    width:60%;
}
button#send-message {
    border: none;
    padding: 5px 15px;
    background: #11e0fb;
    box-shadow: 2px 2px 2px #0000001c;
}
        .cta-button {
            display: inline-block;
            background-color: #26b4ff;
            color: #ffffff;
            font-size: 20px;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #1e93d0;
        }

        img {
            max-width: 100%;
            height: auto;
            width: 80px;
        }

        #chat-section {
            display: none;
            text-align: left;
            margin-top: 20px;
        }

        #chat-messages {
            border: 1px solid #ccc;
            padding: 10px;
            height: 300px;
            overflow-y: auto;
            margin-bottom: 10px;
        }

        #chat-form {
            display: flex;
        }

        #chat-form input {
            flex-grow: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            outline: none;
        }

        #chat-form button {
            padding: 10px;
            font-size: 16px;
            background-color: #26b4ff;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 0 4px 4px 0;
        }

        #chat-form button:hover {
            background-color: #1e93d0;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="feedback.css">
    <title>Let's Connect And Share!!</title>
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
            <li class="active"><a href="#"><i class='bx bx-message-square-dots'></i>Peer Chat</a></li>
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
        <h1>Welcome to Peer Chat</h1>
        <div class="container">
            <p>Start chatting with your peers now!</p>
            <div id="chat-form">
            <div class="chat-wrapper">
                <div id="message-box"></div>
                    <div class="user-panel">
                        <input type="text" name="name" id="name" placeholder="Your Name" maxlength="15" value="<?php echo htmlspecialchars($name); ?>"/>
                        <input type="text" name="message" id="message" placeholder="Type your message here..." maxlength="100" />
                        <button id="send-message">Send</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Section -->
        <div id="chat-section" class="chat-section">
            <h2>Peer Chat</h2>
            <div id="chat-messages"></div>
        </div>
    </div>
    <!-- End of Main Content -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">  
	//create a new WebSocket object.
	var msgBox = $('#message-box');
	var wsUri = "ws://localhost:9000/demo/server.php"; 	
	websocket = new WebSocket(wsUri); 
	
	websocket.onopen = function(ev) { // connection is open 
		msgBox.append('<div class="system_msg" style="color:#bbbbbb">Welcome to Skillswap Chat box!</div>'); //notify user
	}
	// Message received from server
	websocket.onmessage = function(ev) {
		var response 		= JSON.parse(ev.data); //PHP sends Json data
		
		var res_type 		= response.type; //message type
		var user_message 	= response.message; //message text
		var user_name 		= response.name; //user name
		var user_color 		= response.color; //color

		switch(res_type){
			case 'usermsg':
				msgBox.append('<div><span class="user_name" style="color:' + user_color + '">' + user_name + '</span> : <span class="user_message">' + user_message + '</span></div>');
				break;
			case 'system':
				msgBox.append('<div style="color:#bbbbbb">' + user_message + '</div>');
				break;
		}
		msgBox[0].scrollTop = msgBox[0].scrollHeight; //scroll message 

	};
	
	websocket.onerror	= function(ev){ msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>'); }; 
	websocket.onclose 	= function(ev){ msgBox.append('<div class="system_msg">Connection Closed</div>'); }; 

	//Message send button
	$('#send-message').click(function(){
		send_message();
	});
	
	//User hits enter key 
	$( "#message" ).on( "keydown", function( event ) {
	  if(event.which==13){
		  send_message();
	  }
	});
	
	//Send message
	function send_message(){
		var message_input = $('#message'); //user message text
		var name_input = $('#name'); //user name
		
		if(message_input.val() == ""){ //empty name?
			alert("Enter your Name please!");
			return;
		}
		if(message_input.val() == ""){ //emtpy message?
			alert("Enter Some message Please!");
			return;
		}

		//prepare json data
		var msg = {
			message: message_input.val(),
			name: name_input.val(),
			color : '<?php echo $colors[$color_pick]; ?>'
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));	
		message_input.val(''); //reset message input
	}
</script>
</body>

</html>
