var deltaTime = 0;
var currentTime = 0;
var lastTime = currentTime;

var camX = 0;
var camY = 0;
var camZ = 0;

function setup() {
    createCanvas(screen.width - 15, screen.height - 220, WEBGL);
    angleMode(DEGREES);

    var fov = 90 / 180 * PI;
    var cameraZ = height / 2.0 / tan(fov / 2.0);
    perspective(60 / 180 * PI, width / height, cameraZ * 0.1, cameraZ * 10);

    currentTime = millis();
    lastTime = currentTime;

}

function draw() {
    background(21);

    gameLoop();

}

function gameLoop() {
    time = millis();
    delta = time - lastTime;

    gameUpdate();
    gameRender();

    lastTime = time;

}

function gameUpdate() {
    orbitControl();

    fill(255);
    for (var x = -2; x < 3; x++) {
        for (var y = -2; y < 3; y++) {
            var clr = 255 / (x + 3);

            push();
                if ((255 / (y + 3)) > clr)
                    clr = (255 / (y + 3));

                fill(clr / 2, clr, clr);
                translate(x * 160, 0, y * 160);
                box(50, 50, 50);

            pop();

        }
    }
}

function gameRender() {


}

function mousePressed() {


}

function keyPressed() {


}