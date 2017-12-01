<?php
		$today = date('Y-m-d');
		$result=$pdo->prepare("INSERT INTO `client` (`cl_id`, `name`, `city`, `contract_date`, `is_active`) VALUES (NULL, :name, :city, :today, '1')");
		$result->BindValue(":name",$_POST['cl_name']);
		$result->BindValue(":city",$_POST['city']);
		$result->BindValue(":today",$today);
		$result->execute();
?>