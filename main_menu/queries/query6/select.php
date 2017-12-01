<?php
      if (empty($_POST['date'])){
         $output = "Неверно введены данные";
         include '../../../output.php';
         exit;
      }
      $sdate=$_POST['date'];


      $sql="SELECT p_id, pr_name
             FROM product LEFT JOIN (SELECT *
                                    FROM reserve
                                    WHERE res_date=:sdate) T1 USING(p_id)
             WHERE count IS NULL";
        $result=$pdo->prepare($sql);
        $result->bindValue(':sdate', $sdate);

        try {
          $result->execute();
        }
        catch(PDOException $e) {
          $output = "Ошибка извлечения данных ". $e->getMessage();
          include '../../../output.php';
          exit();
        }
?>