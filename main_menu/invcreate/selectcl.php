<?php
		$result=$pdo->prepare("SELECT cl_id, name, city FROM `client` WHERE is_active=1");
		$result->execute(); 
?>