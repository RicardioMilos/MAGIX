<?php
    require_once("action/DAO/Connection.php");

    class AnswerDAO {

        public static function getAnswers() {
            $connection = Connection::getConnection();

            $statement = $connection->prepare("SELECT * FROM posts");
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $statement->execute();

            return $statement->fetchAll();
        }

        public static function addAnswers($author, $answer, $visibility) {
            $connection = Connection::getConnection();

            $statement = $connection->prepare("insert into posts(author, answer, visibility) values  (?, ?, ?)");
            $statement->bindParam(1, $author);
            $statement->bindParam(2, $answer);
            $statement->bindParam(3, $visibility);
            $statement->execute();
        }

        public static function updateDiscussion($user) {
            $connection = Connection::getConnection();
        }

        public static function console_log($output, $with_script_tags = true) {
			$js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
		');';
			if ($with_script_tags) {
				$js_code = '<script>' . $js_code . '</script>';
			}
			echo $js_code;
		}
    }