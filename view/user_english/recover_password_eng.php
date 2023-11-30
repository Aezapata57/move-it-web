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
        $mail->Subject = 'Password recovery';
        $mail->Body = "Click the following link to recover your password: $recoveryLink";

        if ($mail->send()) {
            $message = "<li>Link provided successfully, verify your email</li>";
            header("Location: recover.php?message=" . $message);
            exit();
        } else {
            $error = "<li>Error sending email: " . $mail->ErrorInfo . " .Try again</li>";
            header("Location: recover.php?error=". $error);
        }
    } else {
        $error = "<li>The email provided is not registered.</li>";
        header("Location: recover.php?error=". $error);
    }
} else {
    header("Location: login.php");
    exit();
}
?>
