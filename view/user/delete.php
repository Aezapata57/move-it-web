<?php
    require_once('../../controller/homeController.php');
    $obj = new homeController();
    $obj->delete($_GET['ID']);
?>