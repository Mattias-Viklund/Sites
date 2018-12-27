function ListCommand(args) {
    var argArray = args.split(" ");

    switch (argArray[0]) {
        case "commands":
            argArray.shift();
            ListCommands(argArray);
            break;

    }
}

function ListCommands(args) {
    var log = game.GetLog();

    var page = 1;
    if (args.length !== 0)
        page = parseInt(args[0]);

    console.log("Command page: " + page);

    log.Push("Page "+page);

    for (var i = ((page - 1) * logLabels) + 1; i < logLabels * page; i++) {
        if (i >= commands.length) {
            console.log("Command end: " + i);
            break;

        }
        log.Push(commands[i-1].GetName());

    }
}