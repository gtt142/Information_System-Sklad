<!DOCTYPE html>
<html>
<head>
	<title>Выбор клиента</title>
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body>
	<div class="row">
	<div class="col-1 back_but"><a href='../'>Назад</a></div>
	<h1 class="col-9 title">Выбор клиента</h1>
	<div class="col-2 username">
	<?php
	echo "<b><u>".$_SESSION['u_name']."</u> ";
	echo "<a href='/?exit'>Выйти</a>";
	?>
	</div>
	</div>
	<?php
	$row=$result->fetch(); 
	if(!$row)
		echo "Нет данных"; 
	if($row){
		echo "<div class='row tab_header'>";
		echo "<div class='col-2'>Имя клиента</div> <div class='col-2'>Город</div>";
		echo "</div>"; 
		do {
			echo "<form action=' ' method='GET'>";
			echo "<div class='row res_row item-no-active'>";
			echo "<div class='col-2'>".$row['name']."</div>";
			echo "<div class='col-2'>".$row['city']."</div>";
			echo "<div class='col-1'><input type='submit' value='Выбрать'></div>";
			echo "<div class='col-0'><input type='hidden' name='cl_id' value='".$row['cl_id']."''></div>";
			echo "</div>";
			echo "</form>";	
		} while ($row = $result->fetch());
	}
	?>
</body>
</html>