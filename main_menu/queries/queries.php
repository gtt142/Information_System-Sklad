<!DOCTYPE html>
<html>
<head>
	<title>Меню запросов</title>
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body bgcolor="fff099">
	<div class="row">
	<div class="col-1 back_but"><a href='../'>Назад</a></div>
	<h1 class="col-9 title">Меню запросов</h1>
	<div class="col-2 username">
	<?php
	echo "<b><u>".$_SESSION['u_name']."</u> ";
	echo "<a href='/?exit'>Выйти</a>";
	?>
	</div>
	</div>
	<h2><a href='./query1'><u>Запрос 1</u></a></h2>
	<h2><a href='./query2'><u>Запрос 2</u></a></h2>
	<h2><a href='./query3'><u>Запрос 3</u></a></h2>
	<h2><a href='./query4'><u>Запрос 4</u></a></h2>
	<h2><a href='./query5'><u>Запрос 5</u></a></h2>
	<h2><a href='./query6'><u>Запрос 6</u></a></h2>
</body>
</html>