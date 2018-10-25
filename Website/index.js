var snake;
var squareSize = 20;

var centerX;
var centerY;

var food;

function aboutPressed(){
    window.location.href = "about.html";

}

function setup() {
    createCanvas(screen.width-15, 500);
    snake = new Snake();
    textSize(20);
    frameRate(15);
    generateFood();

}

function generateFood() {
    var columns = floor(width / squareSize);
    var rows = floor(height / squareSize);
    centerX = columns / 2;
    centerY = rows / 2;
    food = createVector(floor(random(columns)), floor(random(rows)));
    food.mult(squareSize);

}

function mousePressed() {
    snake.total++;
}

function draw() {
    background(25);

    if (snake.checkEat(food)) {
        generateFood();

    }

    snake.checkDeath();
    snake.update();
    snake.draw();

    snake.drawScore();

    fill(255, 0, 100);
    rect(food.x, food.y, squareSize, squareSize);

}

function keyPressed() {
    if (keyCode === UP_ARROW) {
        snake.move(0, -1);

    } else if (keyCode === DOWN_ARROW) {
        snake.move(0, 1);

    } else if (keyCode === RIGHT_ARROW) {
        snake.move(1, 0);

    } else if (keyCode === LEFT_ARROW) {
        snake.move(-1, 0);

    } else if (keyCode === 82)  {
        console.log("Restarting");
        snake = new Snake();
        snake.setPlaying(true);
        generateFood();

    }else if (keyCode === 80)  {
        console.log("Pausing");
        snake.setPlaying(!snake.getPlaying());

    }
}