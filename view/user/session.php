<?php
    require_once("../../controller/homeController.php");

    session_start();

    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    $_SESSION['login_attempts']++;

    $lockout_time = 24 * 60 * 60;

    if ($_SESSION['login_attempts'] >= 5) {
        $_SESSION['lockout_time'] = time() + $lockout_time;
        $_SESSION['login_attempts'] = 0;
    }

    if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) {
        $remaining_time = $_SESSION['lockout_time'] - time();

        $hours = floor($remaining_time / 3600);
        $minutes = floor(($remaining_time % 3600) / 60);

        $error = "<li>La cuenta ha sido bloqueada. Intenta nuevamente después de $hours horas y $minutes minutos.</li>";
        header("Location:login.php?error=".$error);
        exit();
    } 

    $obj = new homeController();
    $email = $obj->limpiarcorreo($_POST["EMAIL"]);
    $contraseña = $obj->limpiarcadena($_POST["PASSWORD"]);

    $bandera = $obj->verificarusuario($email,$contraseña);

    if($bandera) {
        $result = $obj->validarVerificacion($email);

        if($result) {      
            $_SESSION['datas'] = $email;
            header("Location:panel_control.php");
        } else {
            $error = "<li>El correo electrónico no ha sido verificado.</li>";
            header("Location:login.php?error=".$error);
        }
    } else {
        $error = "<li>La contraseña y/o el correo electrónico no son correctos, por favor comprueba.</li>";
        header("Location:login.php?error=".$error);
    }
?>
