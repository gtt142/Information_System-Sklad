<?php
	session_start();
	if (!isset($_SESSION['role']))
		header("Location: ../");
	
	if(isset($_GET['upd'])){
		$output = 'Обновление резерва прошло успешно';
		include '../output.php';	
	}

	if(isset($_GET['noupd'])){
		$output = 'Резерв уже был обновлен';
		include '../output.php';	
	}
	
	$role = $_SESSION['role'];
	include './menu.php';

	
?>