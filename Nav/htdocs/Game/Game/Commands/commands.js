class Command {
    constructor(commandName) {
        this.commandName = commandName;

    }

    GetCommand() {
        return this;

    }

    GetCommandName() {
        return this._commandName;

    }

    SetAction(action) {
        this.action = action;

    }

    UseCommand() {
        this._action();

    }
}

var commands = [100];
var commandCount = 0;

function GetCommands() {
    console.log(commands);

    for (var i = 0; i < commandCount; i++)
        console.log(commands[i]);

    return commands;

}

function GetCommand(commandName) {
    for (var i = 0; i < commandCount; i++) {
        var c = commands[i];

        if (c.GetCommandName() == commandName) {
            console.log("YEET, "+commandName);

        }
    }
}

function Populate() {
    commands[0] = new Command("help").GetCommand();
    commands[0].SetAction(Help);
    commands[1] = new Command("north").GetCommand();
    commands[2] = new Command("south").GetCommand();
    commands[3] = new Command("west").GetCommand();
    commands[4] = new Command("east").GetCommand();
    commands[5] = new Command("down").GetCommand();
    commands[6] = new Command("up").GetCommand();

    commandCount = 7;

}

console.log(new Command("ACTUAL AIDS"));

Populate();

function Help() {
    console.log(help);

}