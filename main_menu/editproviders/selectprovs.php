<?php
		$result=$pdo->prepare("SELECT * FROM `provider` WHERE is_active = 1");
		$result->execute(); 
?>