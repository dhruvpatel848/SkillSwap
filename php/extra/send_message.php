<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'] ?? '';
    if ($message !== '') {
        $newMessage = array(
            'sender' => 'You',
            'message' => $message
        );

        $messages = json_decode(file_get_contents('messages.json'), true) ?? [];
        $messages[] = $newMessage;
        file_put_contents('messages.json', json_encode($messages));

        echo 'Message sent successfully';
    } else {
        http_response_code(400);
        echo 'Message cannot be empty';
    }
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
?>
