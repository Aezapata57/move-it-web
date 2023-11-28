<?php
require_once("../../controller/homeController.php");
require_once("../../config/config.php");
require_once("../../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;

$obj = new homeController();
$nombre = htmlentities($_POST["NAMES"], ENT_QUOTES, 'UTF-8');
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
try {
    $fecha_nacimiento = DateTime::createFromFormat('Y-m-d', $fecha);

    if ($fecha_nacimiento instanceof DateTime) {
        $edad = $fecha_nacimiento->diff(new DateTime())->y;
    } else {
        // Error en la creación del objeto DateTime
        // Puedes agregar algún mensaje de error o registrar este problema para depuración
        $error = "Error al crear el objeto DateTime desde la fecha de nacimiento.";
    }
} catch (Exception $e) {
    // Captura cualquier excepción lanzada al procesar la fecha
    $error = "Excepción al procesar la fecha de nacimiento: " . $e->getMessage();
}
$edad = $fecha_nacimiento->diff(new DateTime())->y;

if ($contraseña == $confirmarContraseña) {

    // Llamada al método de verificación del controlador
    $registradoEmail = $obj->verificarEmail($email);
    $registradoCC = $obj->verificarCC($cc);
    $registradoTelefono = $obj->verificarTelefono($telefono);

    if ($registradoEmail) {
        $error .= "<li>El correo electronico ya está registrado</li>";
        header("Location:signup.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if($registradoCC){
        $error .= "<li>El numero de cédula ya está registrado</li>";
        header("Location:signup.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if($registradoTelefono){
        $error .= "<li>El número telefónico ya están registrados</li>";
        header("Location:signup.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/', $nombre) || !preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/', $apellidos)) {
        $error .= "<li>Los nombres y apellidos no deben contener números</li>";
        header("Location:signup.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if (!preg_match('/^[0-9]{10}$/', $telefono)) {
        $error .= "<li>El teléfono debe contener solo números</li>";
        header("Location:signup.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/', $contraseña)) {
        $error .= "<li>La contraseña debe contener al menos una mayúscula, una minúscula, un número y un carácter especial, y tener al menos 8 caracteres</li>";
        header("Location:signup.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if ($edad < 18) {
        $error .= "<li>Debes tener al menos 18 años para registrarte</li>";
        header("Location:signup.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else if (!preg_match('/^[0-9]{8,10}$/', $cc)) {
        $error .= "<li>El número de identificación debe contener solo números y tener entre 8 y 10 dígitos</li>";
        header("Location:signup.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
    }else{
        $obj->guardarUsuario($nombre, $apellidos, $email, $telefono, $ciudad, $contraseña, $fecha, $cc, $tipo, $token, $verificado, $intentos, $ultimo_intento, $recuperacion_token, $recuperacion_expiracion);
        $verificationLink = "http://localhost/move-it/view/user/verificar.php?token=" . $token;

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
                            text-align: center;
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
                                        <img src='https://i.imgur.com/WEulCzV.png' alt='Logo' style='width: 100px;'>
                                    </div>
                                </div>
                                <div class='cont col-8'>
                                    <div>MOVE-IT</div>
                                </div>
                            </div>
                            <p class='message'>
                                Hola $nombre, para continuar con tu registro haz clic en el siguiente enlace para verificar tu cuenta: <a href='$verificationLink'>Verificar cuenta</a>
                            </p>
                            <p class='message'>
                                ¡Gracias por unirte a nosotros!
                            </p>
                        </div>
                    </div>
                </body>
                </html>
        ";

        if (!$mail->send()) {
            echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
        } else {
            $message .= "<li>Tu cuenta fue registrada con exito, porfavor verificala desde el enlace enviado a tu correo para que puedas iniciar sesión.</li>";
            header("Location: login.php?message=" . $message);
        }
    }
} else {
    $error .= "<li>Las contraseñas ingresadas no coinciden</li>";
    header("Location:signup.php?error=" . $error . "&NAMES=" . $nombre . "&SURNAMES=" . $apellidos . "&EMAIL=" . $email . "&PHONE=" . $telefono . "&DATE=" . $fecha . "&CC=" . $cc);
}
?>
