<!DOCTYPE html>
<html>
<head>
	<title>Накладная</title>
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body>
	<div class="row">
	<div class="col-1 back_but"></div>
	<div class="col-9"></div>
	<div class="col-2 username">
	<?php
	echo "<b><u>".$_SESSION['u_name']."</u> ";
	echo "<a href='/?exit'>Выйти</a>";
	?>
	</div>
	</div>
	<h1 align=center>Накладная №<?php echo $_GET['checkid']; ?> успешно создана</h1>
	<?php
	$row = $result->fetch(); 
	if(!$row)
		echo "Нет данных"; 
	if($row){
		$sum = 0;
		echo "<div class='row tab_header'>";
		echo "<div class='col-2'>Товар</div> <div class='col-1'>цена</div> <div class='col-1'>кол-во</div> <div class='col-1'>ед. изм</div> <div class='col-1'>сумма</div>";
		echo "</div>"; 
		do {
			if(is_item_in_cart($row['p_id'])){
				echo "<div class='row res_row'>";
				echo "<div class='col-2'>".$row['pr_name']."</div>";
				echo "<div class='col-1'>".$row['cost']."</div>";
				echo "<div class='col-1'>".$_SESSION['pr_id'][$row['p_id']]."</div>";
				echo "<div class='col-1'>".$row['measure']."</div>";
				echo "<div class='col-1'>".$row['cost']*$_SESSION['pr_id'][$row['p_id']]."&nbsp&#8381;</div>";
				echo "</div>";
				$sum += $row['cost']*$_SESSION['pr_id'][$row['p_id']];
			}
		} while ($row = $result->fetch());
		echo "<h2>Общая сумма:&nbsp&nbsp".$sum."&nbsp&#8381;</h1>";
		echo "<h4><a href='../'>Вернуться в главное меню</a></h4>";
		}
	?>
</body>
</html>