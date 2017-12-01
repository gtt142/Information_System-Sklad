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

       $sql="SELECT id, name, summa
          FROM max_sum
          WHERE YEAR(days) = :year AND MONTH(days) = :month AND summa=(SELECT MAX(summa)
                         FROM max_sum
                         WHERE YEAR(days) = :year AND MONTH(days) = :month)";
        $result=$pdo->prepare($sql);
        $result->bindValue(':year', $year);
        $result->bindValue(':month', $month);

        try {
          $result->execute();
        }
        catch(PDOException $e) {
          $output = "Ошибка извлечения данных ". $e->getMessage();
          include '../../../output.php';
          exit();
        }
?>