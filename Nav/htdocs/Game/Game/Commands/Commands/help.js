function Help(args) {
    game.GetLog().Pop();
    if (args.length != 0) {
        switch (args.trim()) {
            case "new": DoItLater(); break;
            case "movement": DoItLater(); break;
            case "objects": DoItLater(); break;
            case "communication": DoItLater(); break;
            case "combat": DoItLater(); break;
            case "skills": DoItLater(); break;
            case "magic": DoItLater(); break;
            case "miscellaneous": DoItLater(); break;
            case "subjects": DoItLater(); break;
            case "FAQ": DoItLater(); break;

            default: HelpDefault(); break;

        }
        return;

    }
}

function DoItLater(){
    game.GetLog().Push("\\t I'll do this later");

}

function HelpDefault() {
    game.GetLog().Clear();
    game.GetLog().Push("\\i Welcome to the game!");
    game.GetLog().Push("if you are a new player,");
    game.GetLog().Push("check out 'Help New' for some beginner tips.");
    game.GetLog().Push("Other help categories include:");
    game.GetLog().Push("\\t Help New");
    game.GetLog().Push("\\t Help Movement");
    game.GetLog().Push("\\t Help Objects");
    game.GetLog().Push("\\t Help Communication");
    game.GetLog().Push("\\t Help Combat");
    game.GetLog().Push("\\t Help Skills");
    game.GetLog().Push("\\t Help Magic");
    game.GetLog().Push("\\t Help Miscellaneous");
    game.GetLog().Push("\\t Help Subjects");
    game.GetLog().Push("Also try checking out the FAQ with 'Help FAQ'");

}