<?php
		$reserves=$pdo->prepare("SELECT * FROM `product` LEFT JOIN reserve ON product.p_id=reserve.p_id
								WHERE res_date = (SELECT MAX(res_date) FROM reserve)  AND is_active=1");
		$reserves->execute();
		while ($row = $reserves->fetch()){
			if(in_array($row['p_id'], $error_list))
				$output = $output.$row['pr_name'].", ";
		}
?>