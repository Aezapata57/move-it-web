<?php
require_once("../../controller/homeController.php");
require_once("../../config/config.php");
require_once("../../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;

$obj = new homeController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["EMAIL"];

    $emailExists = $obj->verificarEmail($email);

    if ($emailExists) {

        $token = $obj->generarTokenRecuperacion($email);

        $recoveryLink = "http://localhost/MOVE-IT/view/user/reset_password.php?token=" . $token;

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->Port = SMTP_PORT;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_SECURE;

        $mail->setFrom(EMAIL_FROM, EMAIL_NAME);

        $mail->addAddress($email);
        $mail->Subject = 'Recuperación de Contraseña';
        $mail->Body = "Haz clic en el siguiente enlace para recuperar tu contraseña: $recoveryLink";

        if ($mail->send()) {
            $message = "<li>Enlace proporcionado con exito, verifica tu correo electronico</li>";
            header("Location: recover.php?message=" . $message);
            exit();
        } else {
            $error = "<li>Error al enviar el correo: " . $mail->ErrorInfo . " .Intentalo nuevamente</li>";
            header("Location: recover.php?error=". $error);
        }
    } else {
        $error = "<li>El correo electrónico proporcionado no está registrado.</li>";
        header("Location: recover.php?error=". $error);
    }
} else {
    header("Location: login.php");
    exit();
}
?>
