<?php
	require_once("action/IndexAction.php");

	$action = new LoginAction();
	$data = $action->execute();

	require_once("partials/header.php");
?>

    <title>LOGIN</title>
    <script src="js/TiledImage.js"></script>
    <script src="js/sprites/Revenant.js"></script>
    <script src="js/sprites/Fireworks.js"></script>
    <script src="js/loginAnim.js"></script>
    <link rel="stylesheet" href="css/index.css">
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

<?php
    require_once("partials/footer.php");