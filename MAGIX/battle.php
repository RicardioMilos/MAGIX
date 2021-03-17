<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/battle.css">
</head>
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
        <div class="enemy-health"></div>
        <div class="enemy-profile"></div>
        <div class="enemy-mana"></div>
    </div>
    <div class="enemy-deck"></div>
</div>

<div class="table-container">
    <div class="cards-container" id="topCardContainer">
    <ul>
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
    <ul>
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
        <div class="hp-display"></div>
        <div class="mana-display"></div>
        <div class="deck-display"></div>
    </div>
    <div class="hand-container">
        <div class="player-hand">
            <ul>
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
    <div class="action-container">
        <div>
            <input type="submit" name="Power" value="Hero Power" />
        </div>
        <div>
        <input type="submit" name="Skip" value="Skip Turn" />
        </div>
        <div class="time-display"></div>
    </div>
</div>

</body>
</html>