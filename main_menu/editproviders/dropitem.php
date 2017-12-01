<?php
		$result=$pdo->prepare("UPDATE `provider` SET `is_active` = '0' WHERE `provider`.`id_prov` = :id");
		$result->BindValue(":id",$_POST['prov_id']);
		$result->execute(); 
?>