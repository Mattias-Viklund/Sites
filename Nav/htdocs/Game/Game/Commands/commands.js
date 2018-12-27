console.log("Populating commands.");

// Additional Commands
var help = new Command(new Array("help", "h"), Help);
var clear = new Command(new Array("clear"), Clear);
var gameCommand = new Command(new Array("game"), GameCommand);
var alias = new Command(new Array("alias"), Alias);

// Developer commands
var echo = new Command(new Array("echo"), Echo);
var sendglobal = new Command(new Array("sendglobal"), SendGlobal, undefined, true);

// Movement
var moveUp = new Command(new Array("up", "u"));
var moveDown = new Command(new Array("down", "d"));
var moveSouth = new Command(new Array("south", "s"));
var moveNorth = new Command(new Array("north", "n"));
var moveEast = new Command(new Array("east", "e"));
var moveWest = new Command(new Array("west", "w"));

// Shop
var buy = new Command(new Array("buy", "b"));
var list = new Command(new Array("list", "li"), ListCommand);
var sell = new Command(new Array("sell"));

// Equipment
var wield = new Command(new Array("wield", "wie"));
var wear = new Command(new Array("wear"));
var remove = new Command(new Array("remove", "rem"));

console.log("Commands populated.");

function AddAllCommands() {
    AddCommand(help);
    AddCommand(clear);
    AddCommand(gameCommand);
    AddCommand(alias);

    AddCommand(echo);
    AddCommand(sendglobal);

    AddCommand(moveUp);
    AddCommand(moveDown);
    AddCommand(moveSouth);
    AddCommand(moveNorth);
    AddCommand(moveEast);
    AddCommand(moveWest);

    AddCommand(buy);
    AddCommand(list);
    AddCommand(sell);

    AddCommand(wield);
    AddCommand(wear);
    AddCommand(remove);

    InitalizeCommands();

}

// General Game Functions
function Clear() {
    game.GetLog().Clear();

}

function GameCommand() {
    var log = game.GetLog();
    log.Push('Yes, ' + game.GetPlayer().GetName() + ', this is the game. ');

}

//// STUBS ////
function SendGlobal(message) {
    if (message === "sendglobal")
        return;

    game.GetLog().Pop();
    game.Send(message);

}