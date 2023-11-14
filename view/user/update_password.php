<?php
// update_password.php

require_once("../../controller/homeController.php");
require_once("../../config/config.php");

$obj = new homeController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["token"]) && isset($_POST["PASSWORD"]) && isset($_POST["CONFIRM"])) {
    $token = $_POST["token"];
    $newPassword = $_POST["PASSWORD"];
    $confirmPassword = $_POST["CONFIRM"];

    // Verificar si las contraseñas coinciden
    if ($newPassword === $confirmPassword) {
        // Verificar si el token de recuperación es válido
        $validToken = $obj->verificarTokenRecuperacion($token);

        if ($validToken) {
            // Obtener el email asociado al token
            $email = $obj->obtenerEmailPorTokenRecuperacion($token);

            // Guardar la nueva contraseña y actualizar el token de recuperación
            $obj->actualizarContraseñaYTokenRecuperacion($email, $newPassword);

            // Redirigir al usuario a la página de inicio de sesión o mostrar un mensaje de éxito
            header("Location: login.php");
            exit();
        } else {
            $error = "<li>El enlace al que ingresaste ya no es valido, intenta nuevamente.</li>";
            header("Location: recover.php?error=". $error);
        }
    } else {
        $error .= "<li>Las contraseñas ingresadas no coinciden</li>";
        header("Location: reset_password.php?token=" . $_POST["token"] . "&error=" . $error);
        exit();
    }
} else {
    // Manejar el acceso no autorizado o redirigir según sea necesario
    header("Location: login.php");
    exit();
}
?>
