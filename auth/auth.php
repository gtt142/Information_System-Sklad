<?php
        $login='sklad_auth';
        $password='authpswd';
        $db='Sklad';
        include '../dbconn/dbconnect.php';
        $login = $_POST['login'];
        $password = $_POST['pswd'];
        include './select_user.php';
        $row=$result->fetch();
        if(!$row) {
            $err = 1;
            $output='Неверный логин';
            include "../output.php";
            goto endl;
        }
        $salt = "salt";
        $hash1 = md5($_POST['pswd']);
        $hashpswd = md5($hash1.$salt);
        if($hashpswd != $row['u_pswd']) {
            $err = 1;
            $output='Неверный пароль';
            include "../output.php";
            goto endl;
        }
        $role = $row['u_group'];
        session_start();
        $_SESSION['role'] = $role;
        $_SESSION['u_name'] = $_POST['login'];
        $_SESSION['db_pswd'] = $row['db_pswd'];
        endl:
?>