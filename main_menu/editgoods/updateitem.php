<?php
		$result=$pdo->prepare("UPDATE `product` SET `pr_name` = :pr_name, `measure` = :measure WHERE `product`.`p_id` = :id");
		$result->BindValue(":pr_name", $_POST['pr_name']);
		$result->BindValue(":measure", $_POST['measure']);
		$result->BindValue(":id",$_POST['edititem']);
		$result->execute(); 


		$result=$pdo->prepare("UPDATE `reserve` SET `cost` = :cost, `count` = :count WHERE `reserve`.`res_id` = :id");
		$result->BindValue(":cost", $_POST['cost']);
		$result->BindValue(":count", $_POST['count']);
		$result->BindValue(":id",$_POST['res_id']);
		$result->execute(); 
?>