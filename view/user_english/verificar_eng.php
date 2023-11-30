<?php

require_once("../../config/config.php");
require_once("../../controller/homeController.php");

// Verificar si se ha proporcionado un token en la URL
if (isset($_GET['token'])) {
    // Obtener el controlador
    $homeController = new homeController();

    // Llamar al método de verificación
    $result = $homeController->verificarToken();

    // Redirigir a la página de éxito o mostrar un mensaje de error
    if ($result) {
        header("Location: login.php");
    } else {
        echo "Invalid verification token.";
    }
} else {
    // Si no se proporciona un token válido en la URL, muestra un mensaje de error
    echo "Verification token not provided.";
}

?>