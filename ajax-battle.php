<?php    
	require_once("action/BattleAction.php");

	$action = new BattleAction();
	$data = $action->execute();
	$result = json_encode($data);
	echo $result;