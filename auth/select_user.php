<?php
		$result=$pdo->prepare("SELECT * FROM `ALL_USER`
									WHERE login = :login"); 

		$result->BindValue(":login", $login);
		$result->execute(); 
?>