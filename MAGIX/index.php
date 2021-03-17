<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/TiledImage.js"></script>
    <script src="js/sprites/Revenant.js"></script>
    <script src="js/loginAnim.js"></script>
    <link rel="stylesheet" href="css/global.css">
</head>
<body class="login-body" id="auth-body">
    <div class="static-elements">
        <div id="title">
            <p id="outOf"> OUT OF</p> <p id="magenta">MAGENTA</p>
        </div>
        <form action="lobby.php" method="post" id="formLogin">
            <div class="login-line">
                <div class="form-input">
                    <input type="text" name="username" value="" placeholder="Pseudo" />
                </div>
                <div class="form-input">
                    <input type="password" name="password" placeholder="Mot De Passe"/>
                </div>
                <div class="form-button">
                    <input type="submit" value="ENTRER" id="btnSubmit">
                </div>
            </div>
        </form>
    </div>
</body>
</html>