<?php
		$result=$pdo->prepare("SELECT * FROM `product` LEFT JOIN reserve ON product.p_id=reserve.p_id
								WHERE res_date = (SELECT MAX(res_date) FROM reserve)  AND is_active=1");
		$result->execute(); 
?>