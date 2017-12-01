<?php
      $sql="CALL RES_UPDATE()";
        $result=$pdo->prepare($sql);
        $result->execute();
?>
