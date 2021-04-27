<?php
    require_once("action/BattleAction.php");

    $action = new BattleAction();
	$data = $action->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/battle.css">
    <script src="js/game.js"></script>
</head>

<template id="faceUpCard-template">
			
			<div class="card-imageContainer">
                <div>
                    <img src="" alt="">
                </div>
            </div>
            <div class="card-textsContainer">
                <h2></h2>
                <ul class="mechanics" id="mechanicsUL">
                </ul>
            </div>
            <div class="card-statsContainer">
                <div class="hp"></div>
                <div class="attack"></div>
                <div class="cost"></div>
            </div>
</template>

<body class="battle-body">

<div class="enemy-container">
    <div class="enemy-hand">
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="enemy-status">
        <div class="enemy-health" id="enemy-health"></div>
        <div id="profile-imageContainer">
            <div>
                <img id="profile-Img">
            </div>
        </div>
        <div class="enemy-mana" id="enemy-mana"></div>
    </div>
    <div class="enemy-deck" id="enemy-deck"></div>
</div>

<div class="table-container">
    <div class="cards-container" id="topCardContainer">
    <ul id="enemy-boardUL">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="cards-container" id="bottomCardContainer">
    <ul id="player-boardUL">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>

<div class="user-container">
    <div class="display-container">
        <div class="hp-display" id="hp-display"></div>
        <div class="mana-display" id="mana-display"></div>
        <div class="deck-display" id="deck-display"></div>
    </div>
    <div class="hand-container">
        <div class="player-hand">
            <ul id="player-handUL">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
    <form class="action-container">
        <div>
            <input type="submit" name="POWER" value="POWER" onclick="usePower()"/>
        </div>
        <div>
            <input type="submit" name="SKIP" value="SKIP" onclick="skipTurn()"/>
        </div>
        <div class="time-display" id="time-display"></div>
    </form>
</div>

</body>
</html>