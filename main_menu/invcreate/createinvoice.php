<?php
	$today = date('Y-m-d');
		$reserves=$pdo->prepare("SELECT * FROM `product` LEFT JOIN reserve ON product.p_id=reserve.p_id
								WHERE res_date = (SELECT MAX(res_date) FROM reserve)  AND is_active=1");
		$reserves->execute();
		$pr_to_res = array();
		while ($row = $reserves->fetch()) {
			$pr_to_res[$row['p_id']] = $row['res_id'];
			$pr_to_count[$row['p_id']] = $row['count'];
		}

		foreach ($_SESSION['pr_id'] as $pr_id => $count) {
			$res_count = $pr_to_count[$pr_id];
			if($count > $res_count){
				$error_list[] = $pr_id;
			}
		}
		if(count($error_list) > 0){
			$errorFl = 1;
			goto end;
		}

			$result=$pdo->prepare("INSERT INTO `invoice` (`inv_id`, `cl_id`, `inv_date`) VALUES (NULL, :cl_id, :today)");
			$result->BindValue(":today",$today);
			$result->BindValue(":cl_id",$_SESSION['cl_id']);
			$result->execute(); 
			$inv_ID = $pdo->lastInsertId();


			foreach ($_SESSION['pr_id'] as $pr_id => $count) {
				$result=$pdo->prepare("UPDATE `reserve` SET `count` = :new_count WHERE `reserve`.`res_id` = :res_id");
				$result->BindValue(":res_id",$pr_to_res[$pr_id]);
				$result->BindValue(":new_count",$pr_to_count[$pr_id] - $count);
				$result->execute(); 

				$result=$pdo->prepare("INSERT INTO `inv_line` (`line_id`, `inv_id`, `res_id`, `count`) VALUES (NULL, :inv_id, :res_id, :count)");
				$result->BindValue(":inv_id",$inv_ID);
				$result->BindValue(":res_id",$pr_to_res[$pr_id]);
				$result->BindValue(":count",$count);
				$result->execute(); 
			}
		end:
?>
