<?php
    require_once('../../controller/homeController.php');
    $obj = new homeController();
    /*$origen = $_POST["ORIGEN"];
    $destino = $_POST["DESTINO"];
    $hora = $_POST["HORA"];
    $fecha = $_POST["FECHA"];
    $tipo = $_POST["TIPO"];
    $cantidad = $_POST["CANTIDAD"];*/
    $obj->servicio($_POST["ORIGEN"],$_POST["DESTINO"],$_POST["HORA"],$_POST["FECHA"],$_POST["TIPO"],$_POST["CANTIDAD"]);
?>