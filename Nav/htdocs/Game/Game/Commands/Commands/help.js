function Help(args) {
    game.GetLog().Pop();
    if (args.length != 0) {
        switch (args.trim()) {
            case "new": HelpNew(); break;
            case "movement": break;
            case "objects": break;
            case "communication": break;
            case "combat": break;
            case "skills": break;
            case "magic": break;
            case "miscellaneous": break;
            case "subjects": break;
            case "FAQ": break;

            default: HelpDefault(); break;

        }
        return;

    }
}

function HelpDefault(){
    game.GetLog().Push("Welcome to " + gameName + ", if you are a new player,");
    game.GetLog().Push("please do 'Help New'.");
    game.GetLog().Push("Other help categories include:");
    game.GetLog().Push("Help New");
    game.GetLog().Push("Help Movement");
    game.GetLog().Push("Help Objects");
    game.GetLog().Push("Help Communication");
    game.GetLog().Push("Help Combat");
    game.GetLog().Push("Help Skills");
    game.GetLog().Push("Help Magic");
    game.GetLog().Push("Help Miscellaneous");
    game.GetLog().Push("Help Subjects");
    game.GetLog().Push("Also try checking out the FAQ with 'Help FAQ'");

}

function HelpNew() {
    console.log("Aids")
    game.GetLog().Push("To start playing the game");

}