var textboxValue = "";
var game;

function StartGame(name) {  
    game = new Game(name);
    console.log(name);
    game.GameLoop();

}

function SendInput() {


}

class Game {
    Game(playerName) {
        this.player = new Player(playerName);
        this.world = new World(20);

    }

    GameLoop() {
        this.Update();


    }

    Update() {


    }
}

class Command {
    Command(commandName) {
        this.command = commandName;

    }

    GetCommand() {
        return this.command;

    }
}

class Player {
    Player(name) {
        this.name = name;
        this.inventory = new Inventory();

    }
}

class World {
    World(size) {
        this.size = size;
        this.tileRows = new TileRow[size];
        this.FillWorld();

    }

    FillWorld() {
        for (i = 0; i < size; i++) {
            this.tileRows[i] = new TileRow(size);

        }
    }
}

class TileRow {
    TileRow(size) {
        this.size = size;
        this.tiles = new MapTile[size];
        this.FillTiles();

    }

    FillTiles() {
        for (i = 0; i < this.size; i++) {
            tiles[i] = new MapTile();

        }
    }
}

var TileTypes = Object.freeze({
    FOREST: 0,
    TOWN: 1,
    LAKE: 2,
    CAVE: 3,
    FIELD: 4

});

class MapTile {
    MapTile(tileType) {
        this.tileType = tileType;

    }
}

class Inventory {
    Inventory(maxSize) {
        this.maxSize = maxSize;
        this.items = new BaseItem[maxSize];

    }

    RemoveItem(itemIndex) {


    }

    AddItem(item) {
        if (this.items.Length == this.maxSize)
            return;

        items[this.item.Length] = item;

    }
}

class BaseItem {
    BaseItem(name, value) {
        this.name = name;
        this.value = value;

    }
}
