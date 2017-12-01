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
	if($role != 'sklad_manager' && $role != 'sklad_director') {
		$output = 'У вас нет прав для просмотра этого раздела.';
		include '../../../output.php';
		exit();
	}

	$login=$_SESSION['role'];
	$password=$_SESSION['db_pswd'];
	$db='Sklad';
	include '../../../dbconn/dbconnect.php';

	if(isset($_POST['create'])){
		if($_POST['year'] <= date('Y') && $_POST['month'] < date('m')){
			include 'select.php';
			$row_numb=$result->rowcount();
	      	if($row_numb>0) {
	      		$output = "Такой отчет уже есть. Вот он:<br>";
	      		include '../../../output.php';
	      		include './print.php';
	      		exit();
	      	}
	      	else{
	      		include './callproc.php';
	      		include 'select.php';
				$row_numb=$result->rowcount();
				if($row_numb>0) {
					$output = "Отчет создан.<br>";
	      			include '../../../output.php';
	      			include './print.php';
	      			exit();
				}
				else
					$output = "Нет данных для отчета за данный период.<br>";
	      			include '../../../output.php';

	      	}
	    }
	    else
			$output = 'Выберите предыдущий месяц или более ранний период';
			include '../../../output.php';	

	}

	include "./report1.php"


?>