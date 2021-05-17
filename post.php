<?php
    require_once("action/PostAction.php");

    $action = new PostAction();
	$post = $action->execute();

    require_once("partials/header.php");
?>

    <title>POST</title>
    <link rel="stylesheet" href="css/post.css">
</head>
<body class="post-body">
    <div class="post-title">
        <form class="back-container" action="post.php" method="POST">
            <input type="submit" name="guideBtn" value="GO BACK!!!">
        </form>
        <div class="title-container">
        <?= $post["post"]["postTitle"] ?>
        </div>
        <div class="save-container">
        </div>
    </div>
    <div class="currentPost">
        <?php
            if($_SESSION["username"] == $post["post"]["postAuthor"]){
        ?>
            <form class="curPost-form" action="post.php" method="POST">
                <textarea name="currentPost-text" class="currentPost-text" cols="30" rows="10"><?= $post["post"]["postText"] ?></textarea>
                <div class="currentPost-footer">
                    <div class="currentPost-Author">
                        <?= $post["post"]["postAuthor"] ?>
                    </div>
                    <div class="edit-choice">
                        <input type="submit" name="modifyBtn" value="Modifier">
                        <input type="submit" name="deleteBtn" value="Supprimer">
                    </div>
                </div>
            </form>
        <?php
            }
            else {
        ?>
                <div class="edit-text">
                    <?= $post["post"]["postText"] ?>
                </div>
                <div class="user-info">
                    <div class="edit-author">
                        <?= $post["post"]["postAuthor"] ?>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
    <div class="comments-container">
        <form class="newComment-form" action="post.php" method="POST">
            <textarea name="newComment-text" class="newComment-text" cols="30" rows="5" placeholder="Quelque chose à ajouter?"></textarea>
            <div class="comment-choice">
                <input type="submit" name="commentBtn" value="Commenter">
            </div>
        </form>
        <div class="other-comments">
        <?php
            foreach ($post["comments"] as $c) {
                if(is_array($c)){
                ?>
                    <div class="single-comment">
                        <div class="comment-text">
                            <?= $c["commentText"] ?>
                        </div>
                        <div class="comment-author">
                            <?= $c["commentAuthor"]?>
                        </div>
                    </div>
            <?php
                }
            }
        ?>
        </div>
    </div>

<?php
    require_once("partials/footer.php");