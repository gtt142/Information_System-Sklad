<!DOCTYPE html>
<html>
<head>
	<title>Форма добавления</title>
	<meta http-equiv="Content-Type" Content="text/html; Charset=UTF-8">
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body>
	<div class="row">
	<div class="col-1 back_but"><a href='./'>Назад</a></div>
	<h1 class="col-9 title">Редактирование товаров</h1>
	<div class="col-2 username">
	<?php
	echo "<b><u>".$_SESSION['u_name']."</u> ";
	echo "<a href='/?exit'>Выйти</a>";
	?>
	</div>
	</div>
	<table>
	<form action='./' method='POST'>
		<tr>
			<td><label for='name'>Название</label>
			<input type='text' name='p_name' required id='name'></td>
		</tr>
		<tr>
			<td><label for='Group'>Группа</label>
			<select name="group" required id='Group'> 
				<?php
					$row=$result->fetch(); 
					if(!$row)
						echo "Нет данных"; 
					if($row){
						do {
							echo "<option value=".$row['gr_id'].">".$row['gr_name']."</option>";	
						} while ($row = $result->fetch());
					}
					?>
			</select></td>
		</tr>
		<tr>
			<td><label for='Measure'>Единица измерения</label>
				<select name="measure" id="Measure"> 
					<option value="шт">шт</option> 
					<option value="кг">кг</option> 
					<option value="м">м</option> 
				</select>
		</tr>
		<tr>
			<td><label for='Cost'>Цена</label>
			<input type='text' name='cost' required id='Cost'></td>
		</tr>
		<tr>
			<td><label for='Count'>Количество</label>
			<input type='text' name='count' required id='Count'></td>
		</tr>
		<tr>
			<td><input type='reset' value='Очистить'></td>
			<td><input type='submit' value='Отправить'></td>
			<input type='hidden' name='additem'>
		</tr>
	</form>
	</table>
</body>
</html>