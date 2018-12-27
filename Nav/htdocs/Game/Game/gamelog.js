var logLabels = 18;

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

        this.invisibleMessage = document.getElementById('console0');

        for (var i = logLabels - 1; i >= 0; i--) {
            var line = document.getElementById('console' + i);

            temp = line.innerHTML;
            line.innerHTML = lastLine;
            lastLine = temp;

        }
    }

    Pop() {
        var messages = new Array();
        for (var i = 0; i < logLabels - 1; i++) {
            messages.push(document.getElementById('console' + i).innerHTML);

        }

        for (var i = 0; i < logLabels - 1; i++) {
            document.getElementById('console' + (i + 1)).innerHTML = messages[i];

        }

        document.getElementById('console0').innerHTML = this.invisibleMessage;

    }

    SetAll(text) {
        for (var i = 0; i < logLabels; i++) {
            var line = document.getElementById('console' + i);
            line.innerHTML = text;

        }
    }
}