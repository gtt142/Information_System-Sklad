<?php
	session_start();
	if (isset($_REQUEST['exit'])) {
		$output = 'До новых встреч';
		include '../../../output.php';	
		session_unset();
	}
	
	if (!isset($_SESSION['role']))
		header("Location: ../../../");

	$role = $_SESSION['role'];
	if($role != 'sklad_manager') {
		$output = 'У вас нет прав для просмотра этого раздела.';
		include '../../../output.php';
		exit();
	}

	$login=$_SESSION['role'];
	$password=$_SESSION['db_pswd'];
	$db='Sklad';
	include '../../../dbconn/dbconnect.php';

	if(isset($_POST['query'])){
		include 'select.php';
		$row_numb=$result->rowcount();
      	include './print.php';
      	exit();
	}

	include "./query5.php"


?>