document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("file-input");
    const messageInput = document.getElementById("message-input");
    const sendButton = document.getElementById("send-button");
    const chatBox = document.getElementById("chat-box");

    if (sendButton && messageInput && fileInput && chatBox) {
        sendButton.addEventListener("click", function () {
            sendMessage("sent");
        });

        messageInput.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                sendMessage("sent");
            }
        });

        fileInput.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                displayFileMessage(file, "sent");
            }
        });

        function sendMessage(type) {
            const message = messageInput.value.trim();
            if (message !== "") {
                displayMessage(message, type);
                messageInput.value = "";
            }
        }

        function displayMessage(message, type) {
            const messageElement = document.createElement("div");
            messageElement.classList.add("message", type);
            messageElement.innerHTML = `
                <div>${message}</div>
                <div class="timestamp">${getCurrentTime()}</div>
            `;
            chatBox.appendChild(messageElement);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function displayFileMessage(file, type) {
            const messageElement = document.createElement("div");
            const fileName = file.name.length > 20 ? file.name.substring(0, 20) + "..." : file.name;
            messageElement.classList.add("file-message", type);
            messageElement.innerHTML = `
                <div>
                    <div><strong>File:</strong> ${fileName}</div>
                    <div><strong>Size:</strong> ${formatFileSize(file.size)}</div>
                </div>
                <div class="timestamp">${getCurrentTime()}</div>
            `;
            chatBox.appendChild(messageElement);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function getCurrentTime() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, "0");
            const minutes = now.getMinutes().toString().padStart(2, "0");
            return `${hours}:${minutes}`;
        }

        function formatFileSize(size) {
            if (size === 0) return "0 Bytes";
            const k = 1024;
            const sizes = ["Bytes", "KB", "MB", "GB", "TB"];
            const i = Math.floor(Math.log(size) / Math.log(k));
            return parseFloat((size / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
        }

        // Add function to simulate received messages
        function simulateReceivedMessage(message) {
            displayMessage(message, "received");
        }

        // Simulate some received messages
        simulateReceivedMessage("Hello! How are you?");
        simulateReceivedMessage("I'm doing well, thanks!");

        // Add an event listener for file messages if the file input exists
        fileInput.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                displayFileMessage(file, "received");
            }
        });

        // Function to display a default message if there are no received messages
        function displayDefaultMessage() {
            if (chatBox.children.length === 0 || !chatBox.querySelector(".received")) {
                const defaultMessageElement = document.createElement("div");
                defaultMessageElement.classList.add("message", "received");
                defaultMessageElement.textContent = "No messages from the other user.";
                chatBox.appendChild(defaultMessageElement);
            }
        }

        // Call the function to display the default message
        displayDefaultMessage();
    } else {
        console.error("One or more elements not found. Check element IDs in HTML.");
    }
});
