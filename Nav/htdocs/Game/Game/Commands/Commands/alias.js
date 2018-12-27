function Alias(args) {
    var argArray = args.split(" ");

    switch (argArray[0]) {
        case "new":
            argArray.shift();
            CreateAlias(argArray);
            break;
        case "remove": break;

    }
}

function CreateAlias(args) {
    // NAME command command
    if (args.length < 3) {
        game.GetLog().Push("Not enough arguments to create a new alias.");
        return;

    } else {
        var name = args[0];
        args.shift();

        console.log("Commands in alias: "+args);

        var aliasCommand = [];
        for (var i = 0; i < args.length; i++) {
            aliasCommand.push(args[i]);

        }

        console.log("Alias name: "+name);
        console.log("Alias content: "+aliasCommand);

        var alias = new Command(new Array(name), undefined, aliasCommand);
        alias.Initialize();

        console.log(alias);

        AddCommand(alias);

    }
}

function RemoveAlias() {


}