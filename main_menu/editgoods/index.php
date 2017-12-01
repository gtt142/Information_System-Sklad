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
	if($role != 'sklad_manager' && $role != 'sklad_director') {
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
		include './selectgoods.php';
		include 'edititems.php';
		exit();
	}

	if(isset($_POST['edititem'])){
		if(is_numeric($_POST['count']) && is_numeric($_POST['cost'])) {
			include 'updateitem.php';
			header("Location: ./");
		}
		else{
			$output = 'Неверно введены данные. Повторите снова.';
			include '../../output.php';
		}
	}

	if(isset($_POST['additem'])){
		if(isset($_POST['p_name']) && strlen($_POST['p_name'])!=0 && isset($_POST['group']) && isset($_POST['measure']) && isset($_POST['cost']) && strlen($_POST['cost']) != 0 && isset($_POST['count']) && strlen($_POST['count']) != 0){
			include 'add_item.php';
		}
		else {
			$output = 'Неверно заполнены данные';
			include '../../output.php';	
			include './selectgroup.php';
			include 'add_item_form.php';
			exit();
		}

	}

	if(isset($_REQUEST['add'])){
		include './selectgroup.php';
		include 'add_item_form.php';
		exit();
	}

	include './selectgoods.php';
	include './editgoods.php';
	
?>