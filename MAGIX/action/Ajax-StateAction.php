<?php
	require_once("action/CommonAction.php");

	class AjaxStateAction extends CommonAction {

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
            $hasConnectionError = false;

            $data = [];

            if(isset($_SESSION["key"])){
                $data["key"] = $_SESSION["key"];
            }

			$result = parent::callAPI("games/state", $data);

			return compact("result");
		}
	}
