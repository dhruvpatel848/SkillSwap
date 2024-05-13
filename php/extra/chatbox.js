function getMessages() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_messages.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const messages = JSON.parse(xhr.responseText);
            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML = '';
            messages.forEach(message => {
                chatBox.innerHTML += `<div>${message.sender}: ${message.message}</div>`;
            });
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    };
    xhr.send();
}

function sendMessage() {
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value.trim();
    if (message !== '') {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'send_message.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                messageInput.value = '';
                getMessages();
            }
        };
        xhr.send(`message=${message}`);
    }
}

// Get messages on page load
getMessages();

// Poll every 3 seconds for new messages
setInterval(getMessages, 3000);
