<?php
    require_once('../../controller/homeController.php');
    $obj =  new homeController();
    $id = $_POST["ID"];
    $origen = $_POST["ORIGEN"];
    $destino = $_POST["DESTINO"];
    $hora = $_POST["HORA"];
    $fecha = $_POST["FECHA"];
    $tipo = $_POST["TIPO"];
    $cantidad = $_POST["CANTIDAD"];
    $obj->updateservice($id, $origen, $destino, $hora, $fecha, $tipo, $cantidad);
?>