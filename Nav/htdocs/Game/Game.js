var textboxValue = "";

function StartGame() {


}

function SendInput() {


}

class Game {
    player;
    world;
    input;

    Game(playerName) {
        this.player = new Player(playerName);
        this.world = new World(20);
        this.input = new Input();

    }

    GameLoop() {
        this.Update();
        this.input.WaitForInput();

    }

    Update(){


    }
}

class Input {
    waitingForInput = false;

    
    Input() {


    }

    WaitForInput() {


    }
}

class Command {
    command = "";

    Command() {

    }

    GetCommand() {
        return this.command;

    }
}

class Player {
    name = ""
    inventory;

    Player(name) {
        this.name = name;
        this.inventory = new Inventory();

    }
}

class World {
    size = 0;
    tileRows;

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
    size = 0;
    tiles;

    TileRow(size) {
        this.size = size;
        this.tiles = new MapTile[size];
        this.FillTiles();

    }

    FillTiles() {
        for (i = 0; i < this.size; i++)
        {
            tiles[i] = new MapTile();

        }
    }
}

class MapTile {
    TileTypes = {
        FOREST: 0,
        TOWN: 1,
        LAKE: 2,
        CAVE: 3,
        FIELD: 4

    };

    tileType;

    MapTile(tileType){
        this.tileType = tileType;

    }
}

class Inventory {
    maxSize = 0;
    items;

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
    name = "";
    value = 0;

    BaseItem(name, value) {
        this.name = name;
        this.value = value;

    }
}
