<?php
		$result=$pdo->prepare("UPDATE `client` SET `name` = :name, `city` = :city WHERE `client`.`cl_id` = :id");
		$result->BindValue(":city", $_POST['city']);
		$result->BindValue(":name", $_POST['cl_name']);
		$result->BindValue(":id",$_POST['edititem']);
		$result->execute(); 
?>