<?php 

    require_once("../../controller/homeController.php");
    require_once("../../config/config.php");

    $obj = new homeController();

    echo($obj->RecogerTipo("rapidplase@gmail.com"));

?>