<?php    
	require_once("action/Ajax-StateAction.php");

	$action = new AjaxStateAction();
	$data =$action->execute();
	
	$path = 'images/TCP/portraits/';
	$imgs = array_diff(scandir($path), array('.', '..'));
	array_push($data, $imgs);
	$result = json_encode($data);
	echo $result;