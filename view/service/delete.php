<?php
    require_once('../../controller/homeController.php');
    $obj = new homeController();
    $obj->deleteservice($_GET['ID']);
?>