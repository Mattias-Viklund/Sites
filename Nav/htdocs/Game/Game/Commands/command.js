class Command {
    constructor(commandNames) {
        this.commandNames = new Array(commandNames.length)
        for (var i = 0; i < commandNames.length; i++) {
            this.commandNames[i] = commandNames[i];

        }
        this.action = this.DefaultAction;

    }

    DefaultAction(){
        game.GetLog().Push("TODO: This command");

    }

    GetCommandNames() {
        return this.commandNames;

    }

    SetAction(action) {
        this.action = action;

    }

    UseCommand(args) {
        this.action(args);

    }
}

var commands = [100];
var commandCount = 0;

function GetCommand(commandName) {
    for (var i = 0; i < commandCount; i++) {
        var c = commands[i];

        for (var o = 0; o < c.GetCommandNames().length; o++) {
            if (c.GetCommandNames()[o] == commandName) {
                console.log("Found command " + commandName + "!")
                return c;


            }
        }
    }
    return null;

}

function AddCommand(command) {
    commands[commandCount] = command;
    commandCount++;
    console.log("Commands in list: "+commandCount);

}