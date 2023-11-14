<?php
    require_once("../../controller/homeController.php");

    session_start();

    $obj = new homeController();
    $email = $obj->limpiarcorreo($_POST["EMAIL"]);
    $contraseña = $obj->limpiarcadena($_POST["PASSWORD"]);

    // Obtener datos de intentos antes de la verificación del usuario
    $datosIntentos = $obj->obtenerDatosIntentos($email);
 
    // Verificar si el usuario está bloqueado debido a demasiados intentos fallidos
    $intentosMaximos = 5;
    $tiempoBloqueo = 24 * 60 * 60; // 24 horas en segundos

    if ($datosIntentos['INTENTOS'] >= $intentosMaximos && strtotime($datosIntentos['ULTIMO_INTENTO']) > (time() - $tiempoBloqueo)) {
        // Calcular el tiempo restante hasta que el usuario pueda intentar iniciar sesión nuevamente
        $tiempoRestante = $tiempoBloqueo - (time() - strtotime($datosIntentos['ULTIMO_INTENTO']));
        
        // Formatear el tiempo restante en horas, minutos y segundos
        $tiempoRestanteFormateado = gmdate("H:i:s", $tiempoRestante);
    
        $error = "<li>Demasiados intentos fallidos. Inténtalo nuevamente en: $tiempoRestanteFormateado.</li>";
        header("Location:login.php?error=" . $error);
        exit();
    }

    // Verificación del usuario
    $bandera = $obj->verificarusuario($email, $contraseña);

    // Después de la verificación del usuario
    $intentos = ($bandera) ? 0 : $datosIntentos['INTENTOS'] + 1;
    $ultimoIntento = date("Y-m-d H:i:s");

    $obj->actualizarIntentos($email, $intentos, $ultimoIntento);

    if ($bandera) {
        $result = $obj->validarVerificacion($email);
        if ($result) {
            $_SESSION['datas'] = $email;
            header("Location:panel_control.php");
        } else {
            $error = "<li>El correo electrónico no ha sido verificado.</li>";
            header("Location:login.php?error=" . $error);
        }
    } else {
        $error = "<li>La contraseña y/o el correo electrónico no son correctos, por favor comprueba.</li>";
        header("Location:login.php?error=" . $error);
    }
?>
