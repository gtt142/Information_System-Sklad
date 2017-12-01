<?php try {
   $pdo=new PDO("mysql:host=localhost;dbname=$db", $login, $password);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $pdo->query("SET NAMES utf8");
   }
catch (PDOExeption $e) {
   echo "Ошибка подключения к БД". $e->getMessage();
   exit(); }

?>
