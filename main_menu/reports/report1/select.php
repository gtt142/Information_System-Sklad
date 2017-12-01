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
      
       $sql="SELECT r_year, r_month, p_id, pr_name, invoice_sum
             FROM report
             WHERE r_year = :year AND r_month = :month";
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