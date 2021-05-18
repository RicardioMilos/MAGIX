<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/PostDAO.php");

	class GuideAction extends CommonAction {
		// phpc / phpx

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$data = [];
			$_SESSION["isInGame"] = false;
			$_SESSION["isWatchingGame"] = false;
            $_SESSION["isInPost"] = false;

			if(!isset($_SESSION["isConnected"]) || !$_SESSION["isConnected"]){
				header("location:index.php");
				exit;
			}

			if(isset($_POST["lobbyBtn"])){
                header("location:lobby.php");
                exit;
            }

            if(isset($_SESSION["key"])){
                $data["key"] = $_SESSION["key"];
            }

			if(isset($_POST["postBtn"])){
					PostDAO::addPost($_SESSION["username"], $_POST["newPost-title"], $_POST["newPost-text"]);
            }

			if(isset($_POST["post-id"])){
				$_SESSION["post-id"] = $_POST["post-id"];
				$_SESSION["isInPost"] = true;
                header("location:post.php");
                exit;
            }

            $data = PostDAO::getPosts();
			return $data;
		}
	}
