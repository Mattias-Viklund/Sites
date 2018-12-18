var logLabels = 18;

class Gamelog {
    Print() {
        for (var i = 0; i < logLabels; i++) {
            console.log(document.getElementById('console' + i).innerHTML);

        }
    }

    Clear() {
        this.SetAll("");

    }

    Push(message) {
        if (message.length == 0)
            return;

        var lastLine = message;
        var temp = "";
        for (var i = logLabels - 1; i >= 0; i--) {
            var line = document.getElementById('console' + i);

            temp = line.innerHTML;
            line.innerHTML = lastLine;
            lastLine = temp;

        }
    }

    SetAll(text) {
        for (var i = 0; i < logLabels; i++) {
            var line = document.getElementById('console' + i);
            line.innerHTML = text;

        }
    }
}