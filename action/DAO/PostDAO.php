<?php
    require_once("action/DAO/Connection.php");

    class PostDAO {

        public static function getPosts() {
            $connection = Connection::getConnection();

            $statement = $connection->prepare("SELECT * FROM `posts`");
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function getPost($id) {
            $connection = Connection::getConnection();

            $statement = $connection->prepare("SELECT * FROM `posts` WHERE id = $id");
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function getPostByInfo($author, $title, $text) {
            $connection = Connection::getConnection();

            $statement = $connection->prepare("SELECT * FROM `posts` WHERE postAuthor = '$author' AND postTitle = '$title' AND postText = '$text'");
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function addPost($author, $title, $text) {
            $connection = Connection::getConnection();
            $previousSameComment = PostDAO::getPostByInfo($author, $title, $text);
            if(count($previousSameComment) == 0){
                if(!(ctype_space($title) || $title == "")){
                    if(!(ctype_space($text) || $text == "")){
                        $date = date('Y-m-d H:i:s');
                        $visibility = '0';
                        $statement = $connection->prepare("INSERT into `posts`(postAuthor, postTitle, postText, postDate, visibility) values  (?, ?, ?, ?, ?)");
                        $statement->bindParam(1, $author);
                        $statement->bindParam(2, $title);
                        $statement->bindParam(3, $text);
                        $statement->bindParam(4, $date);
                        $statement->bindParam(5, $visibility);
                        $statement->execute();
                    }
                }
            }
        }

        public static function modifyPost($id, $text) {
            $connection = Connection::getConnection();

            $statement = $connection->prepare("UPDATE `posts` set postText = '$text' WHERE id = $id");
            $statement->bindParam(1, $text);
            $statement->execute();
        }

        public static function deletePost($id) {
            $connection = Connection::getConnection();

            $statement = $connection->prepare("DELETE FROM `posts` WHERE id = $id");
            $statement->execute();
        }

        public static function getComments($id) {
            $connection = Connection::getConnection();

            $statement = $connection->prepare("SELECT * FROM `comments` WHERE postID = $id");
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function getCommentByInfo($id, $author, $comment) {
            $connection = Connection::getConnection();

            $statement = $connection->prepare("SELECT * FROM `comments` WHERE postID = $id AND commentAuthor = '$author' AND commentText = '$comment'");
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function addComment($id, $author, $comment) {
            $connection = Connection::getConnection();
            $previousSameComment = PostDAO::getCommentByInfo($id, $author, $comment);
            if(count($previousSameComment) == 0){
                if(!(ctype_space($comment) || $comment == "")){
                    $statement = $connection->prepare("INSERT into `comments`(postID, commentAuthor, commentText) values  (?, ?, ?)");
                    $statement->bindParam(1, $id);
                    $statement->bindParam(2, $author);
                    $statement->bindParam(3, $comment);
                    $statement->execute();
                }
            }
        }

        public static function updateDiscussion($user) {
            $connection = Connection::getConnection();
        }
    }