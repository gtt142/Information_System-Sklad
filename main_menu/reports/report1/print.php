<!DOCTYPE html>
<html>
<head>
	<title>Отчет 1</title>
    <link href="/static/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/style.css" rel="stylesheet">
    <script src='/static/event.js'></script>
    <script src='/static/delete.js'></script>
</head>
<body>
	<a href='./'>Назад</a><br><br>
	<?php
	echo "<p align='center'>Отчет о прибыли за продажу товаров за <b>". $month. "</b>-й месяц <b>". $year. "</b> года.</p>";
	?>
	<table>
		<tr>
        	<th>год</th>
            <th>месяц</th>
            <th>id товара</th>
            <th>Название товара</th>
            <th>Сумма продаж</th>
        </tr>
        <?php
        	$column_number=$result->columnCount();
        	$row = $result->fetch();
        	if($row == FALSE) {
        		echo "my_error FALSE";
        	}
        	do {
				echo "<tr>";
				for ($i = 0; $i < $column_number; $i++) 
					echo "<td align=center>".$row[$i]."</td>";
				echo "</tr>";	
			}	while ($row = $result->fetch());
        ?>
	</table>
</body>
</html>