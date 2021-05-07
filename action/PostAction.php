<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/PostDAO.php");

	class PostAction extends CommonAction {
		// phpc / phpx

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$data = [];
			$_SESSION["isInGame"] = false;
			
            if(!isset($_SESSION["isConnected"]) || !$_SESSION["isConnected"]){
                    header("location:index.php");
                    exit;
            }
			else if(isset($_SESSION["isInPost"])){
                if(!$_SESSION["isInPost"]){
                    header("location:guide.php");
                    exit;
                }
            }

            if(isset($_SESSION["key"])){
                $data["key"] = $_SESSION["key"];
            }

			if(isset($_POST["modifyBtn"])){
				PostDAO::modifyPost($_SESSION["post-id"], $_POST["currentPost-text"]);
            }

			if(isset($_POST["deleteBtn"])){
				PostDAO::deletePost($_SESSION["post-id"]);
                header("location:guide.php");
                exit;
            }

			if(isset($_POST["commentBtn"])){
				PostDAO::addComment($_SESSION["post-id"], $_SESSION["username"], $_POST["newComment-text"]);
            }

			if(isset($_SESSION["post-id"])){
				PostDAO::console_log($_SESSION["post-id"]);
				$data["post"] = PostDAO::getPost($_SESSION["post-id"])[0];
				$data["comments"] = PostDAO::getComments($_SESSION["post-id"]);	
            }

			PostDAO::console_log($data);
			return $data;
		}
	}
