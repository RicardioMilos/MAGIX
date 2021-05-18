<?php
	require_once("action/CommonAction.php");
	require_once("action/DAO/UserDAO.php");

	class LoginAction extends CommonAction {
		// phpc / phpx

		public function __construct() {
			parent::__construct(CommonAction::$VISIBILITY_PUBLIC);
		}

		protected function executeAction() {
			$hasConnectionError = false;

			$data["key"] = [];

			if (isset($_POST["username"])) {

				$data["username"] = $_POST["username"];
            	$data["password"] = $_POST["pwd"];

            	$result = parent::callAPI("signin", $data);

				if ($result == "INVALID_USERNAME_PASSWORD") {
					// err
					$hasConnectionError = true;
				}
				else {
					$key = $result->key;
					$_SESSION["key"] = $key;
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["isConnected"] = true;
					$_SESSION["isInGame"] = false;
					$_SESSION["isWatchingGame"] = false;
					$_SESSION["isInPost"] = false;
 
					header("location:lobby.php");
					exit;
				}
			}

			return compact("hasConnectionError");
		}
	}
