<?php
    require_once("action/LobbyAction.php");

    $action = new LobbyAction();
	$data = $action->execute();

    require_once("partials/header.php");
?>

    <title>LOBBY</title>
    <script src="js/lobbyAnim.js"></script>
    <link rel="stylesheet" href="css/lobby.css">
</head>
<body class="lobby-body">
    <div class="lobby-container">
        <form action="lobby.php" method="post" class="observeInput-container" id="observeInput-container">
            <input type="text" name="observeInput" id="observeInput" placeholder="Nom d'Usager">
            <input type="submit" name="searchBtn" value="Chercher">
        </form>
        <form action="lobby.php" method="post" class="lobby-options" id="formLobby">
            <div class="pratique-option">
                <input type="submit" name="trainBtn" value="Pratique">
            </div>
            <div class="jouer-option">
                <input type="submit" name="playBtn" value="Jouer">
            </div>
            <div class="watch-option">
                <input type="button" name="watchBtn" value="Observer" onclick="toggleObserveInput()">
            </div>
            <div class="guide-option">
                <input type="submit" name="guideBtn" value="Guide">
            </div>
            <div class="quitter-option">
                <input type="submit" name="quitBtn" value="Quitter">
            </div>
        </form>
        <div id="chat-container">
            <iframe onload="applyStyles(this)"
                src="https://magix.apps-de-cours.com/server/#/chat/<?=$_SESSION["key"] . '/large'?>"> 
            </iframe>
        </div>
		<canvas id="canvas"></canvas>
	</div>

<?php
    require_once("partials/footer.php");