function Snake() {
    this.x = squareSize * 35;
    this.y = squareSize * 12;
    this.moveX = 1;
    this.moveY = 0;
    this.total = 0;
    this.tail = [];

    this.score = 0;
    this.playing = false;
    this.dead = false;

    this.checkEat = function (pos) {
        var d = dist(this.x, this.y, pos.x, pos.y);
        if (d < 1) {
            this.total++;
            this.addScore(100);
            return true;

        } else {
            return false;

        }
    }

    this.move = function (x, y) {
        this.moveX = x;
        this.moveY = y;

    }

    this.addScore = function (x) {
        this.score += x;

    }

    this.drawScore = function () {
        var scoreText = "Score: "+this.score.toString();
        fill(255, 255, 255);
        text(scoreText, 10, 20, 200, 80);
       // fill(255, 255, 255);
       // text(score.toString(), 100, 20);

    }

    this.checkDeath = function () {
        for (var i = 0; i < this.tail.length; i++) {
            var pos = this.tail[i];
            var d = dist(this.x, this.y, pos.x, pos.y);
            if (d <= 1) {
                console.log(pos);
                console.log('Snake died');
                this.total = 0;
                this.tail = [];
                this.playing = false;
                this.dead = true;

                this.score = 0;

            }
        }
    }

    this.setPlaying = function(x){
        this.playing = x;

    }

    this.getPlaying = function(){
        return this.playing;

    }

    this.update = function () {
        if (this.playing === true) {
            for (var i = 0; i < this.tail.length - 1; i++) {
                this.tail[i] = this.tail[i + 1];

            }

            // Move snake tail
            if (this.total >= 1) {
                this.tail[this.total - 1] = createVector(this.x, this.y);

            }

            // Move snake
            this.x = this.x + this.moveX * squareSize;
            this.y = this.y + this.moveY * squareSize;

            // Make sure snake does not go outside boundaries
            this.x = constrain(this.x, 0, width - squareSize);
            this.y = constrain(this.y, 0, height - squareSize);

        }
    }

    this.draw = function () {
        if (this.playing === true){
            fill(255);
            for (var i = 0; i < this.tail.length; i++) {
                rect(this.tail[i].x, this.tail[i].y, squareSize, squareSize);
    
            }
            rect(this.x, this.y, squareSize, squareSize);

        }
        else 
        {
			fill(255);
            for (var i = 0; i < this.tail.length; i++) {
                rect(this.tail[i].x, this.tail[i].y, squareSize, squareSize);
    
            }
            rect(this.x, this.y, squareSize, squareSize);
			
            if (this.dead){
                fill(255, 255, 255);
                text('YOU LOSE, PRESS \'R\' TO START OVER', width / 2 - 170, height / 2);

            } else {
                fill(255, 255, 255);
                text('Game paused, press \'P\' to unpause.', width / 2 - 170, height / 2);

            }
        }
    }
}