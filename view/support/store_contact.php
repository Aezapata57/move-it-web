<?php
    require_once('../../controller/homeController.php');
    $obj = new homeController();
    $nombre = $_POST["NAMES"];
    $problema = $_POST["PROBLEM"];
    $comentario = $_POST["COMENT"];
    $telefono = $_POST["PHONE"];
    $obj->contacto($nombre,$problema,$comentario,$telefono);
?>