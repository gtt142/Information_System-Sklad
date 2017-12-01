<?php
	session_start();
	if (isset($_REQUEST['exit'])) {
		include './bye.html';	
		session_unset();
		exit();
	}
	if (!isset($_SESSION['role'])) {
		header("Location: ./auth/");
		exit();
	}
	
	header("Location: ./main_menu/");
?>