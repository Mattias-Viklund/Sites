class World {
    constructor(size) {
        this.size = size;
        this.tiles = [];

        for (var x = 0; x < size; x++) {
            for (var y = 0; y < size; y++) {
                this.tiles.push(0);

            }
        }
    }

    GetTile(x, y){
        return this.tiles[x * this.size + y];

    }

    GetSize(){
        return this.size;

    }
}

var TileTypes = Object.freeze({
    NONE: 0,
    FOREST: 1,
    TOWN: 2,
    LAKE: 3,
    CAVE: 4,
    FIELD: 5,
    CITY: 6,

});