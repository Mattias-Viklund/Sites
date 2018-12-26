console.log("Populating commands.");

// Additional Commands
var help = new Command(new Array("help", "h"));
var clear = new Command(new Array("clear"));
var gameCommand = new Command(new Array("game"));

// Developer commands
var echo = new Command(new Array("echo"));

// Movement
var moveUp = new Command(new Array("up", "u"));
var moveDown = new Command(new Array("down", "d"));
var moveSouth = new Command(new Array("south", "s"));
var moveNorth = new Command(new Array("north", "n"));
var moveEast = new Command(new Array("east", "e"));
var moveWest = new Command(new Array("west", "w"));

// Shop
var buy = new Command(new Array("buy", "b"));
var list = new Command(new Array("list", "li"));
var sell = new Command(new Array("sell"));

// Equipment
var wield = new Command(new Array("wield", "wie"));
var wear = new Command(new Array("wear"));
var remove = new Command(new Array("remove", "rem"));

function InitializeCommands(){
    help.SetAction(Help)
    clear.SetAction(Clear);
    gameCommand.SetAction(GameCommand);

    echo.SetAction(Echo)

    AddCommand(help);
    AddCommand(clear);
    AddCommand(gameCommand);

    AddCommand(echo);

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

}

// General Game Functions
function Clear(){
    game.GetLog().Clear();

}

function GameCommand(){
    var log = game.GetLog();
    log.Push('Yes, '+game.GetPlayer().GetName()+', this is the game. ');

}