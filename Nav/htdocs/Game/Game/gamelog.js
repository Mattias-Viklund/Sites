var logLabels = 18;
var defaultColor = "#11db22";

class Gamelog {
    constructor() {
        console.log('GameLog constructor');
        this.Print();

    }

    Print() {
        for (var i = 0; i < logLabels; i++) {
            console.log(document.getElementById('console' + i).innerHTML);

        }
    }

    Clear() {
        this.SetAll("\"\"");

    }

    Push(message) {
        if (message.length == 0)
            return;

        var lastLine = message;
        var temp = "";

        var tempColor = defaultColor;
        var lastColor = defaultColor;

        if (message.charAt(0) == '\\') {
            if (message.length >= 1) {
                var hasColor = true;
                switch (message.charAt(1)) {
                    //case 'd': break; // Default
                    case 'w': lastColor = "#b70000"; break; // Warning
                    case 'i': lastColor = "#ffdd00"; break; // Info
                    case 'h': lastColor = "#008800"; break; // Hint
                    case 't': lastColor = "#f442eb"; break; // Hint
                    case 'n': lastColor = "#000000"; break; // Hint

                    default:
                        hasColor = false;
                        break;

                }

                if (hasColor) {
                    if (message.charAt(2) != -1 || message.charAt(2) === ' ') {
                        lastLine = message.substring(3);

                    } else {
                        lastLine = message.substring(2);
                    }
                }
            }
        }
        
        this.invisibleMessage = document.getElementById('console0');

        for (var i = logLabels - 1; i >= 0; i--) {
            var line = document.getElementById('console' + i);

            temp = line.innerHTML;
            tempColor = line.style.color;

            line.innerHTML = lastLine;
            line.style.color = lastColor;

            lastLine = temp;
            lastColor = tempColor;

        }
    }

    Pop() {
        var messages = new Array();
        var colors = new Array();
        for (var i = 0; i < logLabels - 1; i++) {
            messages.push(document.getElementById('console' + i).innerHTML);
            colors.push(document.getElementById('console' + i).style.color);

        }

        for (var i = 0; i < logLabels - 1; i++) {
            document.getElementById('console' + (i + 1)).innerHTML = messages[i];
            document.getElementById('console' + (i + 1)).style.color = colors[i];

        }

        document.getElementById('console0').innerHTML = this.invisibleMessage.innerHTML;
        document.getElementById('console0').style.color = this.invisibleMessage.style.color;

    }

    SetAll(text) {
        for (var i = 0; i < logLabels; i++) {
            var line = document.getElementById('console' + i);
            line.innerHTML = text;
            line.style.color = defaultColor;

        }
    }
}