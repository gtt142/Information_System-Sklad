<?php
		$result=$pdo->prepare("UPDATE `client` SET `is_active` = '0' WHERE `client`.`cl_id` = :id;");
		$result->BindValue(":id",$_POST['cl_id']);
		$result->execute(); 
?>