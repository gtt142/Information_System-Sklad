<?php
		$result=$pdo->prepare("SELECT * FROM `client` WHERE is_active = 1");
		$result->execute(); 
?>