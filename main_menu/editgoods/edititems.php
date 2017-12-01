<!DOCTYPE html>
<html>
<head>
	<title>Изменение данных о товаре</title>
	<meta http-equiv="Content-Type" Content="text/html; Charset=UTF-8">
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body bgcolor='#d4d4d4'>
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
	<?php
		$row=$result->fetch();
		while ($row['p_id'] != $_POST['pr_id']) {
		 	$row=$result->fetch();
		 } 
	?>
	<form action='./' method='POST'>
		<tr>
			<td><label for='name'>Название</label>
			<input type='text' name='pr_name' required id='name' value="<?php echo $row['pr_name'] ?>"></td>
		</tr>
		<tr>
			<td><label for='Measure'>Единица измерения</label>
				<select name="measure" id="Measure""> 
					<option value="шт" <?php if($row['measure'] == 'шт') {echo "selected";} ?> >шт</option> 
					<option value="кг" <?php if($row['measure'] == 'кг') {echo "selected";} ?> >кг</option> 
					<option value="м" <?php if($row['measure'] == 'м') {echo "selected";} ?> >м</option> 
				</select>
		</tr>
		<tr>
			<td><label for='Cost'>Цена</label>
			<input type='text' name='cost' required id='Cost' value="<?php echo $row['cost'] ?>"></td>
		</tr>
		<tr>
			<td><label for='Count'>Количество</label>
			<input type='number' min="0" name='count' required id='Count' value="<?php echo $row['count'] ?>"></td>
		</tr>
		<tr>
			<td><input type='reset' value='Очистить'></td>
			<td><input type='submit' value='Отправить'></td>
			<input type='hidden' name='edititem' value='<?php echo $row['p_id']; ?>'>
			<input type='hidden' name='res_id' value='<?php echo $row['res_id']; ?>'>
		</tr>
	</form>
	</table>
</body>
</html>