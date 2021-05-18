
let selectedCard = null;

const state = () => {
    fetch("ajax-state.php", {   // Il faut créer cette page et son contrôleur appelle 
        method : "POST",       // l’API (games/state)
        credentials: "include"
    })
.then(response => response.json())
.then(data => {
	if(data["result"] === "LAST_GAME_WON" || data["result"] === "LAST_GAME_LOST" || data["result"] === "GAME_NOT_FOUND")
	{
		displayResult(data["result"]);
		setTimeout(() => {  window.location.replace("lobby.php"); }, 3000);
		let formData = new FormData();
		formData.append("END_OF_GAME_RESULT", data["result"]);

		fetch("ajax-battle.php", {
			method : "POST",
			credentials : "include",
			body : formData,
		})
	}	
	else{
    	console.log(data["result"]); // contient les cartes/état du jeu.
		loadState(data);
    	setTimeout(state, 1000); // Attendre 1 seconde avant de relancer l’appel
	}
    },
	)
}

window.addEventListener("load", () => {
	setTimeout(state, 1000); // Appel initial (attendre 1 seconde)
});

const displayResult = (result) => {
	var elem = document.getElementById("result-container");
	elem.style.display = 'flex';
	elem.innerHTML = result;
}

const hideResult = () => {
	var elem = document.getElementById("result-container");
	elem.innerHTML = "";
	elem.style.display = 'none';
}

const toggleChat = () => {
	var elem = document.getElementById("chat-container");
	if(elem.style.display == 'none'){
		elem.style.display = 'block';
	}
	else{
		elem.style.display = 'none';
	}
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

const loadState = (data) => {
	if(typeof data["result"] === "object"){
		loadPlayersInfo(data);
		loadCards(data, "enemy-boardUL", data["result"]["opponent"]["board"], "OPBOARD");
		loadCards(data, "player-handUL", data["result"]["hand"], "HAND");
		loadCards(data, "player-boardUL", data["result"]["board"], "MYBOARD");
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
	
	let opHandUL = document.getElementById("op-handContainer");
	opHandUL.innerHTML = "";
	for(let c = 0; c < data["result"]["opponent"]["handSize"]; c++){
		let li = document.createElement("li");
		opHandUL.append(li);
	}
}


const loadCards = (data, spaceID, cardPool, zone) => {
	let templateHTML = document.querySelector("#faceUpCard-template").innerHTML;

	var playerUL = document.getElementById(spaceID);
	playerUL.innerHTML = "";
	for (let i = 0; i < cardPool.length; i++) {
		let li = document.createElement("li");
		li.className = "cardFaceUp";
		li.id = i;
		li.innerHTML = templateHTML;

		
		try{
			let img = findCardImage(data, cardPool[i].id);
			li.querySelector("img").src = img;
			let pattern = /([A-Za-z\s]+)(?=(\.jpg))/;
			let cardName = pattern.exec(img);
			li.querySelector("h2").innerText = cardName[0];
		}
		catch{
			let img = "images/TCP/portraits/0_Generique.jpg";
			li.querySelector("img").src = img;
			let pattern = /([A-Za-z\s]+)(?=(\.jpg))/;
			let cardName = pattern.exec(img);
			li.querySelector("h2").innerText = cardName[0];
		}

		if(zone == "HAND"){
			if(cardPool[i].cost <= data["result"]["mp"]){
				li.style.border = "#00FF00 solid 2px";
				li.style.color = "#00FF00";

				let c = li.children;
				for (j = 0; j < c.length; j++) {
					c[j].style.border = "#00FF00 solid 1px";
				}
			}
		}

		cardPool[i].mechanics.forEach(mechanic => {
			let mechLI = document.createElement("li");
			mechLI.innerHTML = mechanic;
			li.querySelector(".mechanics").append(mechLI);
			if(mechanic == "Stealth"){
				li.querySelector("img").src = "images/effects/stealth.gif";
			}
			if(mechanic == "Taunt"){
				li.style.backgroundImage = "url('images/effects/Taunt.png')";
				li.style.backgroundPosition = 'center';
				li.style.backgroundSize = '120% 110%';
			}
		}); 

		li.querySelector(".cost").innerText = cardPool[i].cost;
		li.querySelector(".hp").innerText = cardPool[i].hp;
		li.querySelector(".attack").innerText = cardPool[i].atk;

		li.onclick = function(){selectCard(data, this.id, zone)};

		playerUL.append(li);
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
				.then(response => response.json())
					.then(attack => {
						if (typeof attack['result'] === 'string' || attack['result'] instanceof String){
							displayResult(attack['result']);
							setTimeout(() => {  hideResult(); }, 1000);
						}
						},
				)
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
					.then(response => response.json())
					.then(attack => {
						if (typeof attack['result'] === 'string' || attack['result'] instanceof String){
							displayResult(attack['result']);
							setTimeout(() => {  hideResult(); }, 1000);
						}
						},
					)
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
						if (typeof attack['result'] === 'string' || attack['result'] instanceof String){
							displayResult(attack['result']);
							setTimeout(() => {  hideResult(); }, 1000);
						}
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
	.then(response => response.json())
	.then(power => {
		if (typeof power['result'] === 'string' || power['result'] instanceof String){
			displayResult(power['result']);
			setTimeout(() => {  hideResult(); }, 1000);
		}
		},
	)
}

const skipTurn = () => {
	let formData = new FormData();
	formData.append("SKIP", "skip");
	fetch("ajax-battle.php", {
		method : "POST",
		credentials : "include",
		body : formData,
	})
	.then(response => response.json())
	.then(skip => {
		if (typeof skip['result'] === 'string' || skip['result'] instanceof String){
			displayResult(skip['result']);
			setTimeout(() => {  hideResult(); }, 1000);
		}
		},
	)
}

const findCardImage = (data, id) => {
	let path = "images/TCP/portraits/" + String(data[0][id + 1]);
	return path;
}

const findClassImage = (className) => {
	let path = "images/TCP/portraits/" + className + ".jpg";
	return path;
}