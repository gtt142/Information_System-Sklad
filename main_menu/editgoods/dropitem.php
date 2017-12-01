<?php
		$result=$pdo->prepare("UPDATE `product` SET `is_active` = '0' WHERE `product`.`p_id` = :pid;");
		$result->BindValue(":pid",$_POST['pr_id']);
		$result->execute(); 
?>