<?php
	require_once("action/CommonAction.php");

	class BattleAction extends CommonAction {
		// phpc / phpx

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
            $hasConnectionError = false;
            $result = null;
            $_SESSION["isInPost"] = false;
			$data = [];

            if(!isset($_SESSION["isConnected"]) || !$_SESSION["isConnected"]){
                header("location:index.php");
                exit;
            }
            else if(isset($_SESSION["isInGame"])){
                if(!$_SESSION["isInGame"]){
                    header("location:lobby.php");
                    exit;
                }
            }

            if(isset($_SESSION["key"])){
                $data["key"] = $_SESSION["key"];
            }
            
            if(isset($_POST["END_OF_GAME_RESULT"])){
                header("location:lobby.php");
                exit;
			}

            if(isset($_POST["PLAYED"])){
                $data["type"] = "PLAY";
                $data["uid"] = $_POST["PLAYED"];
				$result = parent::callAPI("games/action", $data);
			}

			if(isset($_POST["ATTACKING"])){
                $data["type"] = "ATTACK";
                $data["uid"] = $_POST["ATTACKING"];
                $data["targetuid"] = $_POST["ATTACKED"];
				$result = parent::callAPI("games/action", $data);
			}

            if (isset($_POST["POWER"])) {
                $data["type"] = "HERO_POWER";
                $result = parent::callAPI("games/action", $data);
            }  
            
            if (isset($_POST["SKIP"])) {
                $data["type"] = "END_TURN";
                $result = parent::callAPI("games/action", $data);
            }  

            if (isset($_POST["QUIT"])) {
                header("location:lobby.php");
                exit;
            }  
            return compact("result");
		}
	}
