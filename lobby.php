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
        <form action="lobby.php" class="lobby-options" method="post" id="formLobby">
            <div class="pratique-option">
                <input type="submit" name="trainBtn" value="Pratique">
            </div>
            <div class="jouer-option">
                <input type="submit" name="playBtn" value="Jouer">
            </div>
            <div class="watch-option">
                <input type="submit" name="watchBtn" value="Observer">
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