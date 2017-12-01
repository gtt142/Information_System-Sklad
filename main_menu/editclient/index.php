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

	
	if(isset($_POST['delete'])){
		include 'dropitem.php';
		header("Location: ./");
	}

	if(isset($_POST['edit'])){
		include './selectclients.php';
		include 'edititems.php';
		exit();
	}

	if(isset($_POST['edititem'])){
		include 'updateitem.php';
		header("Location: ./");
	}

	if(isset($_POST['additem'])){
		if(isset($_POST['cl_name']) && strlen($_POST['cl_name'])!=0 && isset($_POST['city']) && isset($_POST['city'])){
			include 'add_client.php';
			header("Location: ./");
		}
		else {
			$output = 'Неверно заполнены данные';
			include '../../output.php';
			include 'add_client_form.php';
			exit();
		}

	}

	if(isset($_REQUEST['add'])){
		include 'add_client_form.php';
		exit();
	}

	include './selectclients.php';
	include './editclients.php';
	
?>