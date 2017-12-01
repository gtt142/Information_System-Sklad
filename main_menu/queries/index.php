<?php
	session_start();
	if (isset($_REQUEST['exit'])) {
		$output = 'До новых встреч';
		include '../../output.php';	
		session_unset();
	}
	
	if (!isset($_SESSION['role']))
		header("Location: ../../");

	$role = $_SESSION['role'];
	if($role != 'sklad_manager') {
		$output = 'У вас нет прав для просмотра этого раздела.';
		include '../../output.php';
		exit();
	}

	include "./queries.php"


?>