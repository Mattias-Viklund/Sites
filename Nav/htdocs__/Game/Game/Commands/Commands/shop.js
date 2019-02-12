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

    log.Push("Commands - page " + page + " (list other pages with 'li commands pagenumber')");

    console.log(commands);

    var skipped = 0;
    for (var i = ((page - 1) * logLabels) + 1; i < logLabels * page + skipped; i++) {
        console.log(commands[i - 1 + skipped]);

        if (commands[i+skipped-1] == undefined) {
            console.log("Command end: " + i + skipped-1);
            break;

        }

        if (!commands[i + skipped - 1].GetHidden()) {
            log.Push("\\t " + commands[i + skipped - 1].GetName());

        } else {
            skipped++;
            i--;

        }
    }
}