class Player {
    constructor(name) {
        this.name = name;
        this.inventory = new Inventory();

    }

    GetName(){
        return this.name;

    }
}