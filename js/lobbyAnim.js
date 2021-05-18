let canvas = null;
let ctx = null;

let spriteList = [];

window.addEventListener("load", () => {
    canvas = document.querySelector("canvas");
    ctx = canvas.getContext("2d");
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
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
        this.timeAlive = 0;
        this.size = 2 + Math.random() * 5;
        this.speed = 2;
    }

    tick() {
        let alive = true;

        this.y -= this.speed;
        this.timeAlive += 1;
        ctx.fillStyle = "#00FF00";
        ctx.fillRect(this.x, this.y, this.size, this.size);

        if (this.y < 0 || this.timeAlive > 30) {
            alive = false;
        }

        return alive;
    }
}

function spawnAtPos(e) {
    var x = e.clientX;
    var y = e.clientY;

    spriteList.push(new Flamme(x, y - 1));

    spriteList.push(new Flamme(x - 1, y));
    spriteList.push(new Flamme(x, y));
    spriteList.push(new Flamme(x + 1, y));

    spriteList.push(new Flamme(x, y - 1));
}

const applyStyles = iframe =>{
    let styles = {
        hideIcons: true,
        fontColor : "#00FF00",
        color : "#00FF00",
		backgroundColor : "rgba(0, 0, 0, 0.5)",
		fontGoogleName : "Lato",
		fontSize : "20px",
    }
    iframe.contentWindow.postMessage(JSON.stringify(styles), "*");
}

const toggleObserveInput = () => {
    var elem = document.getElementById("observeInput-container");
    if(elem.style.display == 'none'){
		elem.style.display = 'flex';
	}
	else{
		elem.style.display = 'none';
	}
}