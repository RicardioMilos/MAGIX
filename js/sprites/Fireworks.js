var removalDone = false;

class Fireworks {
    constructor(id, x, y) {
        this.element = document.getElementById(id);
        this.startX = x;
        this.startY = y;

        this.move();
    }

    move() {
        this.element.style.left = this.startX + "px";
        this.element.style.top = this.startY + "px"; // Somehow les valeurs positives de top et bottom ne fonctionne pas
    }

    tick() {
    }
}