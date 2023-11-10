<?php
    require_once('../../controller/homeController.php');
    $obj =  new homeController();
    $id = $_POST["ID"];
    $nombre = $_POST["NAMES"];
    $problema = $_POST["PROBLEM"];
    $comentario = $_POST["COMENT"];
    $telefono = $_POST["PHONE"];
    $obj->updatesupport($id, $nombre, $problema, $comentario, $telefono);
?>