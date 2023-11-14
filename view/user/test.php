<?php 

    require_once("../../model/homeModel.php");
    require_once("../../config/config.php");

    $obj = new homeModel();

    print_r($obj->obtenerUltimasContraseñas("rapidplase@gmail.com"));

?>