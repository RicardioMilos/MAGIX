let spriteList = [];
let time = 10;

var dirEnum = {
    Top: 0,
    Bottom: 1,
    Left: 2,
    Right: 3,
}

window.addEventListener("load", () => {
    
    var node = document.createElement("div");
    node.className = "revenant"
    node.id = "revenantL";
    node.style.zIndex = 0;
    document.getElementById("auth-body").appendChild(node);

    var node = document.createElement("div");
    node.className = "revenant"
    node.id = "revenantR";
    node.style.zIndex = 0;
    document.getElementById("auth-body").appendChild(node);

    spriteList.push(new Revenant("revenantL", dirEnum.Left));
    spriteList.push(new Revenant("revenantR", dirEnum.Right));
    tick();

    setTimeout(reduceTime, 1000);
});

const reduceTime = () => {
    time--;
    if (time > 0) {
        setTimeout(reduceTime, 1000);

    }
}

const tick = () => {
    for (let i = 0; i < spriteList.length; i++) {
        const element = spriteList[i];
        element.tick();
    }

    window.requestAnimationFrame(tick);
}

const saveMsg = () => {
    localStorage["myMessage"] = document.getElementById("username").value;
}