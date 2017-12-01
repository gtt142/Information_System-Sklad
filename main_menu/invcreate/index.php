<?php

	function is_item_in_cart($id) {
		foreach ($_SESSION['pr_id'] as $key => $value) {
			if($key == $id)
				return 1;
		}
		return 0;
	}



	session_start();
	if (isset($_REQUEST['exit'])) {
		$output = 'До новых встреч';
		include '../../output.php';	
		session_unset();
	}

	if (!isset($_SESSION['role']))
		header("Location: ../../");
	
	$role = $_SESSION['role'];
	if($role != 'sklad_shop_assistant') {
		$output = 'У вас нет прав для просмотра этого раздела.';
		include '../../output.php';
		exit();
	}

	$login=$_SESSION['role'];
	$password=$_SESSION['db_pswd'];
	$db='Sklad';
	include '../../dbconn/dbconnect.php';


	if(isset($_GET['cl_id'])){
		if(is_numeric($_GET['cl_id']))
			$_SESSION['cl_id'] = $_GET['cl_id'];
			$_SESSION['pr_id'] = array();
			$_SESSION['kol'] = 0;
		header("Location: ./");
	}

	if(!isset($_SESSION['cl_id'])){
		include 'selectcl.php';
		include 'client.php';
		exit();
	}

	//  запрос на добавление товара в корзину
	if(isset($_POST['additem'])){
		// проверяем количество добавляемого товара на min и max [1; 100]
		if(is_numeric($_POST['count']) && $_POST['count'] < 101 && $_POST['count'] > 0) 
		{
			$_SESSION['kol'] += $_POST['count']; // увеличиваем счетчик корзины
			$item_exist = 0; // создаем ключ для проверки наличия товара в корзине
			foreach ($_SESSION['pr_id'] as $key => $value) //  берем из параметров сессии ранее добавленные товары
														   //  key - id товара, value - количество товара в корзине
			{
				if($key == $_POST['additem'])
				{ // если добавляемый товар лежит в корзине
					$_SESSION['pr_id'][$key] += $_POST['count']; //  увеличиваем счетчик товара лежащего в корзине
					$item_exist = 1; //  активируем ключ наличия товара в корзине
				}
			}
			if(!$item_exist) //  если товара не было в корзине ранее
			{
				$_SESSION['pr_id'][$_POST['additem']] = $_POST['count'];  // добавляем в корзину и инициализируем значение массива количеством добавляемого товара
			}

		}
		header("Location: ./"); //  перенапрвляем к контроллеру для очистки POST параметров
	}

	if(isset($_POST['delfromcart'])){
		foreach ($_SESSION['pr_id'] as $key => $value) {
			if($key == $_POST['delfromcart']){
				$_SESSION['kol'] -= $_SESSION['pr_id'][$key];
				unset($_SESSION['pr_id'][$key]);
				$item_exist = 1;
			}
		}
		header("Location: ./?cart");
	}

	if(isset($_GET['canclebuy'])){
		unset($_SESSION['pr_id']);
		unset($_SESSION['kol']);
		unset($_SESSION['cl_id']);
		header("Location: ../");
	}

	if(isset($_GET['buy'])){
		if($_SESSION['kol'] > 0){
			$errorFl = 0;
			$error_list = array();
			include "./createinvoice.php";
			if($errorFl == 0){
				header("Location: ./?checkid=$inv_ID");
			}
			else
				$output = 'На складе недостаточно товара ';
				include './errorlist.php';
				include '../../output.php';
		}
	}

	if(isset($_GET['checkid'])){
		include './selectgoods.php';
		include "./showcheck.php";
		unset($_SESSION['pr_id']);
		unset($_SESSION['kol']);
		unset($_SESSION['cl_id']);
		exit();
	}

	if(isset($_GET['cart'])){
		include './selectgoods.php';
		include "./cart.php";
		exit();
	}

	include './selectgoods.php';
	include './editgoods.php';
	
?>