<!DOCTYPE html>
<html>
<head>
	<title>Редактирование товаров</title>
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body>
	<div class="row">
	<div class="col-1 back_but"><a href='../'>Назад</a></div>
	<h1 class="col-9 title">Редактирование товаров</h1>
	<div class="col-2 username">
	<?php
	echo "<b><u>".$_SESSION['u_name']."</u> ";
	echo "<a href='/?exit'>Выйти</a>";
	?>
	</div>
	</div>
	<a href='./?add'>Добавить товар</a><br><br>
	<?php
	$row=$result->fetch(); 
	if(!$row)
		echo "Нет данных"; 
	if($row){
		echo "<div class='row tab_header'>";
		echo "<div class='col-2'>Товар</div> <div class='col-1'>кол-во</div> <div class='col-1'>ед. изм</div> <div class='col-1'>цена</div> <div class='col-2'>Дата обновления резерва</div>";
		echo "</div>";
		$column_number = $result->columnCount();
		do {
			echo "<form action=' ' method='POST'>";
			echo "<div class='row res_row item-no-active'>";
			echo "<div class='col-2'>".$row['pr_name']."</div>";
			echo "<div class='col-1'>".$row['count']."</div>";
			echo "<div class='col-1'>".$row['measure']."</div>";
			echo "<div class='col-1'>".$row['cost']."</div>";
			echo "<div class='col-2'>".$row['res_date']."</div>";
			echo "<div class='col-1'><input type='submit' name='edit' value='Изменить'></div>";
			echo "<div class='col-1 delete'><input type='submit' name='delete' value='Удалить'></div>";
			echo "<div class='col-0'><input type='hidden' name='pr_id' value='".$row['p_id']."''></div>";
			echo "</div>";
			echo "</form>";
		} while ($row = $result->fetch());
		echo "</table>"; 
	}
	?>
</body>
</html>