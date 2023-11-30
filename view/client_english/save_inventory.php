<?php
require_once("../../controller/homeController.php");
require_once("../user/session_started.php");

$obj = new homeController();

$email = $_SESSION['datas'];
$tipo = $_POST["TIPO"];
$opciones = $_POST["OPCIONES"];
$cantidad = $_POST["CANTIDAD"];

$obj->guardarArticulos($email, $tipo, $opciones, $cantidad);
header("Location:inventary.php");

?>