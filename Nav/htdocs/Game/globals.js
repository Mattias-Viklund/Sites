var gameName = "the game";

function GetWordAtIndex(message, index) {
    var split = message.split(" ");
    if (split.length == 0)
        return -1;
    else
        if (split.length < index)
            return -1;
        else
            return split[index];

}