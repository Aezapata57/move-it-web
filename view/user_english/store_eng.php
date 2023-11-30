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
$cc = $_POST["CC"];
$tipo = $_POST["TYPE"];
$token = bin2hex(random_bytes(16));
$verificado = "0";
$intentos = "";
$ultimo_intento = "";
$recuperacion_token = "";
$recuperacion_expiracion = "";
$error = "";
$message = "";

$fecha = $_POST["DATE"];
$fecha_nacimiento = DateTime::createFromFormat('d/m/Y', $fecha);
$fecha_nacimiento_str = $fecha_nacimiento->format('Y-m-d');
$edad = $fecha_nacimiento->diff(new DateTime())->y;

if ($contraseña == $confirmarContraseña) {

    // Llamada al método de verificación del controlador
    $registradoEmail = $obj->verificarEmail($email);
    $registradoCC = $obj->verificarCC($cc);
    $registradoTelefono = $obj->verificarTelefono($telefono);

    if ($registradoEmail) {
        $error .= "<li>The email is already registered</li>";
        header("Location:signup_eng.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if($registradoCC){
        $error .= "<li>The ID number is already registered</li>";
        header("Location:signup_eng.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if($registradoTelefono){
        $error .= "<li>The phone number is already registered</li>";
        header("Location:signup_eng.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/', $nombre) || !preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/', $apellidos)) {
        $error .= "<li>First and last names must not contain numbers.</li>";
        header("Location:signup_eng.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if (!preg_match('/^[0-9]{10}$/', $telefono)) {
        $error .= "<li>The phone must contain only numbers</li>";
        header("Location:signup_eng.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/', $contraseña)) {
        $error .= "<li>The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character, and be at least 8 characters</li>";
        header("Location:signup_eng.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if ($edad < 18) {
        $error .= "<li>You must be at least 18 years old to register</li>";
        header("Location:signup_eng.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if (!preg_match('/^[0-9]{8,10}$/', $cc)) {
        $error .= "<li>The identification number must contain only numbers and be between 8 and 10 digits</li>";
        header("Location:signup_eng.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else{
        $obj->guardarUsuario($nombre, $apellidos, $email, $telefono, $ciudad, $contraseña, $fecha, $cc, $tipo, $token, $verificado, $intentos, $ultimo_intento, $recuperacion_token, $recuperacion_expiracion);
        $verificationLink = "http://localhost/login/view/user_english/verificar_eng.php?token=" . $token;

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
        $mail->Subject = 'Verifica tu cuenta';
        $mail->isHTML(true);
        $mail->Body = "
                <html>
                <head>
                    <style>
                        @import url('https://fonts.googleapis.com/css2?family=Fredoka&family=Lexend+Giga&family=Poppins&display=swap');
                        /* Agrega estilos CSS si es necesario */
                        /* Por ejemplo: */
                        .container {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            padding: 20px;
                        }
                        .cont {
                            margin: 0 auto;
                            display: fixed;
                            align-items: center;         
                            font-family: 'Lexend Giga', sans-serif;
                            font-style: normal;
                            font-weight: 400;
                            font-size: 24px;
                            line-height: 30px;
                            letter-spacing: 0.325em;
                            color: #000000;
                        }
                        .message {
                            font-size: 16px;
                            color: #333;
                            margin-top: 20px;
                        }
                        /* ...otros estilos... */
                    </style>
                    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css' rel='stylesheet'
                    integrity='sha384-MrcW6ZMFYlzcLA8NlNl+NtUVUyJoyZ8j9WamEScpJ8H4/FFWzw33PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
                    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>
                    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js' integrity='sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r' crossorigin='anonymous'></script>
                    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js' integrity='sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+' crossorigin='anonymous'></script>
                </head>
                <body>
                    <div class='container-fluid'>
                        <div class='container'>
                            <div class='row' style='margin: 0 auto;display: fixed;width: 350px;margin-top: 20px;align-items: center;text-align: center;'>
                                <div class='col-4' style='width: 100px;margin: 0 auto;display: fixed;align-items: center;'>
                                    <div style='width: 100px;'>
                                        <img src='https://i.imgur.com/WEulCzV.png' alt='Logo' style='width: 100px;  >
                                    </div>
                                </div>
                                <div class='cont col-8'>
                                    <div>MOVE-IT</div>
                                </div>
                            </div>
                            <p class='message'>
                                Hi $nombre,To continue with your registration click on the following link to verify your account: <a href='$verificationLink'>Verify account</a>
                            </p>
                            <p class='message'>
                            Thanks for joining us!
                            </p>
                        </div>
                    </div>
                </body>
                </html>
        ";

        if (!$mail->send()) {
            echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
        } else {
            $message .= "<li>Your account was successfully registered, please verify it from the link sent to your email so you can log in.</li>";
            header("Location: login_eng.php?message=" . $message);
        }
    }
} else {
    $error .= "<li>Passwords entered do not match</li>";
    header("Location:signup_eng.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
}
?>
