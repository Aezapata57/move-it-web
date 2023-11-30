<?php

require_once("../../controller/homeController.php");
require_once("../../config/config.php");

$obj = new homeController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["token"]) && isset($_POST["PASSWORD"]) && isset($_POST["CONFIRM"])) {
    $token = $_POST["token"];
    $newPassword = $_POST["PASSWORD"];
    $confirmPassword = $_POST["CONFIRM"];

    if ($newPassword === $confirmPassword) {
        
        $validToken = $obj->verificarTokenRecuperacion($token);

        if ($validToken) {
            $email = $obj->obtenerEmailPorTokenRecuperacion($token);

            $obj->actualizarContraseñaYTokenRecuperacion($email, $newPassword);

            header("Location: login.php");
            exit();
        } else {
            $error = "<li>The link you entered is no longer valid, try again.</li>";
            header("Location: recover.php?error=". $error);
        }
    } else {
        $error .= "<li>Passwords entered do not match</li>";
        header("Location: reset_password.php?token=" . $_POST["token"] . "&error=" . $error);
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
