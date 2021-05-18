<?php
	require_once("action/CommonAction.php");

	class LobbyAction extends CommonAction {
		// phpc / phpx

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
            $hasConnectionError = false;
            $_SESSION["isInGame"] = false;
            $_SESSION["isWatchingGame"] = false;
            $_SESSION["isInPost"] = false;
			$data = [];

            if(!isset($_SESSION["isConnected"]) || !$_SESSION["isConnected"]){
                header("location:index.php");
                exit;
            }

            if(isset($_SESSION["key"])){
                $data["key"] = $_SESSION["key"];
            }

            if (isset($_POST["quitBtn"])) {
                $result = parent::callAPI("signout", $data);

                if ($result == "SIGNED_OUT") {
                    session_unset();
                    session_destroy();
                    session_start();
                    header("location:index.php");
                    exit;
                }
                else {
                    $hasConnectionError = true;
                }
                return compact("hasConnectionError");
            }  
            elseif(isset($_POST["trainBtn"])){
                $data["type"] = "TRAINING";
                $result = parent::callAPI("games/auto-match", $data);

                if($result == "JOINED_TRAINING"){
                    $_SESSION["isInGame"] = true;
                    header("location:battle.php");
                    exit;
                } 
                else {
                    $hasConnectionError = true;
                }
            }
            elseif(isset($_POST["playBtn"])){
                $data["type"] = "PVP";
                $result = parent::callAPI("games/auto-match", $data);

                if($result == "JOINED_PVP" || $result == "CREATED_PVP"){
                    $_SESSION["isInGame"] = true;
                    header("location:battle.php");
                    exit;
                } 
                else {
                    $hasConnectionError = true;
                }
            }
            elseif(isset($_POST["searchBtn"])){
                $data["username"] = $_POST["observeInput"];
                $result = parent::callAPI("games/observe", $data);

                if(is_object($result) || CommonAction::isJson($result)){
                    $_SESSION["isWatchingGame"] = true;
                    $_SESSION["userWatched"] = $_POST["observeInput"];
                    header("location:battle.php");
                    exit;
                } 
                else {
                    $hasConnectionError = true;
                }
            }
            elseif(isset($_POST["guideBtn"])){
                header("location:guide.php");
                exit;
            }
            return compact("hasConnectionError");
		}
	}
