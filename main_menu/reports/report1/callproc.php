<?php
      if (empty($_POST['month'])){
         $output = "Неверно введены данные";
         include '../../../output.php';
         exit;
      }
      $month=$_POST['month'];
      if (empty($_POST['year'])){
         $output = "Неверно введены данные";
         include '../../../output.php';
         exit;
      }
      $year=$_POST['year'];

      $sql="CALL REPORT(:year, :month)";
        $result=$pdo->prepare($sql);
        $result->bindValue(':year', $year);
        $result->bindValue(':month', $month);
        $result->execute();
?>
