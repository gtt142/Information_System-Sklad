<?php
		$result=$pdo->prepare("INSERT INTO `product` (`p_id`, `pr_name`, `gr_id`, `measure`, `is_active`) 
								VALUES (NULL, :name, :group_id, :measure, '1')");
		$result->BindValue(":name",$_POST['p_name']);
		$result->BindValue(":group_id",$_POST['group']);
		$result->BindValue(":measure",$_POST['measure']);
		$result->execute();
		$result=$pdo->prepare("SELECT MAX(p_id) max FROM `product`");
		$result->execute();
		$row=$result->fetch();
		if($row) {
			$max = $row['max'];
			$today = date('Y-m-d');
			$result=$pdo->prepare("INSERT INTO `reserve` (`res_id`, `p_id`, `cost`, `count`, `res_date`) VALUES (NULL, :id, :cost, :count, :today)");
			$result->BindValue(":id",$max);
			$result->BindValue(":cost",$_POST['cost']);
			$result->BindValue(":count",$_POST['count']);
			$result->BindValue(":today",$today);
			$result->execute();
		}
?>