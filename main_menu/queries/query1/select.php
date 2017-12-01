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

       $sql="SELECT name, pr_name, cost, inv_line.count
        FROM invoice
        JOIN inv_line USING(inv_id)
        JOIN reserve USING(res_id)
        JOIN product USING(p_id)
        JOIN client USING(cl_id)
        WHERE YEAR(inv_date) = :year AND MONTH(inv_date) = :month";
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