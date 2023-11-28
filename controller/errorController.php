<?php

// ErrorController.php
class ErrorController {
    public function notFound() {
        // Lógica para mostrar página de error 404
        include_once '../view/error/404.php';
    }
}


?>