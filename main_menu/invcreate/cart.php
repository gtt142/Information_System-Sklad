<!DOCTYPE html>
<html>
<head>
	<title>Корзина</title>
	<link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/style.css" rel="stylesheet">
	<script src='/static/event.js'></script>
	<script src='/static/delete.js'></script>
</head>
<body bgcolor="fff099">
	<div class="row">
	<div class="col-1 back_but"><a href='../'>Назад</a></div>
	<h1 class="col-9 title">Корзина</h1>
	<div class="col-2 username">
	<?php
	echo "<b><u>".$_SESSION['u_name']."</u> ";
	echo "<a href='/?exit'>Выйти</a>";
	?>
	</div>
	</div>
	<a href='./'><h3>Продолжить покупку</h3></a><br><br>
	<br>
	<?php
	if($_SESSION['kol'] <= 0){
		echo "<h1 align='center'>Корзина пуста</h1>";
	}
	else{
		$row = $result->fetch(); 
		if(!$row)
			echo "Нет данных"; 
		if($row){
			$sum = 0;
			echo "<div class='row tab_header'>";
			echo "<div class='col-2'>Товар</div> <div class='col-1'>цена</div> <div class='col-1'>кол-во</div> <div class='col-1'>ед. изм</div>";
			echo "</div>"; 
			do {
				if(is_item_in_cart($row['p_id'])){
					echo "<form action=' ' method='POST'>";
					echo "<div class='row res_row item-no-active'>";
					echo "<div class='col-2'>".$row['pr_name']."</div>";
					echo "<div class='col-1'>".$row['cost']."</div>";
					echo "<div class='col-1'>".$_SESSION['pr_id'][$row['p_id']]."</div>";
					echo "<div class='col-1'>".$row['measure']."</div>";
					echo "<div class='col-1 delete'><input type='submit' value='Удалить из корзины'></div>";
					echo "<div class='col-0'><input type='hidden' name='delfromcart' value='".$row['p_id']."''></div>";
					echo "</div>";
					echo "</form>";
					$sum += $row['cost']*$_SESSION['pr_id'][$row['p_id']];
				}
			} while ($row = $result->fetch());
			echo "</table>"; 
			echo "<h2>Общая сумма:&nbsp&nbsp".$sum."&nbsp&#8381;</h2>";
			echo "<div class='buy_but'><a href='./?buy'>Купить</a></div>";
			echo "<p><a href='./?canclebuy'>Отменить покупку полностью</a></p>";
			}
		}
	?>
</body>
</html>