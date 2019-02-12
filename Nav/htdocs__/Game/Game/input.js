var lastMessages = [];
var currentMessage = 0;
var currentMessages = 0;
var maxMessages = 14;

function PrevMessage() {
    currentMessage--;
    if (currentMessage < 0)
        currentMessage = maxMessages;

    document.getElementById('input').value = lastMessages[currentMessage];

}

function NextMessage() {
    currentMessage++;
    if (currentMessage > maxMessages) {
        currentMessage = maxMessages;
    }

    document.getElementById('input').value = lastMessages[currentMessage];

}

function SetCurrentMessage(message) {
    if (currentMessages == maxMessages)
        lastMessages.shift();

    lastMessages.unshift(message);
    currentMessages++;

    NextMessage();

}