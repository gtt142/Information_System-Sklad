<?php
	$pswd = 'qwerty123';
	$hash1 = md5($pswd);
	$salt = 'salt';
	$hashpswd = md5($hash1.$salt);
	echo $hashpswd;
	echo date('Y-m-d');
?>