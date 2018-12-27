class Command {
    constructor(commandNames, onInitialize, aliasCommands, hideCommand) {
        this.commandNames = new Array(commandNames.length)
        this.isAlias = false;
        this.hideCommand = false;

        for (var i = 0; i < commandNames.length; i++) {
            this.commandNames[i] = commandNames[i];

        }

        this.action = this.DefaultAction;
        this.initalizeAction = this.DefaultAction;

        if (typeof onInitialize !== 'undefined')
            this.initalizeAction = onInitialize;

        if (typeof hideCommand !== 'undefined')
            this.hideCommand = hideCommand;

        if (typeof aliasCommands !== 'undefined') {
            this.isAlias = true;
            // AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH
            this.initalizeAction = function () { for (var i = 0; i < aliasCommands.length; i++) { SendGlobal(aliasCommands[i]); } };

        }
    }

    DefaultAction() {
        game.GetLog().Pop();
        game.GetLog().Push("TODO: This command");

    }

    GetName() {
        if (!this.hideCommand)
            return this.commandNames[0];
        else
            return "-=COMMAND HIDDEN=-";

    }

    GetCommandNames() {
        return this.commandNames;

    }

    SetAction(action) {
        this.action = action;

    }

    Initialize() {
        this.action = this.initalizeAction;

    }

    UseCommand(args) {
        this.action(args);

    }
}

var commands = [];
var commandCount = 0;

function GetCommand(commandName) {
    for (var i = 0; i < commands.length; i++) {
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
    commands.push(command);
    commandCount++;
    console.log("Commands in list: " + commandCount);

}

function InitalizeCommands() {
    for (var i = 0; i < commandCount; i++) {
        commands[i].Initialize();

    }
}