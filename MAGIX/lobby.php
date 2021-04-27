<?php
    require_once("action/LobbyAction.php");

    $action = new LobbyAction();
	$data = $action->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div class="quitter-option">
                <input type="submit" name="quitBtn" value="Quitter">
            </div>
        </form>
        <iframe style="width:700px;height:240px;" onload="applyStyles(this)"
            src="https://magix.apps-de-cours.com/server/#/chat/<?=$_SESSION["key"]?>"> 
        </iframe>
		<canvas id="canvas"></canvas>
	</div>
</body>
</html>