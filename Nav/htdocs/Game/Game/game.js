var game;

class Game {
    constructor(playerName) {
        this.log = new Gamelog();
        this.player = new Player(playerName);
        this.world = new World(10);
        this.log.Push("Welcome back, " + playerName);

        InitializeCommands();

    }

    Send(message) {
        if (message.length == 0)
            return;

        this.log.Push(message);

        var firstSpace = message.indexOf(" ");

        if (firstSpace != -1) {
            var first = message.substr(0, firstSpace);
            var args = message.substr(firstSpace + 1);

            console.log("First word: " + first);
            console.log("Arguments: " + args);
            this.Handle(first, args);

        } else {
            this.Handle(message, message);

        }
    }

    Handle(first, args) {
        var command = GetCommand(first);

        if (command == null)
        {
            game.GetLog().Push("Command '"+first+"' does not exist.")
            return;

        }

        command.UseCommand(args);

    }

    GameLoop() {
        this.Update();

    }

    Update() {


    }

    GetPlayer() {
        return this.player;

    }

    GetWorld() {
        return this.world;

    }

    GetLog() {
        return this.log;

    }
}

window.onload = function () {
    document.getElementById("input").focus();
    StartGame('dev');

};

function SendKey(message) {
    game.Send(message);

}

function StartGame(name) {
    game = new Game(name);

}