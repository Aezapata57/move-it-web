<?php
    require_once("../../controller/homeController.php");
    require_once("../user/session_started.php");

    $obj = new homeController();
    $email = $obj->limpiarcorreo($_POST["EMAIL"]);
    $contraseña = $obj->limpiarcadena($_POST["PASSWORD"]);

    $datosIntentos = $obj->obtenerDatosIntentos($email);

    $intentosMaximos = 5;
    $tiempoBloqueo = 24 * 60 * 60;

    if ($datosIntentos['INTENTOS'] >= $intentosMaximos && strtotime($datosIntentos['ULTIMO_INTENTO']) > (time() - $tiempoBloqueo)) {
        $tiempoRestante = $tiempoBloqueo - (time() - strtotime($datosIntentos['ULTIMO_INTENTO']));
        
        $tiempoRestanteFormateado = gmdate("H:i:s", $tiempoRestante);
    
        $error = "<li>Demasiados intentos fallidos. Inténtalo nuevamente en: $tiempoRestanteFormateado.</li>";
        header("Location:login.php?error=" . $error);
        exit();
    }

    $bandera = $obj->verificarusuario($email, $contraseña);

    $intentos = ($bandera) ? 0 : $datosIntentos['INTENTOS'] + 1;
    $ultimoIntento = date("Y-m-d H:i:s");

    $obj->actualizarIntentos($email, $intentos, $ultimoIntento);

    if ($bandera) {
        $result = $obj->validarVerificacion($email);
        if ($result) {
            $_SESSION['datas'] = $email;
            $type = $obj->RecogerTipo($email);
            if ($type == 'Cliente') {
                header("Location:../client/panel_control_client.php");
            }else if($type == "Conductor"){
                header("Location:../driver/panel_control_driver.php");
            }
        } else {
            $error = "<li>El correo electrónico no ha sido verificado.</li>";
            header("Location:login.php?error=" . $error);
        }
    } else {
        $error = "<li>La contraseña y/o el correo electrónico no son correctos, por favor comprueba.</li>";
        header("Location:login.php?error=" . $error);
    }
?>
