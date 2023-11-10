<?php
    require_once('../../controller/homeController.php');
    $obj = new homeController();
    $obj->deletesupport($_GET['ID']);
?>