<?php
      if (empty($_POST['year'])){
         $output = "Неверно введены данные";
         include '../../../output.php';
         exit;
      }
      $year=$_POST['year'];

       $sql="SELECT month, AVG(sum1)
             FROM (SELECT month, year, SUM(sum) sum1
                   FROM line_sum
                   GROUP BY inv_id) T1
             WHERE year=:year
             GROUP BY month";
        $result=$pdo->prepare($sql);
        $result->bindValue(':year', $year);

        try {
          $result->execute();
        }
        catch(PDOException $e) {
          $output = "Ошибка извлечения данных ". $e->getMessage();
          include '../../../output.php';
          exit();
        }
?>