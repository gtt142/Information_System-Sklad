<!DOCTYPE html>
<html>
<head>
	<title>Запрос 4</title>
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body bgcolor="fff099">
	<div class="row">
	<div class="col-1 back_but"><a href='../'>Назад</a></div>
	<h1 class="col-9 title">Запрос 4</h1>
	<div class="col-2 username">
	<?php
	echo "<b><u>".$_SESSION['u_name']."</u> ";
	echo "<a href='/?exit'>Выйти</a>";
	?>
	</div>
	</div>
	<div>Показать товар, который не покупался в каком-либо месяце.</div>
	<table>
	<form action='./' method='POST'>
		<tr>
			<td><label for='Month'>Месяц</label>
				<select name="month" id="Month">
					<?php
						for($i=1; $i<=12; $i++){
							echo "<option value='".$i."'>".$i."</option>";
						}
					?>
				</select>
			<td><label for='Year'>Год</label>
				<select name="year" id="Year">
					<?php
						$thisYear = (int)date('Y');
						for($i=$thisYear; $i>=2000; $i--){
							echo "<option value='".$i."'>".$i."</option>";
						}
					?>
				</select>
		</tr>
		<tr>
			<td><input type='submit' value='Отправить'></td>
			<input type='hidden' name='query'>
		</tr>
	</form>
	</table>
</body>
</html>