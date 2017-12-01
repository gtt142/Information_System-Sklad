<!DOCTYPE html>
<html>
<head>
	<title>Редактирование клиентов</title>
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body>
	<div class="row">
	<div class="col-1 back_but"><a href='../'>Назад</a></div>
	<h1 class="col-9 title">Редактирование клиентов</h1>
	<div class="col-2 username">
	<?php
	echo "<b><u>".$_SESSION['u_name']."</u> ";
	echo "<a href='/?exit'>Выйти</a>";
	?>
	</div>
	</div>
	<a href='./?add'>Добавить клиента</a><br><br>
	<?php
	$row=$result->fetch(); 
	if(!$row)
		echo "Нет данных"; 
	if($row){
		echo "<div class='row tab_header'>";
		echo "<div class='col-2'>Имя клиента</div> <div class='col-2'>Город</div> <div class='col-2'>Дата закл. договора</div>";
		echo "</div>"; 
		$column_number = $result->columnCount();
		do {
			echo "<form action=' ' method='POST'>";
			echo "<div class='row res_row item-no-active'>";
			echo "<div class='col-2'>".$row['name']."</div>";
			echo "<div class='col-2'>".$row['city']."</div>";
			echo "<div class='col-2'>".$row['contract_date']."</div>";
			echo "<div class='col-1'><input type='submit' name='edit' value='Изменить'></div>";
			echo "<div class='col-1 delete'><input type='submit' name='delete' value='Удалить'></div>";
			echo "<div class='col-0'><input type='hidden' name='cl_id' value='".$row['cl_id']."''></div>";
			echo "</div>";
			echo "</form>";	
		} while ($row = $result->fetch());
	}
	?>
</body>
</html>