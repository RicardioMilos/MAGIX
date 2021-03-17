var dirEnum = {
    Top: 0,
    Bottom: 1,
    Left: 2,
    Right: 3,
}

var removalDone = false;
var changeAnimDone = false;

class Revenant {
    constructor(id, direction) {
        this.direction = direction;
        this.element = document.getElementById(id);
        this.startX = null;
        this.startY = null;

        let columnCount = 8;
		let rowCount = 4;
		let refreshDelay = 100;
		let loopColumn = true;
		let scale = 1;
        this.tiledImage = new TiledImage("images/AnimSpirLogin/BNSpriteSheet.png",
             columnCount, rowCount, refreshDelay, loopColumn, scale, null);
        if(this.direction == dirEnum.left){
            
             this.tiledImage.changeRow(4);
        }
        else {
             this.tiledImage.changeRow(3);
        }
		this.tiledImage.changeMinMaxInterval(0, 7);

        this.move();
    }

    move() {
        if(this.direction == dirEnum.Right){
            this.startX = 135;
            this.element.style.left = this.startX + "px";
        }
        else if(this.direction == dirEnum.Left){
            this.startX  = (window.innerWidth - 200);
            this.element.style.left = this.startX + "px";
        }
        this.startY = 800;
        this.element.style.top = this.startY + "px";
    }

    tick() {
        console.log(time);
        if(time == 0 && !removalDone){  
            var parent = document.getElementById("auth-body");
            var revL = document.getElementById("revenantL");
            var revR = document.getElementById("revenantR");
            parent.removeChild(revL);
            parent.removeChild(revR);
            removalDone = true;
        }
        else if (time < 5) {
            if (changeAnimDone == false) {
                console.log("TEST")
                this.tiledImage.changeRow(0);
		        this.tiledImage.changeMinMaxInterval(0, 4);
                changeAnimDone = true;
            }
            this.direction = dirEnum.top;
            let top = this.element.offsetTop;
            this.element.style.top = top - 1 + "px";
        }
        else {
            if(this.direction == dirEnum.Right){
                let left = this.element.offsetLeft;
                this.element.style.left = left + 2 + "px";
            } else if(this.direction == dirEnum.Left){
                let left = this.element.offsetLeft;
                this.element.style.left = left - 2 + "px";
            }
        }
    }
}

class Skeleton {
	constructor() {
		
		/*
		this.tiledImage.addImage("images/item-hood-walk.png");
		this.tiledImage.addImage("images/item-shield-walk.png"); */

		this.x = 150;
		this.y = 150;
	}

	tick () {
		if (leftArrowOn) {
			this.x--;
			// this.tiledImage.setFlipped(false);
			this.tiledImage.changeRow(1);
		}

		if (rightArrowOn) {
			this.x++;
			this.tiledImage.changeRow(3);
			// this.tiledImage.setFlipped(true);
		}

		this.tiledImage.tick(this.x, this.y, ctx);

		return true;
	}
}