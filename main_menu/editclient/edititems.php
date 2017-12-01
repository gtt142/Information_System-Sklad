<!DOCTYPE html>
<html>
<head>
	<title>Изменение данных клиента</title>
	<meta http-equiv="Content-Type" Content="text/html; Charset=UTF-8">
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
</head>
<body bgcolor='#d4d4d4'>
	<div class="row">
	<div class="col-1 back_but"><a href='./'>Назад</a></div>
	<h1 class="col-9 title">Изменение данных о клиенте</h1>
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
		while ($row['cl_id'] != $_POST['cl_id']) {
		 	$row=$result->fetch();
		 } 
	?>
	<form action='./' method='POST'>
		<tr>
			<td><label for='name'>Фамилия клиента</label>
			<input type='text' name='cl_name' required id='name' value="<?php echo $row['name'] ?>"></td>
		</tr>
		<tr>
			<td><label for='City'>Город</label>
			<input type='text' name='city' required id='City' value="<?php echo $row['city'] ?>"></td>
		</tr>
		<tr>
			<td><input type='reset' value='Очистить'></td>
			<td><input type='submit' value='Отправить'></td>
			<input type='hidden' name='edititem' value='<?php echo $row['cl_id']; ?>'>
		</tr>
	</form>
	</table>
</body>
</html>