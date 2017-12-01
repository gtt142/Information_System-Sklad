<!DOCTYPE html>
<html>
<head>
	<title>Каталог товаров</title>
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body bgcolor="fff099">
	<div class="row">
	<div class="col-1 back_but"><a href='../'>Назад</a></div>
	<h1 class="col-7 title">Каталог товаров</h1>
	<div class="col-2">
		<a href="./?cart"><img src='/static/cart.png' width="70" height="70" align="center"><h3>Корзина(<?php echo $_SESSION['kol']; ?>)</h3></a>
	</div>
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
		echo "<div class='col-2'>Товар</div> <div class='col-1'>Цена</div> <div class='col-1'>Кол-во</div> <div class='col-1'>Ед. изм</div> <div class='col-1'>Доступно</div>";
		echo "</div>";
		do {
			echo "<form action=' ' method='POST'>";
			echo "<div class='row res_row item-no-active'>";
			echo "<div class='col-2'>".$row['pr_name']."</div>";
			echo "<div class='col-1'>".$row['cost']."</div>";
			echo "<div class='col-1'><input type='number' size='10' name='count' value='1' max='100' min='1' align='center'></div>";
			echo "<div class='col-1'>".$row['measure']."</div>";
			echo "<div class='col-1'>".$row['count']."</div>";
			echo "<div class='col-1'><input type='submit' value='В корзину'></div>";
			echo "<div class='col-0'><input type='hidden' name='additem' value='".$row['p_id']."''></div>";
			echo "</div>";
			echo "</form>";
		} while ($row = $result->fetch());
	}
	?>
	<br>
	<p><a href='./?canclebuy'>Отменить покупку</a></p>
</body>
</html>