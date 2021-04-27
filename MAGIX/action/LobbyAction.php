<?php
	require_once("action/CommonAction.php");

	class LobbyAction extends CommonAction {
		// phpc / phpx

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
            $hasConnectionError = false;

			$data = [];

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
                    header("location:battle.php");
                    exit;
                } 
                else {
                    $hasConnectionError = true;
                }
            }
            return compact("hasConnectionError");
		}
	}
