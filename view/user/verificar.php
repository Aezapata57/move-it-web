<?php
require_once("../../controller/homeController.php");

// Verificar si se ha proporcionado un token en la URL
if (isset($_GET['token'])) {
    // Obtener el controlador
    $obj = new homeController();

    // Llamar al método de verificación
    $result = $obj->verificarToken();

    // Redirigir a la página de éxito o mostrar un mensaje de error
    if ($result) {
        header("Location: login.php");
    } else {
        echo "Token de verificación no válido.";
    }
} else {
    // Si no se proporciona un token válido en la URL, muestra un mensaje de error
    echo "Token de verificación no proporcionado.";
}

?>