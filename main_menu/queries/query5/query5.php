<!DOCTYPE html>
<html>
<head>
	<title>Запрос 5</title>
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body bgcolor="fff099">
	<div class="row">
	<div class="col-1 back_but"><a href='../'>Назад</a></div>
	<h1 class="col-9 title">Запрос 5</h1>
	<div class="col-2 username">
	<?php
	echo "<b><u>".$_SESSION['u_name']."</u> ";
	echo "<a href='/?exit'>Выйти</a>";
	?>
	</div>
	</div>
	<div>Показать сведения для самого нового клиента.</div>
	<table>
	<form action='./' method='POST'>
		<tr>
			<td><input type='submit' value='Показать'></td>
			<input type='hidden' name='query'>
		</tr>
	</form>
	</table>
</body>
</html>