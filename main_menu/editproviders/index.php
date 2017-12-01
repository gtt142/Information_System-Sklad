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

	$login=$_SESSION['role'];
	$password=$_SESSION['db_pswd'];
	$db='Sklad';
	include '../../dbconn/dbconnect.php';


	if(isset($_POST['delete'])){
		include 'dropitem.php';
		header("Location: ./");
	}

	if(isset($_POST['edit'])){
		include './selectprovs.php';
		include 'edititems.php';
		exit();
	}

	if(isset($_POST['edititem'])){
		include 'updateitem.php';
		header("Location: ./");
	}

	if(isset($_POST['additem'])){
		if(isset($_POST['com_name']) && strlen($_POST['com_name'])!=0 && isset($_POST['city']) && strlen($_POST['city']) !=0 && isset($_POST['bank_name']) && strlen($_POST['bank_name'])!=0 && isset($_POST['bank_acc']) && strlen($_POST['bank_acc'])==20){
			include 'add_prov.php';
			header("Location: ./");
		}
		else {
			$output = 'Неверно заполнены данные';
			include '../../output.php';
			include 'add_prov_form.php';
			exit();
		}

	}

	if(isset($_REQUEST['add'])){
		include 'add_prov_form.php';
		exit();
	}

	include './selectprovs.php';
	include './editprovs.php';
	
?>