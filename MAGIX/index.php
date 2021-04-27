<?php
	require_once("action/IndexAction.php");

	$action = new LoginAction();
	$data = $action->execute();

	//require_once("partial/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/TiledImage.js"></script>
    <script src="js/sprites/Revenant.js"></script>
    <script src="js/loginAnim.js"></script>
    <link rel="stylesheet" href="css/global.css">
    <script>
        window.addEventListener("load", () => {
                    if (localStorage["myMessage"] != null) {
                        document.getElementById("username").value = localStorage["myMessage"];
                    }
                });
    </script>
</head>

<body class="login-body" id="auth-body">
    <div class="static-elements">
        <div id="title">
            <p id="outOf"> OUT OF</p> <p id="magenta">MAGENTA</p>
        </div>
        <form action="index.php" method="post" id="formLogin">
            <?php
				if ($data["hasConnectionError"]) {
					?>
                    <script>console.log("Erreur login");</script>
					<?php
				}
			?>

            <div class="login-line">
                <div class="form-input">
                    <input type="text" name="username" id="username" value="" placeholder="Pseudo" />
                </div>
                <div class="form-input">
                    <input type="password" name="pwd" placeholder="Mot De Passe" autocomplete="off"/>
                </div>
                <div class="form-button">
                    <input type="submit" value="ENTRER" id="btnSubmit" onclick="saveMsg()">
                </div>
            </div>
        </form>
    </div>
</body>
</html>