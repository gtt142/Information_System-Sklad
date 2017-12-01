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
	if($role != 'sklad_manager' && $role != 'sklad_shop_assistant') {
		$output = 'У вас нет прав для просмотра этого раздела.';
		include '../../output.php';
		exit();
	}

	$login=$_SESSION['role'];
	$password=$_SESSION['db_pswd'];
	$db='Sklad';
	include '../../dbconn/dbconnect.php';

	
	include "selectdate.php";
	$row = $result->fetch();
	$last_res_date = $row['m_date'];
	$today = date('Y-m-d');
	if($last_res_date < $today){
		include "callproc.php";
		header("Location: ../?upd");
	}
	else
		header("Location: ../?noupd");
	
?>