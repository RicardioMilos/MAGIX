<?php
    require_once("action/GuideAction.php");

    $action = new GuideAction();
	$posts = $action->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/guide.css">
</head>
<body class="guide-body">
    <div class="guide-title">
        <form class="back-container" action="lobby.php" method="POST">
            <input type="submit" name="lobbyBtn" value="GO BACK!!!">
        </form>
        <div class="title-container">
            GUIDE STRATEGIQUE
        </div>
        <div></div>
    </div>
    <div class="newPost-container">
        <form action="guide.php" class="newPost" method="POST">
            <textarea name="newPost-title" class="newPost-title" cols="30" rows="1" placeholder="Un titre?"></textarea>
            <textarea name="newPost-text" class="newPost-text" cols="30" rows="10" placeholder="Un savoir ancien a transmettre?"></textarea>
            <div class="button-choice">
                <input type="submit" name="postBtn" value="POST">
            </div>
        </form>
    </div>

    <div class="posts-container">
        <?php
            foreach ($posts as $p) {
                if(is_array($p)){
                ?>
                <form action="guide.php" class="posts-form" method="post">
                <div class="single-post">
                    <div class="post-info">
                        <div class="post-title">
                            <?=$p['postTitle']?>
                        </div>
                        <div class="post-author">
                            <?=$p['postAuthor']?>
                        </div>
                        <div class="post-button">
                            <input type="hidden" name="post-id" value="<?=$p['id']?>">
                            <button type="submit">CLICK</button>
                        </div>
                    </div>
                </div>
                </form>
                <?php
                }
            }
        ?>
    </div>
</body>
</html>