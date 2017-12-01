<?php
		$result=$pdo->prepare("SELECT MAX(res_date) m_date FROM reserve");
		$result->execute(); 
?>