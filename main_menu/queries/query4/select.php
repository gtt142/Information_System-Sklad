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

       $sql="SELECT pr_name
             FROM product A LEFT JOIN (SELECT line_id, p_id
                        FROM inv_line JOIN reserve USING(res_id) JOIN invoice USING(inv_id)
                        WHERE YEAR(inv_date) = :year AND MONTH(inv_date) = :month) T1 USING(p_id)
             WHERE line_id IS NULL";
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