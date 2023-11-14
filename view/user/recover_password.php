<?php
require_once("../../controller/homeController.php");
require_once("../../config/config.php");
require_once("../../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;

$obj = new homeController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["EMAIL"];

    // Verificar si el correo electrónico está registrado
    $emailExists = $obj->verificarEmail($email);

    if ($emailExists) {
        // Generar y almacenar el token de recuperación
        $token = $obj->generarTokenRecuperacion($email);

        // Construir el enlace de recuperación
        $recoveryLink = "http://localhost/MOVE-IT/view/user/reset_password.php?token=" . $token;

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
        $mail->Subject = 'Recuperación de Contraseña';
        $mail->Body = "Haz clic en el siguiente enlace para recuperar tu contraseña: $recoveryLink";

        // Enviar el correo
        if ($mail->send()) {
            // Redirigir a una página de éxito o mostrar un mensaje de éxito
            $message = "<li>Enlace proporcionado con exito, verifica tu correo electronico</li>";
            header("Location: recover.php?message=" . $message);
            exit();
        } else {
            // Manejar el error en el envío del correo
            $error = "<li>Error al enviar el correo: " . $mail->ErrorInfo . " .Intentalo nuevamente</li>";
            header("Location: recover.php?error=". $error);
        }
    } else {
        // El correo electrónico no está registrado, manejar el error según sea necesario
        $error = "<li>El correo electrónico proporcionado no está registrado.</li>";
        header("Location: recover.php?error=". $error);
    }
} else {
    // Manejar el acceso no autorizado o redirigir según sea necesario
    header("Location: login.php");
    exit();
}
?>
