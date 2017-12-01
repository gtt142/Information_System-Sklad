<!DOCTYPE html>
<html>
<head>
	<title>Главное меню</title>
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
</head>
<body >
	<div class="row">
	<h1 class="col-10 title">Главное меню</h1>
	<div class="col-2 username">
	<?php
	echo "<b><u>".$_SESSION['u_name']."</u> ";
	echo "<a href='/?exit'>Выйти</a>";
	?>
	</div>
	</div>
	<div class="menuList">
	<?php
		if($role == 'sklad_manager' || $role == 'sklad_shop_assistant'){
			echo "<h2><a href='./resupdate'><u>Обновить резерв</u></a></h2>";
		}
		if($role == 'sklad_shop_assistant'){
			echo "<h2><a href='./invcreate'><u>Создать накладную</u></a></h2>";
		}
		if($role == 'sklad_manager' || $role == 'sklad_director'){
			echo "<h2><a href='./reports'><u>Отчеты</u></a></h2>";
		}
		if($role == 'sklad_manager'){
			echo "<h2><a href='./queries'><u>Запросы</u></a></h2>";
		}
		if($role == 'sklad_manager'){
			echo "<h2><a href='./editgoods'><u>Редактировать список товаров</u></a></h2>";
		}
		if($role == 'sklad_manager' || $role == 'sklad_shop_assistant'){
			echo "<h2><a href='./editclient'><u>Редактировать список клиентов</u></a></h2>";
		}
		if($role == 'sklad_manager'){
			echo "<h2><a href='./editproviders'><u>Редактировать список поставщиков</u></a></h2>";
		}
	?>
	</div>
</body>
</html>