<?php

require_once("../../controller/homeController.php");
require_once("../user/session_started.php");

$obj = new homeController();

$email = $_SESSION['datas'];
$origen = $_POST["origen"];
$destino = $_POST["destino"];
$fecha = "";
$hora = "";
$verificado = "0";

$emailverificado = $obj->verificarDireccionEmail($email);

if ($emailverificado) {

    $obj->actualizarDirecciones($email, $origen, $destino);
    header("Location:date.php");

} else {

    $obj->guardarDirecciones($email, $origen, $destino, $fecha, $hora, $verificado);
    header("Location:date.php");
}

?>