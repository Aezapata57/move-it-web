<?php
require_once("../../controller/homeController.php");
require_once("../../config/config.php");
require_once("../../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;

$obj = new homeController();
$nombre = $_POST["NAMES"];
$apellidos = $_POST["SURNAMES"];
$email = $_POST["EMAIL"];
$telefono = $_POST["PHONE"];
$ciudad = $_POST["CITY"];
$contraseña = $_POST["PASSWORD"];
$confirmarContraseña = $_POST['CONFIRM'];
$fecha = $_POST["DATE"];
$cc = $_POST["CC"];
$tipo = $_POST["TYPE"];
$token = bin2hex(random_bytes(16));
$verificado = "0";
$error = "";

if ($contraseña == $confirmarContraseña) {

    // Llamada al método de verificación del controlador
    $registradoEmail = $obj->verificarEmail($email);
    $registradoCC = $obj->verificarCC($cc);
    $registradoTelefono = $obj->verificarTelefono($telefono);

    if ($registradoEmail) {
        // El usuario ya está registrado
        $error .= "<li>El correo electronico ya está registrado</li>";
        header("Location:signup.php?error=" . $error);
    } else if($registradoCC){
        $error .= "<li>El numero de cédula ya está registrado</li>";
        header("Location:signup.php?error=" . $error);
    } else if($registradoTelefono){
        $error .= "<li>El número telefónico ya están registrados</li>";
        header("Location:signup.php?error=" . $error);
    }else {
        // El usuario no está registrado
        $obj->guardarUsuario($nombre, $apellidos, $email, $telefono, $ciudad, $contraseña, $fecha, $cc, $tipo, $token, $verificado);
        // Generar un token de verificación
        $verificationLink = "http://localhost/login/view/user/verificar.php?token=" . $token;

        // Configurar PHPMailer
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->Port = SMTP_PORT;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_SECURE;

        // Configurar el remitente
        $mail->setFrom(EMAIL_FROM, EMAIL_NAME);

        // Configurar el destinatario y contenido del correo
        $mail->addAddress($email); // Email del usuario
        $mail->Subject = 'Verifica tu cuenta';
        $mail->Body = "Haz clic en el siguiente enlace para verificar tu cuenta: $verificationLink";

        if (!$mail->send()) {
            echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
        } else {
            header("Location:show_r.php");
        }
    }
} else {
    $error .= "<li>Las contraseñas ingresadas no coinciden</li>";
    header("Location:signup.php?error=" . $error . "&&EMAIL=" . $email . "&&PASSWORD=" . $contraseña . "&&CONFIRM=" . $confirmarContraseña);
}
?>
