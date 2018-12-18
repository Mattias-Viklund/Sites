var log = new Gamelog();
var game;

class Game {    
    constructor(playerName) {
        this.player = new Player(playerName);
        this.world = new World(10);
        log.Push("Welcome back, "+playerName);

    }

    Send(message){
        if (message.length == 0)
            return;

        log.Push(message);
        this.Handle(message);

    }

    Handle(message){
        GetCommand(message);

    }

    GameLoop() {
        this.Update();

    }

    Update() {


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