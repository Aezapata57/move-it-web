<?php
    require_once('../../controller/homeController.php');
    $obj =  new homeController();
    $id = $_POST["ID"];
    $nombre = $_POST["NAMES"];
    $apellidos = $_POST["SURNAMES"];
    $email = $_POST["EMAIL"];
    $telefono = $_POST["PHONE"];
    $ciudad = $_POST["CITY"];
    $fecha = $_POST["DATE"];
    $cc = $_POST["CC"];
    $obj->update($id, $nombre, $apellidos, $email, $telefono, $ciudad, $fecha, $cc);
?>