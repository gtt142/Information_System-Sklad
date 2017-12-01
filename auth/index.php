<?php
	if(isset($_POST['login']) and isset($_POST['pswd'])) {
        $err = 0; 
        include "./auth.php";
        if ($err == 1)
            goto end;
        header("Location: ../");
    }
    end:
    include "./auth_form.html";

?>