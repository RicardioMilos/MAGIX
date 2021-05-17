var dirEnum = {
    Top: 0,
    Bottom: 1,
    Left: 2,
    Right: 3,
}

var removalDone = false;

class Revenant {
    constructor(id, direction) {
        this.direction = direction;
        this.element = document.getElementById(id);
        this.startX = null;
        this.startY = null;
        this.changeAnimDone = false;

        let columnCount = 8;
		let rowCount = 4;
		let refreshDelay = 100;
		let loopColumn = true;
		let scale = 1;
        this.tiledImage = new TiledImage("images/AnimSpirLogin/BNSpriteSheet.png",
             columnCount, rowCount, refreshDelay, loopColumn, scale, id);
        
        if(this.direction == dirEnum.Left){
            
             this.tiledImage.changeRow(3);
        }
        if(this.direction == dirEnum.Right){
            
            this.tiledImage.changeRow(2);
        }
		this.tiledImage.changeMinMaxInterval(0, 7);

        this.move();
    }

    move() {
        if(this.direction == dirEnum.Right){
            this.startX = 0
            this.element.style.left = this.startX + "px";
        }
        else if(this.direction == dirEnum.Left){
            this.startX  = (window.innerWidth - (window.innerWidth / 20));
            this.element.style.left = this.startX + "px";
        }
        this.startY = (window.innerHeight - (window.innerHeight / 9));
        this.element.style.top = this.startY + "px";
    }

    tick() {
        if(!removalDone){
            if(time == 0 && !removalDone){  
                var parent = document.getElementById("auth-body");
                var revL = document.getElementById("revenantL");
                var revR = document.getElementById("revenantR");
                parent.removeChild(revL);
                parent.removeChild(revR);
                this.tiledImage = null;
                removalDone = true;
            }
            else if (time < 5) {
                if (this.changeAnimDone == false) {
                    this.tiledImage.changeRow(0);
                    this.tiledImage.changeMinMaxInterval(0, 4);
                    this.changeAnimDone = true;
                }
                this.direction = dirEnum.top;
                let top = this.element.offsetTop;
                this.element.style.top = top - 2 + "px";
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
            if(!removalDone){
                this.tiledImage.tick(this.element.offsetLeft, this.element.offsetTop);
            }
    }
    }
}