<!DOCTYPE html>
<html>
<head>
	<title>Запрос 6</title>
    <link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/style.css" rel="stylesheet">
    <script src='/static/event.js'></script>
    <script src='/static/delete.js'></script>
</head>
<body bgcolor='#d4d4d4'>    
    <div class="row">
    <div class="col-1 back_but"><a href='./'>Назад</a></div>
    <h1 class="col-9 title">Запрос 6</h1>
    <div class="col-2 username">
    <?php
    echo "<b><u>".$_SESSION['u_name']."</u> ";
    echo "<a href='/?exit'>Выйти</a>";
    ?>
    </div>
    </div>
	<?php
	echo "Список товаров, которых не было на складе <b>". $sdate. "</b>.<br>";
	?>
    <?php
            $column_number=$result->columnCount();
            $row = $result->fetch();
            if($row == FALSE) {
                echo "<b>Таких нет</b><br>";
                goto end;
            }
    ?>
	<table border="1">
		<tr>
            <th>id</th>
            <th>Название</th>
        </tr>
        <?php
        	do {
				echo "<tr>";
				for ($i = 0; $i < $column_number; $i++) 
					echo "<td align=center>".$row[$i]."</td>";
				echo "</tr>";	
			}	while ($row = $result->fetch());
        ?>
	</table>
    <?php end: ?>
</body>
</html>