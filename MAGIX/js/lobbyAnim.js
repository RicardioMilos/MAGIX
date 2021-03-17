let canvas = null;
let ctx = null;

let spriteList = [];

window.addEventListener("load", () => {
    canvas = document.querySelector("canvas");
    ctx = canvas.getContext("2d");
    canvas.addEventListener("mousemove", spawnAtPos);
    tick();
})



const tick = () => {
    ctx.clearRect(0, 0, canvas.width, canvas.width);

    for (let i = 0; i < spriteList.length; i++) {
        const sprite = spriteList[i];
        let alive = sprite.tick();

        if (!alive) {
            spriteList.splice(i, 1);
            i--;
        }
    }

    window.requestAnimationFrame(tick);
}

class Flamme {
    constructor(x, y) {
        this.x = x;
        this.y = y;
        this.size = 2 + Math.random() * 5;
        //this.speed = this.size/2;
        this.speed = 2;
    }

    tick() {
        let alive = true;

        this.y -= this.speed;
        ctx.fillStyle = "#00FF00";
        ctx.fillRect(this.x, this.y, this.size, this.size);

        if (this.y < 0) {
            alive = false;
        }

        return alive;
    }
}

function spawnAtPos(e) {
    var x = e.clientX;
    var y = e.clientY;

    spriteList.push(new Flamme(x, y));
    console.log(x, y);
}