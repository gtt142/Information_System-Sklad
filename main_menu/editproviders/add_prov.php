<?php
		$result=$pdo->prepare("INSERT INTO `provider` (`id_prov`, `city`, `name`, `bank_name`, `bank_account`, `is_active`) VALUES (NULL, :city, :com_name, :bank_name, :bank_acc, '1')");
		$result->BindValue(":com_name",$_POST['com_name']);
		$result->BindValue(":city",$_POST['city']);
		$result->BindValue(":bank_name",$_POST['bank_name']);
		$result->BindValue(":bank_acc",$_POST['bank_acc']);
		$result->execute();
?>