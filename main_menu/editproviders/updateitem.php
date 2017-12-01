<?php
		$result=$pdo->prepare("UPDATE `provider` SET `city` = :city, `name` = :name, `bank_name` = :bank_name, `bank_account` = :bank_account WHERE `provider`.`id_prov` = :id");
		$result->BindValue(":city", $_POST['city']);
		$result->BindValue(":name", $_POST['com_name']);
		$result->BindValue(":bank_name", $_POST['bank_name']);
		$result->BindValue(":bank_account", $_POST['bank_acc']);
		$result->BindValue(":id",$_POST['prov_id']);
		$result->execute(); 
?>