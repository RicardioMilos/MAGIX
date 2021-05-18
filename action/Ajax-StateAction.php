<?php
	require_once("action/CommonAction.php");

	class AjaxStateAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
            $hasConnectionError = false;

            $data = [];
			$result = null;

            if(isset($_SESSION["key"])){
                $data["key"] = $_SESSION["key"];
            }
			if(isset($_SESSION["isInGame"]) && isset($_SESSION["isWatchingGame"])){
				if ($_SESSION["isWatchingGame"]){
					$data["username"] = $_SESSION["userWatched"];
					$result = parent::callAPI("games/observe", $data);
				} 
				else {
					$result = parent::callAPI("games/state", $data);
				}
			}

			return compact("result");
		}
	}
	