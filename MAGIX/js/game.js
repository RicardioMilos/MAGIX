
let selectedCard = null;

const state = () => {
    fetch("ajax-state.php", {   // Il faut créer cette page et son contrôleur appelle 
        method : "POST",       // l’API (games/state)
        credentials: "include"
    })
.then(response => response.json())
.then(data => {
	if(data["result"] === "LAST_GAME_LOST" || data["result"] === "LAST_GAME_LOST")
	{
		console.log("END");
		let formData = new FormData();
		formData.append("QUIT", data["result"]);

		fetch("ajax-battle.php", {
			method : "POST",
			credentials : "include",
			body : formData,
		})
	}
    	console.log(data["result"]); // contient les cartes/état du jeu.
		loadState(data);
    	setTimeout(state, 1000); // Attendre 1 seconde avant de relancer l’appel
    },
	)
}

window.addEventListener("load", () => {
	setTimeout(state, 1000); // Appel initial (attendre 1 seconde)
});

const loadState = (data) => {
	if(typeof data["result"] === "object"){
		loadPlayersInfo(data);
		loadHand(data);
		loadBoard(data);
	}
}

const loadPlayersInfo = (data) => {
	document.getElementById("hp-display").innerHTML = data["result"]["hp"];
	document.getElementById("mana-display").innerHTML = data["result"]["mp"];
	document.getElementById("deck-display").innerHTML = data["result"]["remainingCardsCount"];
	document.getElementById("time-display").innerHTML = data["result"]["remainingTurnTime"];

	document.getElementById("enemy-health").innerHTML = data["result"]["opponent"]["hp"];
	document.getElementById("enemy-mana").innerHTML = data["result"]["opponent"]["mp"];
	document.getElementById("profile-Img").src = findClassImage(data["result"]["opponent"]["heroClass"]);
	document.getElementById("profile-Img").onclick = function(){selectCard(data, 0, "OPPONENT")};
	document.getElementById("enemy-deck").innerHTML = data["result"]["opponent"]["remainingCardsCount"];
}

const loadHand = (data) => {
	var ul = document.getElementById("player-handUL");
	ul.innerHTML = "";
	let templateHTML = document.querySelector("#faceUpCard-template").innerHTML;

	for (let i = 0; i < data["result"]["hand"].length; i++) {
		let li = document.createElement("li");
		li.className = "cardFaceUp";
		li.id = i;
		li.innerHTML = templateHTML;

		let img = findCardImage(data, data["result"]["hand"][i].id);
		li.querySelector("img").src = img;

		let pattern = /([A-Za-z\s]+)(?=(\.jpg))/;
		let cardName = pattern.exec(img);
		li.querySelector("h2").innerText = cardName[0];

		data["result"]["hand"][i].mechanics.forEach(mechanic => {
			let mechLI = document.createElement("li");
			mechLI.innerHTML = mechanic;
			li.querySelector(".mechanics").append(mechLI);
		}); 

		li.querySelector(".cost").innerText = data["result"]["hand"][i].cost;
		li.querySelector(".hp").innerText = data["result"]["hand"][i].hp;
		li.querySelector(".attack").innerText = data["result"]["hand"][i].atk;

		li.onclick = function(){selectCard(data, this.id, "HAND")};

		ul.append(li);
	}	
}

const loadBoard = (data) => {
	let templateHTML = document.querySelector("#faceUpCard-template").innerHTML;

	var playerUL = document.getElementById("player-boardUL");
	playerUL.innerHTML = "";
	for (let i = 0; i < data["result"]["board"].length; i++) {
		let li = document.createElement("li");
		li.className = "cardFaceUp";
		li.id = i;
		li.innerHTML = templateHTML;

		let img = findCardImage(data, data["result"]["board"][i].id);
		li.querySelector("img").src = img;

		let pattern = /([A-Za-z\s]+)(?=(\.jpg))/;
		let cardName = pattern.exec(img);
		li.querySelector("h2").innerText = cardName[0];

		data["result"]["board"][i].mechanics.forEach(mechanic => {
			let mechLI = document.createElement("li");
			mechLI.innerHTML = mechanic;
			li.querySelector(".mechanics").append(mechLI);
		}); 

		li.querySelector(".cost").innerText = data["result"]["board"][i].cost;
		li.querySelector(".hp").innerText = data["result"]["board"][i].hp;
		li.querySelector(".attack").innerText = data["result"]["board"][i].atk;

		li.onclick = function(){selectCard(data, this.id, "MYBOARD")};

		playerUL.append(li);
	}

	var enemyUL = document.getElementById("enemy-boardUL");
	enemyUL.innerHTML = "";
	for (let i = 0; i < data["result"]["opponent"]["board"].length; i++) {
		let li = document.createElement("li");
		li.className = "cardFaceUp";
		li.id = i;
		li.innerHTML = templateHTML;

		let img = findCardImage(data, data["result"]["opponent"]["board"][i].id);
		li.querySelector("img").src = img;

		let pattern = /([A-Za-z\s]+)(?=(\.jpg))/;
		let cardName = pattern.exec(img);
		li.querySelector("h2").innerText = cardName[0];

		data["result"]["opponent"]["board"][i].mechanics.forEach(mechanic => {
			let mechLI = document.createElement("li");
			mechLI.innerHTML = mechanic;
			li.querySelector(".mechanics").append(mechLI);
		}); 

		li.querySelector(".cost").innerText = data["result"]["opponent"]["board"][i].cost;
		li.querySelector(".hp").innerText = data["result"]["opponent"]["board"][i].hp;
		li.querySelector(".attack").innerText = data["result"]["opponent"]["board"][i].atk;

		li.onclick = function(){selectCard(data, this.id, "OPBOARD")};

		enemyUL.append(li);
	}
}

const selectCard = (data, id, zone) => {

	let tempCard = null;
	switch(zone){
		case "HAND":
			if(selectedCard == null){
				selectedCard = {}
				selectedCard["id"] = data["result"]["hand"][id].uid;
				selectedCard["zone"] = zone;
			}
			else if(selectedCard["id"] == data["result"]["hand"][id].uid){
				let formData = new FormData();
				formData.append("PLAYED", selectedCard["id"]);

				fetch("ajax-battle.php", {
					method : "POST",
					credentials : "include",
					body : formData,
				})
				selectedCard = null;
			} 
			else{
				selectedCard = null;
			}
			break;
		case "MYBOARD":
			if(selectedCard == null){
				selectedCard = {}
				selectedCard["id"] = data["result"]["board"][id].uid;
				selectedCard["zone"] = zone;
			}
			break;
		case "OPBOARD":
			tempCard = {}
			tempCard["id"] = data["result"]["opponent"]["board"][id].uid;
			tempCard["zone"] = zone;

			if(selectedCard != null){
				if(selectedCard["zone"] == "MYBOARD"){
					let formData = new FormData();
					formData.append("ATTACKING", selectedCard["id"]);
					formData.append("ATTACKED", tempCard["id"]);

					fetch("ajax-battle.php", {
						method : "POST",
						credentials : "include",
						body : formData,
					})
				}
				selectedCard = null;
			}
			break;
		case "OPPONENT":
			if(selectedCard != null){
				if(selectedCard["zone"] == "MYBOARD"){
					let formData = new FormData();
					formData.append("ATTACKING", selectedCard["id"]);
					formData.append("ATTACKED", id);

					fetch("ajax-battle.php", {
						method : "POST",
						credentials : "include",
						body : formData,
					})
					.then(response => response.json())
					.then(attack => {
							console.log(attack);
						},
						)
				}
				selectedCard = null;
			}
			break;	
	}
}

const usePower = () => {
	let formData = new FormData();
	formData.append("POWER", "skip");
	fetch("ajax-battle.php", {
		method : "POST",
		credentials : "include",
		body : formData,
	})
}

const skipTurn = () => {
	let formData = new FormData();
	formData.append("SKIP", "skip");
	fetch("ajax-battle.php", {
		method : "POST",
		credentials : "include",
		body : formData,
	})
}

const findCardImage = (data, id) => {
	$path = "images/TCP/portraits/" + String(data[0][id + 1]);
	return $path;
}

const findClassImage = (className) => {
	$path = "images/TCP/portraits/" + className + ".jpg";
	return $path;
}