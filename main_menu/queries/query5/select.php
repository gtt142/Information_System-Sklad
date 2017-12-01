<?php
       $sql="SELECT *
             FROM client
             WHERE contract_date=(SELECT MAX(contract_date)
                                  FROM client WHERE is_active=1)";
        $result=$pdo->prepare($sql);

        try {
          $result->execute();
        }
        catch(PDOException $e) {
          $output = "Ошибка извлечения данных ". $e->getMessage();
          include '../../../output.php';
          exit();
        }
?>